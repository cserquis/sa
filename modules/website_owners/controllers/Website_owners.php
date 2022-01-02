<?php
class Website_owners extends Trongate {

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
            $data['headline'] = 'Update Website Owner Record';
            $data['cancel_url'] = BASE_URL.'website_owners/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Website Owner Record';
            $data['cancel_url'] = BASE_URL.'website_owners/manage';
        }

        $data['form_location'] = BASE_URL.'website_owners/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function manage() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['owner'] = '%'.$searchphrase.'%';
            $params['website_name'] = '%'.$searchphrase.'%';
            $params['website_address'] = '%'.$searchphrase.'%';
            $params['website_address_2'] = '%'.$searchphrase.'%';
            $params['website_phone'] = '%'.$searchphrase.'%';
            $params['website_email'] = '%'.$searchphrase.'%';
            $params['houzz_link'] = '%'.$searchphrase.'%';
            $params['facebook_link'] = '%'.$searchphrase.'%';
            $params['instagram_link'] = '%'.$searchphrase.'%';
            $params['trailhead_link'] = '%'.$searchphrase.'%';
            $sql = 'select * from website_owners
            WHERE owner LIKE :owner
            OR website_name LIKE :website_name
            OR website_address LIKE :website_address
            OR website_address_2 LIKE :website_address_2
            OR website_phone LIKE :website_phone
            OR website_email LIKE :website_email
            OR houzz_link LIKE :houzz_link
            OR facebook_link LIKE :facebook_link
            OR instagram_link LIKE :instagram_link
            OR trailhead_link LIKE :trailhead_link
            ORDER BY id';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Website Owners';
            $all_rows = $this->model->get('id');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->_get_limit();
        $pagination_data['pagination_root'] = 'website_owners/manage';
        $pagination_data['record_name_plural'] = 'website owners';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->_reduce_rows($all_rows);
        $data['selected_per_page'] = $this->_get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'website_owners';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    function show() {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('website_owners/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data == false) {
            redirect('website_owners/manage');
        } else {
            //generate picture folders, if required
            $picture_settings = $this->_init_picture_settings();
            $this->_make_sure_got_destination_folders($update_id, $picture_settings);

            //attempt to get the current picture
            $column_name = $picture_settings['target_column_name'];

            if ($data[$column_name] !== '') {
                //we have a picture - display picture preview
                $data['draw_picture_uploader'] = false;
            } else {
                //no picture - draw upload form
                $data['draw_picture_uploader'] = true;
            }
            $data['update_id'] = $update_id;
            $data['headline'] = 'Website Owner Information';
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

            $this->validation_helper->set_rules('owner', 'Owner', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('website_name', 'Website Name', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('website_address', 'Website Address', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('website_address_2', 'Website Address 2', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('website_phone', 'Website Phone', 'required|min_length[2]|max_length[20]');
            $this->validation_helper->set_rules('website_email', 'Website Email', 'required|min_length[7]|max_length[255]|valid_email_address|valid_email');
            $this->validation_helper->set_rules('houzz_link', 'Houzz Link', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('facebook_link', 'Facebook Link', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('instagram_link', 'Instagram Link', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('trailhead_link', 'Trailhead Link', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('facebook__google_scripts', 'Facebook - Google Scripts', 'required|min_length[2]');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = segment(3);
                $data = $this->_get_data_from_post();

                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'website_owners');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'website_owners');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('website_owners/show/'.$update_id);

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
            $params['module'] = 'website_owners';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'website_owners');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('website_owners/manage');
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
        redirect('website_owners/manage');
    }

    function _get_data_from_db($update_id) {
        $record_obj = $this->model->get_where($update_id, 'website_owners');

        if ($record_obj == false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            return $data;        
        }
    }

    function _get_data_from_post() {
        $data['owner'] = post('owner', true);
        $data['website_name'] = post('website_name', true);
        $data['website_address'] = post('website_address', true);
        $data['website_address_2'] = post('website_address_2', true);
        $data['website_phone'] = post('website_phone', true);
        $data['website_email'] = post('website_email', true);
        $data['houzz_link'] = post('houzz_link', true);
        $data['facebook_link'] = post('facebook_link', true);
        $data['instagram_link'] = post('instagram_link', true);
        $data['trailhead_link'] = post('trailhead_link', true);
        $data['facebook__google_scripts'] = post('facebook__google_scripts', true);        
        return $data;
    }

    function _init_picture_settings() { 
        $picture_settings['max_file_size'] = 10000;
        $picture_settings['max_width'] = 10000;
        $picture_settings['max_height'] = 10000;
        $picture_settings['resized_max_width'] = 1500;
        $picture_settings['resized_max_height'] = 1500;
        $picture_settings['destination'] = 'pictures/website_owners_pics';
        $picture_settings['target_column_name'] = 'picture';
        $picture_settings['thumbnail_dir'] = 'pictures/website_owners_pics_thumbnails';
        $picture_settings['thumbnail_max_width'] = 800;
        $picture_settings['thumbnail_max_height'] = 800;
        return $picture_settings;
    }

    function _make_sure_got_destination_folders($update_id, $picture_settings) {
        $destination = $picture_settings['destination'];
        $target_dir = APPPATH.'public/'.$destination.'/'.$update_id;

        if (!file_exists($target_dir)) {
            //generate the image folder
            mkdir($target_dir, 0777, true);
        }

        //attempt to create thumbnail directory
        $thumbnail_dir = trim($picture_settings['thumbnail_dir']);

        if (strlen($thumbnail_dir)>0) {
            $target_dir = APPPATH.'public/'.$thumbnail_dir.'/'.$update_id;
            if (!file_exists($target_dir)) {
                //generate the image folder
                mkdir($target_dir, 0777, true);
            }
        }
    }

    function submit_upload_picture($update_id) {

        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if ($_FILES['picture']['name'] == '') {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $submit = post('submit');

        if ($submit == 'Upload') {
            $picture_settings = $this->_init_picture_settings();
            extract($picture_settings);

            $validation_str = 'allowed_types[gif,jpg,jpeg,png]|max_size['.$max_file_size.']|max_width['.$max_width.']|max_height['.$max_height.']';
            $this->validation_helper->set_rules('picture', 'item picture', $validation_str);

            $result = $this->validation_helper->run();

            if ($result == true) {

                $config['destination'] = $destination.'/'.$update_id;
                $config['max_width'] = $resized_max_width;
                $config['max_height'] = $resized_max_height;

                if ($thumbnail_dir !== '') {
                    $config['thumbnail_dir'] = $thumbnail_dir.'/'.$update_id;
                    $config['thumbnail_max_width'] = $thumbnail_max_width;
                    $config['thumbnail_max_height'] = $thumbnail_max_height;
                }

                //upload the picture
                $this->upload_picture($config);

                //update the database
                $data[$target_column_name] = $_FILES['picture']['name'];
                $this->model->update($update_id, $data);

                $flash_msg = 'The picture was successfully uploaded';
                set_flashdata($flash_msg);
                redirect($_SERVER['HTTP_REFERER']);

            } else {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

    function ditch_picture($update_id) {

        if (!is_numeric($update_id)) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        $result = $this->model->get_where($update_id);

        if ($result == false) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $picture_settings = $this->_init_picture_settings();
        $target_column_name = $picture_settings['target_column_name'];
        $picture_name = $result->$target_column_name;
        $picture_path = $picture_settings['destination'].'/'.$update_id.'/'.$picture_name;

        if (file_exists($picture_path)) {
            unlink($picture_path);
        }

        if (isset($picture_settings['thumbnail_dir'])) {
            $thumbnail_path = $picture_settings['thumbnail_dir'].'/'.$update_id.'/'.$picture_name;
            if (file_exists($thumbnail_path)) {
                unlink($thumbnail_path);
            }
        }

        $data[$target_column_name] = '';
        $this->model->update($update_id, $data);
        
        $flash_msg = 'The picture was successfully deleted';
        set_flashdata($flash_msg);
        redirect($_SERVER['HTTP_REFERER']);
    }
}