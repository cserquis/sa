<?php
class Projects extends Trongate {

    private $default_limit = 20;
    private $per_page_options = array(10, 20, 50, 100);   

    function categories() {
     
        $category_string = segment(3);
        
        $data['cat_obj'] = $this->model->get_one_where('url_string', $category_string, 'categories');
        

        if ($data['cat_obj'] == false) {
            redirect('projects/our_work');
        } else {

        $cat_id = $data['cat_obj']->id;
        $categories = $this->model->get('id', 'categories');

        $total_rows = $this->_get_cat_projects($cat_id, false);

        $data['categories'] = $categories;
        $data['total_rows'] = $total_rows;

        if($total_rows>0) {
            $rows = $this->_get_cat_projects($cat_id, true);
            $data['projects'] =  $rows;

            $data['template'] = 'design_template';
            $data['pagination_root'] = 'projects/categories/'.$category_string;
            $data['total_rows'] = $total_rows ;
            $data['offset'] = $this->get_offset_cat();
            $data['limit'] = $this->get_limit();
            $data['include_showing_statement'] = false;
            $data['page_num_segment'] = 4;
            $data['num_links_per_page'] = 3;

        } else {
            $data['no_projects'] = 'No projects yet'; 
        }

        $meta_data = $this->_get_category_settings($data['cat_obj'] );
        $data['page_title'] = $meta_data['page_title'];
        $data['meta_description'] = $meta_data['meta_description'];
        $data['meta_keywords'] = $meta_data['meta_keywords'];

        $data['headline'] = $data['cat_obj']->category_name;

        $data['image_path'] = BASE_URL.'src/img/pic01.jpg';;
        $data['no_picture'] = BASE_URL.'src/img/pic01.jpg';
        $data['modulo'] = 'categories';
        $additional_includes_top[] = BASE_URL.'src/css/stylework.css';
        $additional_includes_top[] = BASE_URL.'src/css/styleprojects.css';
        $data['additional_includes_top'] = $additional_includes_top;

        $data['class'] = 'class="our-work"';
        $data['view_module'] = 'projects';
        $data['view_file'] = 'categories';
        $this->template('design_template', $data);
      }
    }

    function get_offset_cat() {

        $page_num = segment(4);

        if(!is_numeric($page_num)) {
            $page_num = 0;
        } 
        if($page_num>1) {
          
            $offset = ($page_num-1)*$this->get_limit();
        } else {
            $offset = 0;
        }
        return $offset;
    }
    

    function _get_cat_projects($cat_id, $limit_results = NULL) {
        $params['cat_id'] = $cat_id; 
        if($limit_results == false) {
           
            $params['cat_id'] = $cat_id;  

            $sql = 'SELECT 
                projects.id as project_id
                FROM
                categories
                JOIN associated_projects_and_categories
                ON associated_projects_and_categories.categories_id = :cat_id
                JOIN projects              
                ON associated_projects_and_categories.projects_id = projects.id
                AND projects.live_on_website = 1
                WHERE categories.id = :cat_id               
                ';

            $rows = $this->model->query_bind($sql, $params, 'object');
        
            if (empty($rows)) {
             $results = 0;   
            } else {
             $results = count($rows);
            }          

        } else {
            $pagination_data['offset'] = $this->get_offset_cat();
            $pagination_data['limit'] = $this->get_limit();

            $sql = 'SELECT
                projects.id as project_id,
                projects.project_title,
                projects.project_name,
                projects.picture,
                projects.url_string
                FROM
                categories
                JOIN associated_projects_and_categories
                ON associated_projects_and_categories.categories_id = :cat_id
                JOIN projects              
                ON associated_projects_and_categories.projects_id = projects.id
                AND projects.live_on_website = 1
                WHERE categories.id = :cat_id
            ORDER BY 
            projects.id 
            LIMIT [offset], [limit] 
            ';
            $sql = str_replace('[offset]',$pagination_data['offset'], $sql);
            $sql = str_replace('[limit]',$pagination_data['limit'], $sql);

            $rows = $this->model->query_bind($sql, $params, 'object');
            foreach ($rows as $project) {
                $row_data['project_id'] = $project->project_id;
                $row_data['project_title'] = $project->project_title;
                $row_data['project_name'] = $project->project_name;
                $row_data['url_string'] = $project->url_string;
                $row_data['picture'] = $project->picture;
                $row_data['categories'] = $this->_get_categories($project->project_id, false);
    
                $data[] = (object) $row_data;
            }
            $results =  $data;    
        }
        return $results;
    }

    function _get_category_settings($cat_obj) {
        $meta_data['page_title'] = $cat_obj->category_name;
        $meta_data['page_title'].= ' Projects designed by ';
        $meta_description = 'Look to our ';
        $meta_description.= $meta_data['page_title'];
        $meta_description.= ' ';
        $meta_description.= OUR_NAME;

        $meta_data_description = '';

        $total_length = 0;
        $sentences = explode('. ', $meta_description);
        foreach($sentences as $sentence) {
            $sentence_length = strlen($sentence);
            $total_length = $total_length+$sentence_length;
           
            if ($total_length<160) {
                $meta_data_description.= $sentence.'. ';
            }

        }
        $meta_data['meta_description'] = $meta_data_description;
        $meta_data['meta_keywords'] = $cat_obj->category_name;
        $meta_data['meta_keywords'].= ' project, Landscape, Landscape Architecture ';

        $words = explode(' ', $cat_obj->category_name);
        foreach($words as $word) {
            $meta_data['meta_keywords'].= ', '.$word;
        }

        return $meta_data;
        

    }


