<?php
class Templates extends Trongate {

    function design_template($data) {
        $this->module('website_owners');
        $this->module('svg_logos');
        $this->module('sections_texts');
        $this->module('menu_links');
        $homepage_settings = $this->model->get_where(1, 'website_owners');
        $segmento =  segment(1);
        $segmento2 =  segment(2);
        $segmento3 =  segment(3);
        $data['segmento'] = $segmento;
        $data['segmento2'] = $segmento2;
        $data['segmento3'] = $segmento3;
        $data['website_name'] = $homepage_settings->website_name;
        $data['website_address'] = $homepage_settings->website_address;
        $data['website_address_2'] = $homepage_settings->website_address_2;
        $data['website_phone'] = $homepage_settings->website_phone;
        $data['website_email'] = $homepage_settings->website_email;
        $data['website_houzz_link'] = $homepage_settings->houzz_link;
        $data['website_instagram_link'] = $homepage_settings->instagram_link;
        $data['trailhead_link'] = $homepage_settings->trailhead_link;
        $data['website_facebook_link'] = $homepage_settings->facebook_link;
        $data['website_script'] = $homepage_settings->facebook__google_scripts;
        $data['picture'] = $homepage_settings->picture;

        $data['image_path'] = BASE_URL.'pictures/website_owners_pics/1/'.$homepage_settings->picture;

        $logo = $this->model->get_where(1, 'svg_logos');
        $data['logo_header_image'] = $logo->svg_tag;
        $logo2 = $this->model->get_where(2, 'svg_logos');
        $data['logo_footer_image'] = $logo2->svg_tag;

        $data['logo_header_path'] = BASE_URL.'src/img/S+A-full-logo-small.svg';
        $data['logo_footer_path'] = BASE_URL.'src/img/S+A-Iconwhite.svg';


        $data['website_module'] = segment(1);

        if(!isset($_SESSION['screen_width'])) { $width = 1500;} else { $width = $_SESSION['screen_width'];}
        $data['width'] = $width;
        $data['menu_links'] = $this->menu_links->_get_menus();

        if (!isset($data['og_type'])) {
            $data['og_type'] = 'website';
        }

        if (isset($data['additional_includes_top'])) {
            $data['additional_includes_top'] = $this->_build_additional_includes($data['additional_includes_top']);
        } else {
            $data['additional_includes_top'] = '';
        }

        if (isset($data['additional_includes_middle'])) {
            $data['additional_includes_middle'] = $this->_build_additional_includes($data['additional_includes_middle']);
        } else {
            $data['additional_includes_middle'] = '';
        }

        if (isset($data['additional_includes_btm'])) {
            $data['additional_includes_btm'] = $this->_build_additional_includes($data['additional_includes_btm']);
        } else {
            $data['additional_includes_btm'] = '';
        }

        load('design_template', $data);
    }

    function width_screen() {
        $post = file_get_contents('php://input');
        $params = json_decode($post, true);
        $screen_width = $params['screenWidth'];
        $_SESSION['screen_width'] = $screen_width;
        echo json_encode($screen_width);

    }

    function public($data) {
        load('public', $data);
    }

    function error_404($data) {
        load('error_404', $data);
    }

    function admin($data) {

        if (isset($data['additional_includes_top'])) {
            $data['additional_includes_top'] = $this->_build_additional_includes($data['additional_includes_top']);
        } else {
            $data['additional_includes_top'] = '';
        }

        if (isset($data['additional_includes_btm'])) {
            $data['additional_includes_btm'] = $this->_build_additional_includes($data['additional_includes_btm']);
        } else {
            $data['additional_includes_btm'] = '';
        }

        load('admin', $data);
    }

    function _build_css_include_code($file) {
        $code = '<link rel="stylesheet" href="'.$file.'">';
        $code = str_replace('""></script>', '"></script>', $code);
        return $code;
    }

    function _build_js_include_code($file) {
       $code = '<script src="'.$file.'"></script>';
       $code = str_replace('""></script>', '"></script>', $code);
       return $code;
    }

    function _build_additional_includes($files) {

        $html = '';
        foreach ($files as $file) {

            $last_four = substr($file, -4);
            
            if ($last_four == '.css') {
                $html.= $this->_build_css_include_code($file);
                
            } else {
               $html.= $this->_build_js_include_code($file);
            }

            $html.= '
    ';
        }

        $html = trim($html);
        $html.= '
';
        return $html;
    }

}