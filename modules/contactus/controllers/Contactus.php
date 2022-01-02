<?php
class Contactus extends Trongate {


	function index() {

		$this->module('website_owners');

		$data = $this->website_owners->_get_data_from_db(1);
		$data['contact_page_image_mobile'] = BASE_URL.'src/img/contact_mobile.jpg';
		$data['contact_page_image_desktop'] =BASE_URL.'src/img/contact_web.jpg';
		$data['multimodal_map_image'] = BASE_URL.'src/img/multimodal-map-01.png';

		$texts = $this->model->get_where(4, 'sections_texts');
        $data['title'] = $texts->title;
        $data['page_content'] = $texts->page_content;
        $data['page_title'] = $texts->page_title;
        $data['meta_description'] = $texts->meta_description;
        $data['meta_keywords'] = $texts->meta_keywords;

		$data['view_module'] = 'contactus';
		$data['view_file'] = 'contact';
		$this->template('design_template', $data);
	}


}