    function our_project() {

        $url_string = segment(3);
        $data['project_obj'] = $this->model->get_one_where('url_string', $url_string, 'projects');
        if ($data['project_obj'] == false) {
            $this->not_found();
        } else {
           
            $data['no_picture'] = BASE_URL.'src/img/pic01.jpg';
            if($data['project_obj']->picture != '') {
                $data['picture_path'] = '/'.$data['project_obj']->id.'/'.$data['project_obj']->picture;
            } else {
                $data['picture_path'] = $data['no_picture'];           
            }
            $description = $data['project_obj']->project_description;
            if(strlen($description>1)) {
                if(strlen($description>252)){
                    $data['description1'] = substr($description,0,252);
                    $data['description2'] = substr($description,253, strlen($description));
                } else {
                    $data['description1'] = $data['project_obj'];
                    $data['description2'] = '';
                }
            } else {
                $data['description1'] = '';
                $data['description2'] = '';
            }
            $data['categories'] = $this->_get_categories($data['project_obj']->id, true);

            $data['published_time'] = date('Y-m-d\TH:m:s+00:00', $data['project_obj']->date_created);
 
            $data['collaborators_area'] = $this->_get_collaborators_areas($data['project_obj']->id);

            $data['collaborators_name'] = $this->_get_collaborator_collaborators($data['project_obj']->id);

            $data['tags'] = $this->_get_tags($data['project_obj']->id);

            $prev_next_projects = $this->_get_prev_next($data['project_obj']->id);

            $data['prev_link'] = $prev_next_projects['prev'];
            $data['next_link'] = $prev_next_projects['next'];
            $this->module('pictures');
            $data['pictures'] = $this->pictures->_get_pictures_module($data['project_obj']->id, 'projects');

            if($data['pictures'] == true) {
                $data['gallery_dir'] = BASE_URL.'pictures/projects_pictures/'.$data['project_obj']->id.'/';
            }
                        
            $meta_data = $this->_build_meta_data($data);
            $data['page_title'] = $meta_data['page_title'];
            $data['meta_description'] = $meta_data['meta_description'];
            $data['meta_keywords'] = $meta_data['meta_keywords'];
            $data['image_path'] = BASE_URL.'projects_pics_media'.$data['picture_path'];
            $data['og_type'] = 'article';
            $additional_includes_top[] = BASE_URL.'src/css/styleprojects.css';
            $data['additional_includes_top'] = $additional_includes_top;
            $data['class'] = 'class="project-example"';
            $data['view_file'] = 'our_project';
            $this->template('design_template', $data);
        }

    }

    
    function _get_collaborator_collaborators($project_id) {
        $collaborators_result = $this->model->get_many_where('projects_id', $project_id, 'associated_projects_and_collaborators');
        if ($collaborators_result == false){
            $collaborators_print = [];
        } else {
            $this->module('collaborators');
            $collaborators_print = [];
            foreach ($collaborators_result as $key => $value) {
              $collaborators_print[$key] = $this->_get_partner_name($collaborators_result[$key]->collaborators_id);  

            }
        }  
        
        return $collaborators_print;
    }

    function _get_partner_name($collaborators_id) {
        $partner_c = $this->model->get_one_where('id', $collaborators_id, 'collaborators');
        if ($partner_c == true){
            $partner = $partner_c->collaborator_name;
        } else {
            $partner = "";
        }        
        return $partner;
    }

    function _build_meta_data($data) {
        $meta_data['page_title'] = $data['project_obj']->project_title;
        $categories = '';
        foreach($data['categories'] as $category) {
            $categories.= $category;
            $categories.= ' ';
        }
        $meta_data['page_title'].= ' ';
        $meta_data['page_title'].= $categories;
        $meta_data['page_title'].= ' by ';

        $tags = '';
        foreach($data['tags'] as $tag) {
            $tags.= $tag;
            $tags.= ', ';
        }

        $description = $data['project_obj']->project_description;

        $meta_description = 'This Project is a design made by Serquis & Assocciates. ';
        $total_length = 0;
        $sentences = explode('. ', $description);

        foreach($sentences as $sentence) {
            $sentence_length = strlen($sentence);
            $total_length = $total_length+$sentence_length;
           
            if ($total_length<160) {
                $meta_description.= $sentence.' ';
            }

        }

        $meta_data['meta_description'] = $meta_description;
        $meta_data['meta_keywords'] = $data['project_obj']->project_title;
        $meta_data['meta_keywords'].= ', ';
        $meta_data['meta_keywords'].= $categories; 
        $meta_data['meta_keywords'].= $tags;


        $words = explode(' ', $data['project_obj']->project_title);
        foreach($words as $word) {
            $meta_data['meta_keywords'].= ', '.$word;
        }

        return $meta_data;
    }

