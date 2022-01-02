<?php
class Dashboard extends Trongate {

	function home() {
        $this->module('trongate_administrators');

       /*  $data['token'] = $this->security->_make_sure_allowed(); */

		$token = $this->trongate_administrators->_make_sure_allowed();
        $data['my_admin_id'] = $this->trongate_administrators->_get_my_id($token);
        $data['rows'] = $this->model->get('username', 'trongate_administrators');

        $all_projects = $this->model->get('id desc', 'projects');

       	$data['all_projects'] = $all_projects;
        $data['headline'] = 'Dashboard';
        $data['view_module'] = 'dashboard';
        $data['view_file'] = 'home';

        $this->template('admin', $data);
	}



}