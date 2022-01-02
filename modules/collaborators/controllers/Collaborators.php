<?php
class Collaborators extends Trongate {

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
            $data['headline'] = 'Update Collaborator Record';
            $data['cancel_url'] = BASE_URL.'collaborators/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Collaborator Record';
            $data['cancel_url'] = BASE_URL.'collaborators/manage';
        }

        $data['form_location'] = BASE_URL.'collaborators/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function manage() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['collaborator_name'] = '%'.$searchphrase.'%';
            $params['collaborator_email'] = '%'.$searchphrase.'%';
            $params['contact_person'] = '%'.$searchphrase.'%';
            $params['collaborator_telephone'] = '%'.$searchphrase.'%';
            $params['collaborator_address'] = '%'.$searchphrase.'%';
            $sql = 'select * from collaborators
            WHERE collaborator_name LIKE :collaborator_name
            OR collaborator_email LIKE :collaborator_email
            OR contact_person LIKE :contact_person
            OR collaborator_telephone LIKE :collaborator_telephone
            OR collaborator_address LIKE :collaborator_address
            ORDER BY collaborator_name';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Collaborators';
            $all_rows = $this->model->get('collaborator_name');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->_get_limit();
        $pagination_data['pagination_root'] = 'collaborators/manage';
        $pagination_data['record_name_plural'] = 'collaborators';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->_reduce_rows($all_rows);
        $data['selected_per_page'] = $this->_get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'collaborators';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    function show() {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('collaborators/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data == false) {
            redirect('collaborators/manage');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Collaborator Information';
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

            $this->validation_helper->set_rules('collaborator_name', 'Collaborator Name', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('collaborator_email', 'Collaborator email', 'min_length[7]|max_length[255]|valid_email_address|valid_email');
            $this->validation_helper->set_rules('contact_person', 'Contact Person', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('collaborator_telephone', 'Collaborator Telephone', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('collaborator_address', 'Collaborator Address', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('last_contact', 'Last Contact', 'valid_datetimepicker_us');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = segment(3);
                $data = $this->_get_data_from_post();
                if($data['last_contact'] != '') {
                    $data['last_contact'] = str_replace('at', '', $data['last_contact']);
                    $data['last_contact'] = date('Y-m-d H:i', strtotime($data['last_contact']));
                } else {
                    $data['last_contact'] = date('Y-m-d H:i', time());
                }
                

                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'collaborators');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'collaborators');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('collaborators/show/'.$update_id);

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
            $params['module'] = 'collaborators';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'collaborators');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('collaborators/manage');
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
        redirect('collaborators/manage');
    }

    function _get_data_from_db($update_id) {
        $record_obj = $this->model->get_where($update_id, 'collaborators');

        if ($record_obj == false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            return $data;        
        }
    }

    function _get_data_from_post() {
        $data['collaborator_name'] = post('collaborator_name', true);
        $data['collaborator_email'] = post('collaborator_email', true);
        $data['contact_person'] = post('contact_person', true);
        $data['collaborator_telephone'] = post('collaborator_telephone', true);
        $data['collaborator_address'] = post('collaborator_address', true);
        $data['last_contact'] = post('last_contact', true);        
        return $data;
    }

}