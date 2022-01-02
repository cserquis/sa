<?php
class About extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);   
    
    function index() {
        $this->module('sections_texts');
        $data['our_story'] = $this->model->get('id', 'abouts');
        $data['ori_awards'] = $this->model->get('year desc', 'awards');

        $data['image_path'] = BASE_URL.'src/img/multimodal-map-01.png';
        
        $data['affiliations'] = $this->model->get('id', 'affiliations');
        $additional_includes_middle[] = 'https://www.w3schools.com/lib/w3.css';
        $data['additional_includes_middle'] = $additional_includes_middle;
        $data['houzz'] = $this->model->get('award_year desc', 'houzz_pictures');

        $texts = $this->model->get_where(2, 'sections_texts');
        $data['title'] = $texts->title;
        $data['page_content'] = $texts->page_content;
        $data['page_title'] = $texts->page_title;
        $data['meta_description'] = $texts->meta_description;
        $data['meta_keywords'] = $texts->meta_keywords;
        
        $data['class'] = 'class="about"';

        $data['view_module'] = 'about';
        $data['view_file'] = 'about';
        $this->template('design_template', $data);
    }
    
}