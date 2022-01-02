<?php
class Publications extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);    

    function _display() {
		
        $sql = 'SELECT
        *
        FROM
        publications
        WHERE 
        publications.live_on_website = 1 
        ORDER BY publications.published_date DESC';
        $rows = $this->model->query($sql, 'object');
        if (empty($rows)) {
         $results = 0;   
        } else {
         $results = count($rows);
        }  
        $data['results'] = $results;
        $data['news'] = $rows;
		$data['view_module'] = 'publications';
		$this->view('display', $data);
	}


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
            $data['headline'] = 'Update Publication Record';
            $data['cancel_url'] = BASE_URL.'publications/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Publication Record';
            $data['cancel_url'] = BASE_URL.'publications/manage';
        }

        $data['form_location'] = BASE_URL.'publications/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function manage() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['publication_title'] = '%'.$searchphrase.'%';
            $params['publication_media'] = '%'.$searchphrase.'%';
            $params['media_link'] = '%'.$searchphrase.'%';
            $sql = 'select * from publications
            WHERE publication_title LIKE :publication_title
            OR publication_media LIKE :publication_media
            OR media_link LIKE :media_link
            ORDER BY published_date desc';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Publications';
            $all_rows = $this->model->get('published_date desc');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->_get_limit();
        $pagination_data['pagination_root'] = 'publications/manage';
        $pagination_data['record_name_plural'] = 'publications';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->_reduce_rows($all_rows);
        $data['selected_per_page'] = $this->_get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'publications';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    function show() {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('publications/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['live_on_website'] = ($data['live_on_website'] == 1 ? 'yes' : 'no');

        $data['token'] = $token;

        if ($data == false) {
            redirect('publications/manage');
        } else {
            $data['update_id'] = $update_id;
            $data['headline'] = 'Publication Information';
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }

    function _get_nice_date($fecha_timestamp) {
        $fecha = date('m/d/Y', $fecha_timestamp);
        return $fecha;
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
                $row->live_on_website = ($row->live_on_website == 1 ? 'yes' : 'no');
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

            $this->validation_helper->set_rules('publication_title', 'Publication Title', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('publication_media', 'Publication Media', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('media_link', 'Media Link', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('published_date', 'Published Date', 'valid_datepicker_us');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = segment(3);
                $data = $this->_get_data_from_post();
                $data['url_string'] = strtolower(url_title($data['publication_title']));
                $data['live_on_website'] = ($data['live_on_website'] == 1 ? 1 : 0);

                if ($data['published_date'] == '' ) {
                    $data['published_date'] = time();
                } else {
                    $this->module('timedate');
                    $data['published_date'] = $this->timedate->make_timestamp_from_datepicker_us($data['published_date']);
                }

                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'publications');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'publications');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('publications/show/'.$update_id);

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
            $params['module'] = 'publications';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'publications');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('publications/manage');
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
        redirect('publications/manage');
    }

    function _get_data_from_db($update_id) {
        $record_obj = $this->model->get_where($update_id, 'publications');

        if ($record_obj == false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            $this->module('timedate');
            $data['published_date'] = $this->timedate->get_nice_date($data['published_date'], 'datepicker_us');
            return $data;        
        }
    }

    function _get_data_from_post() {
        $data['publication_title'] = post('publication_title', true);
        $data['publication_media'] = post('publication_media', true);
        $data['media_link'] = post('media_link', true);
        $data['published_date'] = post('published_date', true);
        $data['live_on_website'] = post('live_on_website', true);        
        return $data;
    }

}