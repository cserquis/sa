<?php
class Menu_links extends Trongate {

    function _get_menus() {
         $sql = "SELECT * FROM menu_links where id <= 3";
         $rows = $this->model->query($sql, 'object');
         return $rows;
    }


    function manage() {
        $this->module('security');
        $data['token'] = $this->security->_make_sure_allowed();
        $data['order_by'] = 'id';

        //format the pagination
        $data['total_rows'] = $this->model->count('menu_links');
        $data['record_name_plural'] = 'menu_links';

        $data['headline'] = 'Manage Menu links';
        $data['view_module'] = 'menu_links';
        $data['view_file'] = 'manage';

        $this->template('admin', $data);
    }

    function show() {
        $this->module('security');
        $token = $this->security->_make_sure_allowed();

        $update_id = $this->url->segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('menu_links/manage');
        }

        $data = $this->_get_data_from_db($update_id);
        $data['token'] = $token;

        if ($data == false) {
            redirect('menu_links/manage');
        } else {
            $data['form_location'] = BASE_URL.'menu_links/submit/'.$update_id;
            $data['update_id'] = $update_id;
            $data['headline'] = 'Menu Link Information';
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }

    function create() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $update_id = $this->url->segment(3);
        $submit = $this->input('submit', true);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('menu_links/manage');
        }

        //fetch the form data
        if (($submit == '') && ($update_id > 0)) {
            $data = $this->_get_data_from_db($update_id);
        } else {
            $data = $this->_get_data_from_post();
        }

        $data['headline'] = $this->_get_page_headline($update_id);

        if ($update_id > 0) {
            $data['cancel_url'] = BASE_URL.'menu_links/show/'.$update_id;
            $data['btn_text'] = 'UPDATE MENU LINK DETAILS';
        } else {
            $data['cancel_url'] = BASE_URL.'menu_links/manage';
            $data['btn_text'] = 'CREATE MENU LINK RECORD';
        }

        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css';
        $additional_includes_top[] = 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"';
        $additional_includes_top[] = 'https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/i18n/jquery-ui-timepicker-addon-i18n.min.js';
        $additional_includes_top[] = BASE_URL.'admin_files/js/jquery-ui-sliderAccess.js';
        $data['additional_includes_top'] = $additional_includes_top;

        $data['form_location'] = BASE_URL.'menu_links/submit/'.$update_id;
        $data['update_id'] = $update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function _get_page_headline($update_id) {
        //figure out what the page headline should be (on the menu_links/create page)
        if (!is_numeric($update_id)) {
            $headline = 'Create New Menu Link Record';
        } else {
            $headline = 'Update Menu Link Details';
        }

        return $headline;
    }

    function submit() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {

            $this->validation_helper->set_rules('menu_title', 'Menu Link Title', 'required|min_length[2]|max_length[50]');
            $this->validation_helper->set_rules('menu_path', 'Menu Link Path', 'min_length[2]|max_length[255]');

            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = $this->url->segment(3);
                $data = $this->_get_data_from_post();
                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'menu_links');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $update_id = $this->model->insert($data, 'menu_links');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('menu_links/show/'.$update_id);

            } else {
                //form submission error
                $this->create();
            }

        }

    }

    function submit_delete() {
        $this->module('security');
        $this->security->_make_sure_allowed();

        $submit = $this->input('submit', true);

        if ($submit == 'Submit') {
            $update_id = $this->url->segment(3);

            if (!is_numeric($update_id)) {
                die();
            } else {
                $data['update_id'] = $update_id;

                if(($update_id == 1) || ($update_id == 2) || ($update_id == 3)) {
                    //set the flashdata
                    $flash_msg = 'The record cannot be deleted';
                    set_flashdata($flash_msg);
                    //redirect to the manage page
                    redirect('menu_links/manage');
                } else {
                    //delete all of the comments associated with this record
                    $sql = 'delete from comments where target_table = :module and update_id = :update_id';
                    $data['module'] = $this->module;
                    $this->model->query_bind($sql, $data);

                    //delete the record
                    $this->model->delete($update_id, $this->module);

                    //set the flashdata
                    $flash_msg = 'The record was successfully deleted';
                    set_flashdata($flash_msg);

                    //redirect to the manage page
                    redirect('menu_links/manage');
                }             
            }
        }
    }

    function _get_data_from_db($update_id) {
        $menu_links = $this->model->get_where($update_id, 'menu_links');

        if ($menu_links == false) {
            $this->template('error_404');
            die();
        } else {
            $data['menu_title'] = $menu_links->menu_title;
            $data['menu_path'] = $menu_links->menu_path;
            return $data;
        }
    }

    function _get_data_from_post() {
        $data['menu_title'] = $this->input('menu_title', true);
        $data['menu_path'] = $this->input('menu_path', true);
        return $data;
    }

}