    function _get_collaborators_areas($project_id) {
        $sql = 'SELECT             
        collaborators.collaborator_name,
        collaborator_areas.area
        FROM
        collaborators
        INNER JOIN
        associated_collaborators_and_collaborator_areas
        ON
        associated_collaborators_and_collaborator_areas.collaborators_id = collaborators.id
        INNER JOIN 
        associated_projects_and_collaborators
        ON               
        associated_projects_and_collaborators.projects_id = :project_id
        INNER JOIN
        collaborator_areas
        ON
        collaborator_areas.id = associated_collaborators_and_collaborator_areas.collaborator_areas_id
        WHERE
        collaborators.id = associated_projects_and_collaborators.collaborators_id
        ';
        $params['project_id'] = $project_id;
        $data = $this->model->query_bind($sql, $params, 'object');
        return $data;

    }

    function _get_prev_next($project_id) {
        //get the prev link
        $params['id'] = $project_id;
        
        $sql1 = 'select * from projects where id<:id 
                    AND live_on_website = 1   
                    ORDER BY id desc 
                    LIMIT 0,1';
        $result1 = $this->model->query_bind($sql1, $params, 'object');
        

        if ($result1 == false) {
            //no prev video found so link back to the sections home area
            $prev = BASE_URL.'projects/our_work';
        } else {
            //get the code for the video
            $categories = $this->_get_categories($result1[0]->id, false);
        
            $lookbook = 0;
            $is_look = in_array('Lookbooks', $categories);

            if($is_look == 1) {
                $lookbook = 1;
            }
            
            $target_project_url = $result1[0]->url_string;
            if($lookbook == 0) {
                $prev = BASE_URL.'projects/our_project/'.$target_project_url; 
            } else {
                $prev = BASE_URL.'projects/lookbooks/'.$target_project_url;
            }
            
        }

        //get the next link
        $sql2 = str_replace('id<:id', 'id>:id', $sql1);
        $sql2 = str_replace('id desc', 'id', $sql2);
        $result2 = $this->model->query_bind($sql2, $params, 'object');

        if ($result2 == false) {
            //no next video found so link back to the sections home area
            $next = BASE_URL.'projects/our_work';
        } else {
            $categories = $this->_get_categories($result2[0]->id, false);
        
            $lookbook = 0;
            $is_look = in_array('Lookbooks', $categories);

            if($is_look == 1) {
                $lookbook = 1;
            }

            $target_project_url = $result2[0]->url_string;
            if($lookbook == 0) {               
                $next = BASE_URL.'projects/our_project/'.$target_project_url;
            } else {
                $next = BASE_URL.'projects/lookbooks/'.$target_project_url;
            }
            
        }

        $prev_next_links['prev'] = $prev;
        $prev_next_links['next'] = $next;
        return $prev_next_links;
    }

    

    function _get_project_collaborators($project_id) {
        $rows = $this->model->get_where_custom('projects_id', $project_id, '=', 'id', 'associated_projects_and_collaborators');
        $collaborators = [];
        foreach($rows as $row) {
          $collaborators[] = $row->collaborators_id;
        }
        return $collaborators;
    }

    function tag() {

        $tag_string = segment(3);

        $data['tag_obj'] = $this->model->get_one_where('url_string', $tag_string, 'tags');
        $tag_id = $data['tag_obj']->id;
    
        if ($data['tag_obj'] == false) {
            $this->not_found();
        } else {
    
        $tags = $this->model->get('id', 'tags');
    
        $total_rows = $this->_get_tag_projects($tag_id, false);
    
        $data['tags'] = $tags;
        $data['total_rows'] = $total_rows;
      
        $data['image_path'] = BASE_URL.'src/img/pic01.jpg';
    
        $meta_data = $this->_get_tag_settings($data['tag_obj']);
        $data['page_title'] = $meta_data['page_title'];
        $data['meta_description'] = $meta_data['meta_description'];
        $data['meta_keywords'] = $meta_data['meta_keywords'];
        $additional_includes_top[] = BASE_URL.'src/css/stylework.css';
        $additional_includes_top[] = BASE_URL.'src/css/styleprojects.css';
        $data['additional_includes_top'] = $additional_includes_top;
    
        if($total_rows>0) {
            $rows = $this->_get_tag_projects($tag_id, true);
            $data['projects'] =  $rows;
    
            $data['template'] = 'design_template';
            $data['pagination_root'] = 'projects/tag/'.$tag_string;
            $data['total_rows'] = $total_rows ;
            $data['offset'] = $this->get_offset_cat();
            $data['limit'] = $this->get_limit();
            $data['include_showing_statement'] = false;
            $data['page_num_segment'] = 4;
            $data['num_links_per_page'] = 3;
    
        } else {
            $data['no_projects'] = 'No projects yet'; 
        }
        $data['headline'] = $data['tag_obj']->tag_name;
    
        $data['class'] = 'class="our-work"';
        $data['view_module'] = 'projects';
        $data['view_file'] = 'tag';
        $this->template('design_template', $data);
      }
    }

