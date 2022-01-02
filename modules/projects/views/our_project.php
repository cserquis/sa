
<section  class="landing landing-project-example full-overflow">
             
</section>

<style>

     @media screen and (max-width: 719px) {
        .landing-project-example {
            background-image: url(<?= BASE_URL ?>pictures/projects_pics_thumbnails<?= $picture_path ?>);
        }
    }
    @media (min-width: 720px) and  (max-width: 1899px){
        .landing-project-example {
            background-image: url(<?= BASE_URL ?>pictures/projects_pics_media<?= $picture_path ?>);
        }
    }
    @media  (min-width: 1900px) {
        .landing-project-example {
            background-image: url(<?= BASE_URL ?>pictures/projects_pics<?= $picture_path ?>);
        }
    }

    
</style>


<section class="info project-example-description  border-bottom">
<h1><?= $project_obj->project_title ?></h1> 
            
<div class="news-content sun-editor-editable">
    <p>
        <?php if($description1 != '') {
            echo $description1;
        } ?>
        <?php if($description2 != '') { ?>
        <span id="dots">...</span>
        <span id="more">
        <?= $description2 ?>
            read less</span>
            <a onclick="myFunction()" id="myBtn" class="button-small">Read more</a>
        <?php } ?>
        </p>
    </div>         
</section>
<section class="photos-project ">
    <?php 

    $project_title = $project_obj->project_title;

    $count = 0; 
    foreach($pictures as $picture) {
        $count++;

        if($width < 500) {
            $pic_path = BASE_URL.'pictures/projects_pictures_thumb/'.$project_obj->id.'/'.$picture->picture_name;
        } else {
            if($width > 1900) {
                $pic_path = BASE_URL.'pictures/projects_pictures/'.$project_obj->id.'/'.$picture->picture_name; 
            } else {
                $pic_path = BASE_URL.'pictures/projects_pictures_media/'.$project_obj->id.'/'.$picture->picture_name;  
            }
        }

        $alt_text = 'S+A '.$project_title.'-'.$count;

        echo '<div class="photo" data-aos="fade-up"  data-aos-duration="3000"><img src="'.$pic_path.'" alt="'.$alt_text.'"></div>';		
    }
    ?>
                     
</section> 
    
      
<section class="project-example-pagination"></section>
<section class="project-tags">
<?php 
    foreach ($categories as $category) {
        $category_url = strtolower(url_title($category));
?>
    <a href="<?= BASE_URL ?>projects/categories/<?= $category_url?>" class="category tags"><?= $category?></a> 
<?php } ?>

<?php 
    foreach ($tags as $tag) {
        $tag_url = strtolower(url_title($tag));
?>
    <a href="<?= BASE_URL ?>projects/tag/<?= $tag_url?>" class="category tags"><?= $tag?></a> 
<?php } ?>
</section>

<section class="collaborators">  

<?php 

foreach ($collaborators_area as $co) {
    $area = $co->area;
    $partner = $co->collaborator_name;

    echo '<p class="collaborator"><strong>'. $area .': </strong>'.  $partner .'</p>';
}


?>
</section>

<section class=" border-top">
    <div class="pagination">
        <a href="<?= $prev_link ?>" class="previous">&laquo;<p class="pagination-tag">&nbsp; preview </p></a>
        <div class="butons">
            <a href="<?= BASE_URL ?>our_work/projects" class="button-small">Back to Projects</a>
            </div>
        <a href="<?= $next_link ?>" class="next"><p class="pagination-tag"> next &nbsp; </p>&raquo;</a>
      </div>
</section>

<section class="border-top">
    <ul class="social-media">
        <?php 
/*         if($project_obj->link_to_houzz != '') {
            echo '<li><a href="'.$project_obj->link_to_houzz.'" target="_blank"><i class="fab fa-houzz"></i></a></li>';
        } */

        if((isset($project_obj->link_to_website)) && ($project_obj->link_to_website != '')) {  
            $globe_link = $project_obj->link_to_website;
        } else {
            if((isset($project_obj->issuu_link)) && ($project_obj->issuu_link != '')) {
                $globe_link = $project_obj->issuu_link;
            } else {
                $globe_link = '';
            }
        }

        if($globe_link != '') {
            echo '<li><a href="'.$globe_link.'" target="_blank"><i class="fab fa-font-awesome"></i></a></li>';
        }
            ?>
        
        <li>
        <?php 
        $domain = str_replace("http://", "", BASE_URL);
        $view_new = BASE_URL.'our_work/lookbooks/'.$project_obj->url_string;
        
        ?>

        <div class="fb-share-button fb_iframe_widget"
            data-href="<?= $view_new ?>"
            data-layout="button_count" fb-xfbml-state="rendered"
            fb-iframe-plugin-query="app_id=&amp;container_width=0&amp;href=https%3A%2F%2F<?= $domain ?>%2F<?= $segmento ?>%2F<?= $segmento2 ?>%2F<?= $project_obj->url_string ?>&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey" target="_blank">
            <span style="vertical-align: bottom; width: 77px; height: 20px"><iframe name="f7d0a341284b7e"
                    width="1000px" height="1000px" data-testid="fb:share_button Facebook Social Plugin"
                    title="fb:share_button Facebook Social Plugin" frameborder="0" allowtransparency="true"
                    allowfullscreen="true" scrolling="no" allow="encrypted-media"
                    src="https://www.facebook.com/v3.0/plugins/share_button.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df278e1a89f7bd7c%26domain%3D<?= $domain ?>%26origin%3Dhttps%253A%252F%252F<?= $domain ?>%252Ff3989f96af8d352%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2F<?= $domain ?>%2F<?= $segmento ?>%2F<?= $segmento2 ?>%2F<?= $project_obj->url_string ?>&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey"
                    class="" style="
            border: none;
            visibility: visible;
            width: 77px;
            height: 20px;
        "></iframe></span>
        </div>
        </li>
    </ul>
</section>