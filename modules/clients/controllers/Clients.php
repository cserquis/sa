<?php
class Clients extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    

    function create() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $update_id = segment(3);
        $submit = post('submit');

        if (($submit == '') && (is_numeric($update_id))) {
            $data = $this->_get_data_from_db($update_id);
        } else {
            $data = $this->_get_data_from_post();
        }

        if (is_numeric($update_id)) {
            $data['headline'] = 'Update Client Record';
            $data['cancel_url'] = BASE_URL.'clients/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Client Record';
            $data['cancel_url'] = BASE_URL.'clients/manage';
        }

        $data['form_location'] = BASE_URL.'clients/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function manage() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['client_name'] = '%'.$searchphrase.'%';
            $params['client_email'] = '%'.$searchphrase.'%';
            $params['telephone_number'] = '%'.$searchphrase.'%';
            $params['address'] = '%'.$searchphrase.'%';
            $sql = 'select * from clients
            WHERE client_name LIKE :client_name
            OR client_email LIKE :client_email
            OR telephone_number LIKE :telephone_number
            OR address LIKE :address
            ORDER BY active';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Clients';
            $all_rows = $this->model->get('active');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->_get_limit();
        $pagination_data['pagination_root'] = 'clients/manage';
        $pagination_data['record_name_plural'] = 'clients';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->_reduce_rows($all_rows);
        $data['selected_per_page'] = $this->_get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'clients';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    function show() {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('clients/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['active'] = ($data['active'] == 1 ? 'yes' : 'no');
        $data['token'] = $token;

        if ($data == false) {
            redirect('clients/manage');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Client Information';
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }
    
    function _reduce_rows($all_rows) {
        $rows = [];
        $start_index = $this->_get_offset();
        $limit = $this->_get_limit();
        $end_index = $start_index + $limit;

        $count = -1;
        foreach ($all_rows as $row) {
            $count++;
            if (($count>=$start_index) && ($count<$end_index)) {
                $row->active = ($row->active == 1 ? 'yes' : 'no');
                $rows[] = $row;
            }
        }

        return $rows;
    }

    function submit() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $submit = post('submit', true);

        if ($submit == 'Submit') {

            $this->validation_helper->set_rules('client_name', 'Client Name', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('client_email', 'Client Email', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('telephone_number', 'Telephone Number', 'min_length[2]|max_length[30]');
            $this->validation_helper->set_rules('address', 'Address', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('details', 'Details', 'min_length[2]');
            $this->validation_helper->set_rules('since', 'Since', 'valid_datepicker_us');
            $this->validation_helper->set_rules('last_contact', 'Last Contact', 'valid_datetimepicker_us');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = segment(3);
                $data = $this->_get_data_from_post();
                
                $data['url_string'] = strtolower(url_title($data['client_name']));
                $data['active'] = ($data['active'] == 1 ? 1 : 0);
                $data['since'] = date('Y-m-d', strtotime($data['since']));
                
                $data['last_contact'] = str_replace('at', '', $data['last_contact']);
                $data['last_contact'] = date('Y-m-d H:i', strtotime($data['last_contact']));
/*  foreach ($data as $key => $value) {
                    echo $key.' is '.$value;
                    echo '<br>';
                } */
                /* die(); */
                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'clients');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'clients');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('clients/show/'.$update_id);

            } else {
                //form submission error
                $this->create();
            }

        }

    }

    function submit_delete() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $submit = post('submit');
        $params['update_id'] = segment(3);

        if (($submit == 'Yes - Delete Now') && (is_numeric($params['update_id']))) {
            //delete all of the comments associated with this record
            $sql = 'delete from trongate_comments where target_table = :module and update_id = :update_id';
            $params['module'] = 'clients';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'clients');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('clients/manage');
        }
    }

    function _get_limit() {
        if (isset($_SESSION['selected_per_page'])) {
            $limit = $this->per_page_options[$_SESSION['selected_per_page']];
        } else {
            $limit = $this->default_limit;
        }

        return $limit;
    }

    function _get_offset() {
        $page_num = segment(3);

        if (!is_numeric($page_num)) {
            $page_num = 0;
        }

        if ($page_num>1) {
            $offset = ($page_num-1)*$this->_get_limit();
        } else {
            $offset = 0;
        }

        return $offset;
    }

    function _get_selected_per_page() {
        if (!isset($_SESSION['selected_per_page'])) {
            $selected_per_page = $this->per_page_options[1];
        } else {
            $selected_per_page = $_SESSION['selected_per_page'];
        }

        return $selected_per_page;
    }

    function set_per_page($selected_index) {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (!is_numeric($selected_index)) {
            $selected_index = $this->per_page_options[1];
        }

        $_SESSION['selected_per_page'] = $selected_index;
        redirect('clients/manage');
    }

    function _get_data_from_db($update_id) {
        $record_obj = $this->model->get_where($update_id, 'clients');

        if ($record_obj == false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            return $data;        
        }
    }

    function _get_data_from_post() {
        $data['client_name'] = post('client_name', true);
        $data['client_email'] = post('client_email', true);
        $data['telephone_number'] = post('telephone_number', true);
        $data['address'] = post('address', true);
        $data['details'] = post('details', true);
        $data['since'] = post('since', true);
        $data['last_contact'] = post('last_contact', true);
        $data['active'] = post('active', true);        
        return $data;
    }

}