    function _get_tag_projects($tag_id, $limit_results = NULL) {
        $params['tag_id'] = $tag_id; 
        if($limit_results == false) {
           
            $sql = 'SELECT 
                projects.id as project_id
                FROM
                tags
                JOIN associated_projects_and_tags
                ON associated_projects_and_tags.tags_id = :tag_id
                JOIN projects              
                ON associated_projects_and_tags.projects_id = projects.id
                AND projects.live_on_website = 1
                WHERE tags.id = :tag_id               
                ';
    
            $rows = $this->model->query_bind($sql, $params, 'object');
        
            if (empty($rows)) {
             $results = 0;   
            } else {
             $results = count($rows);
            }          
    
        } else {
            $pagination_data['offset'] = $this->get_offset_cat();
            $pagination_data['limit'] = $this->get_limit();
    
    
            $sql = 'SELECT
                projects.id as project_id,
                projects.project_title,
                projects.project_name,
                projects.picture,
                projects.url_string
                FROM
                tags
                JOIN associated_projects_and_tags
                ON associated_projects_and_tags.tags_id = :tag_id
                JOIN projects              
                ON associated_projects_and_tags.projects_id = projects.id
                AND projects.live_on_website = 1
                WHERE tags.id = :tag_id
            ORDER BY 
            projects.cost_from desc
            LIMIT [offset], [limit] 
            ';
            $sql = str_replace('[offset]',$pagination_data['offset'], $sql);
            $sql = str_replace('[limit]',$pagination_data['limit'], $sql);
    
            $rows = $this->model->query_bind($sql, $params, 'object');
            foreach ($rows as $project) {
                $row_data['project_id'] = $project->project_id;
                $row_data['project_title'] = $project->project_title;
                $row_data['project_name'] = $project->project_name;
                $row_data['url_string'] = $project->url_string;
                $row_data['picture'] = $project->picture;
    
                $data[] = (object) $row_data;
            }
            $results =  $data;    
        }
        return $results;
    }
    
    function _get_tag_settings($tag_obj) {
        $meta_data['page_title'] = $tag_obj->tag_name;
        $meta_data['page_title'].= ' Projects designed by ';
        $description = ' where we are using different types of this.';
        $meta_description = 'Look to our ';
        $meta_description.= $meta_data['page_title'];
        $meta_description.= ' Landscape Architecture Projects ';
        $meta_description.= $description;
    
        $meta_data_description = '';
    
        $total_length = 0;
        $sentences = explode('. ', $meta_description);
        foreach($sentences as $sentence) {
            $sentence_length = strlen($sentence);
            $total_length = $total_length+$sentence_length;
           
            if ($total_length<160) {
                $meta_data_description.= $sentence.'. ';
            }
    
        }
        $meta_data['meta_description'] = $meta_data_description;
        $meta_data['meta_keywords'] = $tag_obj->tag_name;
        $meta_data['meta_keywords'].= ' project, Landscape, Landscape Architecture ';
    
        $words = explode(' ', $tag_obj->tag_name);
        foreach($words as $word) {
            $meta_data['meta_keywords'].= ', '.$word;
        }
    
        return $meta_data;
        
    
    }

    function _get_tags($project_id) {
        $tags_results = $this->model->get_many_where('projects_id', $project_id, 'associated_projects_and_tags');
        if ($tags_results == false){
            $tags_print = [];
        } else {
            $this->module('tags');
            $tags_print = [];
            foreach ($tags_results as $key => $value) {
              $tags_print[$key] = $this->_get_tag_name($tags_results[$key]->tags_id);  

            }
        }  
        
        return $tags_print;
    }

    function _get_tag_name($tags_id) {
        $tag_c = $this->model->get_one_where('id', $tags_id, 'tags');
        if ($tag_c == true){
            $tag = $tag_c->tag_name;
        } else {
            $tag = "";
        }        
        return $tag;
    }
    

    function not_found() {
        $data['view_module'] = 'projects';
        $data['view_file'] = 'not_found';
        $this->template('design_template', $data);

    }

    function lookbooks() {
        $url_string = segment(3);
        $data['project_obj'] = $this->model->get_one_where('url_string', $url_string, 'projects');
        if ($data['project_obj'] == false) {
            $this->not_found();
        } else {

        
        $data['no_picture'] = BASE_URL.'src/img/pic01.jpg';
        if($data['project_obj']->picture != '') {
            $data['picture_path'] = '/'.$data['project_obj']->id.'/'.$data['project_obj']->picture;
        } else {
            $data['picture_path'] = $data['no_picture'];           
        }
        if($data['project_obj']->issuu_code != '') {
            $data['html_issuu'] = $this->_get_projects_issuu_html($data);
        } else {
            $data['html_issuu'] = '';
        }
        $description = $data['project_obj']->project_description;
        if(strlen($description>1)) {
            if(strlen($description>252)){
                $data['description1'] = substr($description,0,252);
                $data['description2'] = substr($description,253, strlen($description));
            } else {
                $data['description1'] = $data['project_obj'];
                $data['description2'] = '';
            }
        } else {
            $data['description1'] = '';
            $data['description2'] = '';
        }
        $data['categories'] = $this->_get_categories($data['project_obj']->id, true);
        $data['published_time'] = date('Y-m-d\TH:m:s+00:00', $data['project_obj']->date_created);

        $data['partners_area'] = $this->_get_collaborators_areas($data['project_obj']->id);

        $data['partners_name'] = $this->_get_collaborator_collaborators($data['project_obj']->id);

        $data['tags'] = $this->_get_tags($data['project_obj']->id);

        $prev_next_projects = $this->_get_prev_next($data['project_obj']->id);

        $data['prev_link'] = $prev_next_projects['prev'];
        $data['next_link'] = $prev_next_projects['next'];
        $this->module('pictures');
        $data['pictures'] = $this->pictures->_get_pictures_module($data['project_obj']->id, 'projects');

        if($data['pictures'] == true) {
            $data['gallery_dir'] = BASE_URL.'pictures/projects_pictures/'.$data['project_obj']->id.'/';
        }
                 
        $meta_data = $this->_build_meta_data($data);
        $data['page_title'] = $meta_data['page_title'];
        $data['meta_description'] = $meta_data['meta_description'];
        $data['meta_keywords'] = $meta_data['meta_keywords'];
        $data['image_path'] = BASE_URL.'pictures/projects_pics_media'.$data['picture_path'];
        $data['og_type'] = 'article';
        $additional_includes_top[] = BASE_URL.'src/css/styleprojects.css';
        $data['additional_includes_top'] = $additional_includes_top;
        $data['class'] = 'class="news-example"';
        $data['view_file'] = 'lookbook';
        $this->template('design_template', $data);
       }

    }

