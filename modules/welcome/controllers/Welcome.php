<?php
class Welcome extends Trongate {
 
    function index() {
        $data['homepage_pictures'] = $this->model->get('id','homepage_pictures');
        if($data['homepage_pictures'] == true) {
          $data['total_rows'] = count($data['homepage_pictures']);
        } else {
          $data['total_rows'] = 0;
        }

        $texts = $this->model->get_where(1, 'sections_texts');

        $data['page_title'] = $texts->page_title;
        $data['homepage_title'] = $texts->title;
        $data['homepage_text'] = nl2br($texts->page_content);

        $data['meta_keywords'] = $texts->meta_keywords;
        $data['meta_description'] = $texts->meta_description;
    
        $data['view_module'] = 'welcome';
        $data['view_file'] = 'homepage_content';
        $this->template('design_template', $data);
    }

    function width_screen() {
        $post = file_get_contents('php://input');
        $params = json_decode($post, true);
        $screen_width = $params['screenWidth'];
        $_SESSION['screen_width'] = $screen_width;
        echo json_encode($screen_width);
    
    }

}