    function _get_projects_issuu_html($data) {

        $projects_issuu_html = $this->view('single_project_issuu', $data, true);

        return $projects_issuu_html;
    }


    function _get_categories($value, $our_project) {
        $categories_result = $this->model->get_many_where('projects_id', $value, 'associated_projects_and_categories');
        if ($categories_result == false){
            $categories_print = [];
        } else {
            $this->module('categories');
            $categories_print = [];
            foreach ($categories_result as $key => $value) {
              $categories_print[$key] = $this->_get_category($categories_result[$key]->categories_id, $our_project);             
            }
        }  
        
        return $categories_print;
    }

    function _get_category($categories_id, $our_project) {
        $category_c = $this->model->get_one_where('id', $categories_id, 'categories');
        if ($category_c == true){
            if($our_project == true) {
                $category = $category_c->category_name;
            } else {
                $category = '<a href="<?= BASE_URL ?>categories/show/'.$category_c->id.'" class="button-small">'.$category_c->category_name.'</a>';
            }
            
        } else {
            $category = "";
        }        
        return $category;
    }

    function _get_clients($value) {
        $clients_result = $this->model->get_many_where('projects_id', $value, 'associated_projects_and_clients');
        if ($clients_result == false){
            $clients_print = [];
        } else {
            $this->module('clients');
            $clients_print = [];
            foreach ($clients_result as $key => $value) {
              $clients_print[$key] = $this->_get_client($clients_result[$key]->clients_id);             
            }
        }  
        
        return $clients_print;
    }

    function _get_client($clients_id) {
        $client_c = $this->model->get_one_where('id', $clients_id, 'clients');
        if ($client_c == true){
            $client = '<a href="<?= BASE_URL ?>clients/show/'.$client_c->id.'" class="button-small">'.$client_c->client_name.'</a>';
        } else {
            $client = "";
        }        
        return $client;
    }
    
    function our_work() {
        
        $categories = $this->model->get('id', 'categories');

        $total_rows = $this->_get_projects(false);

        $data['categories'] = $categories;
        $data['total_rows'] = $total_rows;

        $texts = $this->model->get_where(3, 'sections_texts');
        $data['title'] = $texts->title;
        $data['page_content'] = $texts->page_content;
        $data['page_title'] = $texts->page_title;
        $data['meta_description'] = $texts->meta_description;
        $data['meta_keywords'] = $texts->meta_keywords;

        $data['no_picture'] = BASE_URL.'src/img/pic01.jpg';
        $data['image_path'] = BASE_URL.'src/img/contact_web.jpg';
       
        $additional_includes_top[] = BASE_URL.'src/css/stylework.css';
        $additional_includes_top[] = BASE_URL.'src/css/styleprojects.css';
        $data['additional_includes_top'] = $additional_includes_top;

        if($total_rows>0) {
            $rows = $this->_get_projects(true);
            $data['projects'] =  $rows;

            $data['template'] = 'design_template';
            $data['target_base_url'] = $this->get_target_pagination_base_url();
            $data['total_rows'] = $total_rows ;
            $data['offset'] = $this->get_offset();
            $data['limit'] = $this->get_limit();
            $data['include_showing_statement'] = false;
            $data['num_links_per_page'] = 3;
        } else {
            $data['no_projects'] = 'No projects yet'; 
        }

        $data['class'] = 'class="our-work"';
        $data['view_module'] = 'projects';
        $data['view_file'] = 'projects';
        $this->template('design_template', $data);
    }

    function _get_projects($limit_results = NULL) {
        if($limit_results == false) {
            $sql = 'SELECT
            projects.id 
            FROM
            projects
            WHERE 
            projects.live_on_website = 1';
            $rows = $this->model->query($sql, 'object');
            if (empty($rows)) {
             $results = 0;   
            } else {
             $results = count($rows);
            }          

        } else {
            $pagination_data['offset'] = $this->get_offset();
            $pagination_data['limit'] = $this->get_limit();

            $sql = 'SELECT
            projects.id, 
            projects.project_title,
            projects.project_name,
            projects.url_string,
            projects.issuu_code,
            projects.picture
            FROM
            projects
            WHERE 
            projects.live_on_website = 1
            ORDER BY 
            projects.final_cost desc,
            projects.id 
            LIMIT [offset], [limit] 
            ';
            $sql = str_replace('[offset]',$pagination_data['offset'], $sql);
            $sql = str_replace('[limit]',$pagination_data['limit'], $sql);

            $rows = $this->model->query($sql, 'object');
            foreach ($rows as $project) {
                $row_data['project_id'] = $project->id;
                $row_data['project_title'] = $project->project_title;
                $row_data['project_name'] = $project->project_name;
                $row_data['issuu_code'] = $project->issuu_code;
                $row_data['url_string'] = $project->url_string;
                $row_data['picture'] = $project->picture;
                $row_data['categories'] = $this->_get_categories($project->id, false);
    
                $data[] = (object) $row_data;
            }
            $results =  $data;    
        }
        return $results;
    }

    function get_target_pagination_base_url() {

        $first_bit = segment(1);   //our_work
        $second_bit = segment(2);  
        $target_base_url = BASE_URL.$first_bit."/".$second_bit;

         return $target_base_url;
    }

    function get_limit() {
        if((isset($_SESSION['screen_width'])) && ($_SESSION['screen_width'] < 999 )) {
            $limit =8;
        } else {
            $limit =9;
        }
        
        return $limit;
    }

    function get_offset() {
        $page_num = segment(3);

        if(!is_numeric($page_num)) {
            $page_num = 0;
        } 
        if($page_num>1) {
          
            $offset = ($page_num-1)*$this->get_limit();
        } else {
            $offset = 0;
        }
        return $offset;
    }


    function _init_filezone_settings() {
        $data['targetModule'] = 'projects';
        $data['destination'] = 'pictures/projects_pictures';
        $data['destination_media'] = 'pictures/projects_pictures_media';
        $data['destination_thumb'] = 'pictures/projects_pictures_thumb';
        $data['max_file_size'] = 5000;
        $data['max_width'] = 2500;
        $data['max_height'] = 1667;
        $data['max_width_media'] = 1500;
        $data['max_width_thumb'] = 900;
        return $data;
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
            $data['headline'] = 'Update Project Record';
            $data['cancel_url'] = BASE_URL.'projects/show/'.$update_id;
        } else {
            $data['headline'] = 'Create New Project Record';
            $data['cancel_url'] = BASE_URL.'projects/manage';
        }

        $data['form_location'] = BASE_URL.'projects/submit/'.$update_id;
        $data['view_file'] = 'create';
        $this->template('admin', $data);
    }

    function manage() {
        $this->module('trongate_security');
        $this->trongate_security->_make_sure_allowed();

        if (segment(4) !== '') {
            $data['headline'] = 'Search Results';
            $searchphrase = trim($_GET['searchphrase']);
            $params['project_title'] = '%'.$searchphrase.'%';
            $params['project_name'] = '%'.$searchphrase.'%';
            $params['location'] = '%'.$searchphrase.'%';
            $params['project_folder'] = '%'.$searchphrase.'%';
            $params['best_pic_folder'] = '%'.$searchphrase.'%';
            $sql = 'select * from projects
            WHERE project_title LIKE :project_title
            OR project_name LIKE :project_name
            OR location LIKE :location
            OR project_folder LIKE :project_folder
            OR best_pic_folder LIKE :best_pic_folder
            ORDER BY id desc';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
        } else {
            $data['headline'] = 'Manage Projects';
            $all_rows = $this->model->get('id desc');
        }

        $pagination_data['total_rows'] = count($all_rows);
        $pagination_data['page_num_segment'] = 3;
        $pagination_data['limit'] = $this->_get_limit();
        $pagination_data['pagination_root'] = 'projects/manage';
        $pagination_data['record_name_plural'] = 'projects';
        $pagination_data['include_showing_statement'] = true;
        $data['pagination_data'] = $pagination_data;

        $data['rows'] = $this->_reduce_rows($all_rows);

        $data['selected_per_page'] = $this->_get_selected_per_page();
        $data['per_page_options'] = $this->per_page_options;
        $data['view_module'] = 'projects';
        $data['view_file'] = 'manage';
        $this->template('admin', $data);
    }

    function show() {
        $this->module('trongate_security');
        $token = $this->trongate_security->_make_sure_allowed();
        $update_id = segment(3);

        if ((!is_numeric($update_id)) && ($update_id != '')) {
            redirect('projects/manage');
        }


        $data = $this->_get_data_from_db($update_id);

        
        if(($data['start_date'] == '0000-00-00') || ($data['start_date'] == NULL)) {
            $data['start_date'] = '';
        } else {
            $data['start_date'] = $this->_date_to_words($data['start_date']);
        }
        if(($data['finish_date'] == '0000-00-00') || ($data['finish_date'] == NULL)) {          
            $data['finish_date'] = '';
        } else {
            $data['finish_date'] = $this->_date_to_words($data['finish_date']);
        }
        $data['live_on_website'] = ($data['live_on_website'] == 1 ? 'YES' : 'NO');
        $data['postcard'] = ($data['postcard'] == 1 ? 'YES' : 'NO');
        $data['token'] = $token;

        if ($data == false) {
            redirect('projects/manage');
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
            $data['headline'] = 'Project Information';
            $data['filezone_settings'] = $this->_init_filezone_settings();
            $data['view_file'] = 'show';
            $this->template('admin', $data);
        }
    }

    function _date_to_words($date) {
        $date = date('l, F jS Y', strtotime($date));
        return $date;
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
                $row->live_on_website = ($row->live_on_website == 1 ? 'YES' : 'NO');
                $row->postcard = ($row->postcard == 1 ? 'YES' : 'NO');
                $row->start_date = ($row->start_date == '0000-00-00' ? ' ' : date('m\/d\/Y', strtotime($row->start_date)));
                $row->finish_date = ($row->finish_date == '0000-00-00' ? ' ' : date('m\/d\/Y', strtotime($row->finish_date)));
                $row->categories = $this->_get_categories($row->id, false);
                $row->clients = $this->_get_clients($row->id);
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

            $this->validation_helper->set_rules('project_title', 'Project Title', 'required|min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('project_name', 'Project Name', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('location', 'Location', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('project_description', 'Project Description', 'min_length[2]');
            $this->validation_helper->set_rules('issuu_code', 'Project Description', 'min_length[8]');
            $this->validation_helper->set_rules('start_date', 'Start Date', 'valid_datepicker_us');
            $this->validation_helper->set_rules('finish_date', 'Finish Date', 'valid_datepicker_us');
            $this->validation_helper->set_rules('project_folder', 'Project Folder', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('best_pic_folder', 'Best Pic Folder', 'min_length[2]|max_length[255]');
            $this->validation_helper->set_rules('cost_from', 'Cost From', 'max_length[11]|numeric|integer');
            $this->validation_helper->set_rules('cost_to', 'Cost To', 'max_length[11]|numeric|integer');
            $this->validation_helper->set_rules('final_cost', 'Final Cost', 'max_length[11]|numeric|integer');


            $result = $this->validation_helper->run();

            if ($result == true) {

                $update_id = segment(3);
                $data = $this->_get_data_from_post();
                $data['url_string'] = strtolower(url_title($data['project_title']));
                $data['live_on_website'] = ($data['live_on_website'] == 1 ? 1 : 0);
                $data['postcard'] = ($data['postcard'] == 1 ? 1 : 0);
                if(($data['finish_date'] != '') && ($data['finish_date'] != NULL) && ($data['finish_date'] != '0000-00-00') ) {
                    $data['finish_date'] = date('Y-m-d', strtotime($data['finish_date']));
                }

                if($data['start_date'] != '') {
                    $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
                }

                if (is_numeric($update_id)) {
                    //update an existing record
                    $this->model->update($update_id, $data, 'projects');
                    $flash_msg = 'The record was successfully updated';
                } else {
                    //insert the new record
                    $data['date_created'] = time();
                    $update_id = $this->model->insert($data, 'projects');
                    $flash_msg = 'The record was successfully created';
                }

                set_flashdata($flash_msg);
                redirect('projects/show/'.$update_id);

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

            $this->_delete_pictures_from_project($params['update_id']);

            //delete all of the comments associated with this record
            $sql = 'delete from trongate_comments where target_table = :module and update_id = :update_id';
            $params['module'] = 'projects';
            $this->model->query_bind($sql, $params);

            //delete the record
            $this->model->delete($params['update_id'], 'projects');

            //set the flashdata
            $flash_msg = 'The record was successfully deleted';
            set_flashdata($flash_msg);

            //redirect to the manage page
            redirect('projects/manage');
        }
    }

    function _delete_pictures_from_project($prop_id) {

        $sql = "SELECT id, picture_name FROM pictures WHERE target_module = 'projects' AND target_module_id = ".$prop_id." ";
        $fotografias = $this->model->query($sql);

        if(!empty($fotografias)) {
            foreach($fotografias as $foto) {
                $target_file = 'pictures/projects_pictures/'.$prop_id.'/'.$foto['picture_name'];
                if (file_exists($target_file)) {
                    unlink($target_file);                     
                }
    
                $target_file_media = 'pictures/projects_pictures_media/'.$prop_id.'/'.$foto['picture_name'];
                if (file_exists($target_file_media)) {
                    unlink($target_file_media);                     
                }

                $target_file_thumb = 'pictures/projects_pictures_thumb/'.$prop_id.'/'.$foto['picture_name'];
                if (file_exists($target_file_thumb)) {
                    unlink($target_file_thumb);                     
                }
    
                $this->model->delete($foto['id'], 'pictures');
               
            }
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
        redirect('projects/manage');
    }

    function _get_data_from_db($update_id) {
        $record_obj = $this->model->get_where($update_id, 'projects');

        if ($record_obj == false) {
            $this->template('error_404');
            die();
        } else {
            $data = (array) $record_obj;
            return $data;        
        }
    }

    function _get_data_from_post() {
        $data['project_title'] = post('project_title', true);
        $data['project_name'] = post('project_name', true);
        $data['location'] = post('location', true);
        $data['project_description'] = post('project_description', true);
        $data['issuu_code'] = post('issuu_code', true);
        $data['start_date'] = post('start_date', true);
        $data['finish_date'] = post('finish_date', true);
        $data['project_folder'] = post('project_folder', true);
        $data['best_pic_folder'] = post('best_pic_folder', true);
        $data['postcard'] = post('postcard', true);
        $data['cost_from'] = post('cost_from', true);
        $data['cost_to'] = post('cost_to', true);
        $data['final_cost'] = post('final_cost', true);
        $data['date_created'] = post('date_created', true);
        $data['live_on_website'] = post('live_on_website', true);        
        return $data;
    }

    function _init_picture_settings() { 
        $picture_settings['max_file_size'] = 5000;
        $picture_settings['max_width'] = 5000;
        $picture_settings['max_height'] = 5000;
        $picture_settings['resized_max_width'] = 2500;
        $picture_settings['resized_max_height'] = 1667;
        $picture_settings['destination'] = 'pictures/projects_pics';
        $picture_settings['target_column_name'] = 'picture';
        $picture_settings['destination_media'] = 'pictures/projects_pics_media';
        $picture_settings['media_max_width'] = 1500;
        $picture_settings['media_max_height'] = 1000;
        $picture_settings['destination_thumb'] = 'pictures/projects_pics_thumbnails';
        $picture_settings['thumbnail_max_width'] = 900;
        $picture_settings['thumbnail_max_height'] = 600;
        return $picture_settings;
    }

    function _make_sure_got_destination_folders($update_id, $picture_settings) {
        $destination = $picture_settings['destination'];
        $target_dir = APPPATH.'public/'.$destination.'/'.$update_id;

        if (!file_exists($target_dir)) {
            //generate the image folder
            mkdir($target_dir, 0777, true);
        }

        //attempt to create media directory
        $destination_media = trim($picture_settings['destination_media']);

        if (strlen($destination_media)>0) {
            $target_dir = APPPATH.'public/'.$destination_media.'/'.$update_id;
            if (!file_exists($target_dir)) {
                //generate the image folder
                mkdir($target_dir, 0777, true);
            }
        }

        //attempt to create thumbnail directory
        $destination_thumb = trim($picture_settings['destination_thumb']);

        if (strlen($destination_thumb)>0) {
            $target_dir = APPPATH.'public/'.$destination_thumb.'/'.$update_id;
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

                if ($destination_media !== '') {
                    $config['destination_media'] = $destination_media.'/'.$update_id;
                    $config['media_max_width'] = $media_max_width;
                    $config['media_max_height'] = $media_max_height;
                }

                if ($destination_thumb !== '') {
                    $config['destination_thumb'] = $destination_thumb.'/'.$update_id;
                    $config['thumbnail_max_width'] = $thumbnail_max_width;
                    $config['thumbnail_max_height'] = $thumbnail_max_height;
                }

                //upload the picture
                $this->upload_pic($config);

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

        if (isset($picture_settings['destination_media'])) {
            $media_path = $picture_settings['destination_media'].'/'.$update_id.'/'.$picture_name;
            if (file_exists($media_path)) {
                unlink($media_path);
            }
        }

        if (isset($picture_settings['destination_thumb'])) {
            $thumbnail_path = $picture_settings['destination_thumb'].'/'.$update_id.'/'.$picture_name;
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

    public function upload_pic($data) {
        //check for valid image width and mime type
        $userfile = array_keys($_FILES)[0];
        $target_file = $_FILES[$userfile];

        $dimension_data = getimagesize($target_file['tmp_name']);
        $image_width = $dimension_data[0];

        if (!is_numeric($image_width)) {
            die('ERROR: non numeric image width');
        }

        $content_type = mime_content_type($target_file['tmp_name']);

        $str = substr($content_type, 0, 6);
        if ($str !== 'image/') {
            die('ERROR: not an image.');
        }

        $tmp_name = $target_file['tmp_name'];
        $data['image'] = new Image($tmp_name);
        $data['filename'] = '../public/'.$data['destination'].'/'.$target_file['name'];
        $data['tmp_file_width'] = $data['image']->getWidth();
        $data['tmp_file_height'] = $data['image']->getHeight();

        if (!isset($data['max_width'])) {
            $data['max_width'] = NULL;
        }

        if (!isset($data['max_height'])) {
            $data['max_height'] = NULL;
        }

        $this->save_that_pic($data);
       
        //rock the media
        if ((isset($data['media_max_width'])) && (isset($data['media_max_height'])) && (isset($data['destination_media']))) {
            $data['filename'] = '../public/'.$data['destination_media'].'/'.$target_file['name'];
            $data['max_width'] = $data['media_max_width'];
            $data['max_height'] = $data['media_max_height'];
            $this->save_that_pic($data);
        }

        //rock the thumbnail
        if ((isset($data['thumbnail_max_width'])) && (isset($data['thumbnail_max_height'])) && (isset($data['destination_thumb']))) {
            $data['filename'] = '../public/'.$data['destination_thumb'].'/'.$target_file['name'];
            $data['max_width'] = $data['thumbnail_max_width'];
            $data['max_height'] = $data['thumbnail_max_height'];
            $this->save_that_pic($data);
        }
    }

    private function save_that_pic($data) {
        extract($data);
        $reduce_width = false;
        $reduce_height = false;

        if (!isset($data['compression'])) {
            $compression = 100;
        } else {
            $compression = $data['compression'];
        }

        if (!isset($data['permissions'])) {
            $permissions = 775;
        } else {
            $permissions = $data['permissions'];
        }

        //do we need to resize the picture?
        if ((isset($max_width)) && ($tmp_file_width>$max_width)) {
            $reduce_width = true;
            $resize_factor_w = $tmp_file_width / $max_width;
        }

        if ((isset($max_height)) && ($tmp_file_width>$max_height)) {
            $reduce_height = true;
            $resize_factor_h = $tmp_file_height / $max_height;
        }        

        if ((isset($resize_factor_w)) && (isset($resize_factor_h))) {
            if ($resize_factor_w > $resize_factor_h) {
                $reduce_height = false;
            } else {
                $reduce_width = false;
            }
        }

        //either do the height resize or the width resize - never both
        if ($reduce_width == true) {
            $image->resizeToWidth($max_width);
        } elseif($reduce_height == true) {
            $image->resizeToHeight($max_height);
        }

        $image->save($filename, $compression);
    }
}