<section  class="landing border-bottom">
    <div>	
        <p><?php if(($project_obj->start_date != NULL) && ($project_obj->start_date != '0000-00-00')) { echo strtoupper( $project_obj->start_date); }?>  </p>
    <h1><?= $project_obj->project_title ?></h1>
    <h4><?= $project_obj->location ?></h4>

    </div>
</section>
<section class="photos-project ">

    <?= $html_issuu ?>
                    
</section> 
<section class="info project-example-description border-bottom">
    
    <div class="news-content sun-editor-editable">
    <p>
    <?php if($description1 != '') {
            echo nl2br($description1);
        } ?>
        <?php if($description2 != '') { ?>
        <span id="dots">...</span>
        <span id="more">
        <?= nl2br($description2) ?>
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
    $pic_path = $gallery_dir.$picture->picture_name;
    $alt_text = $project_title.' - '.$count;

    echo '<div class="photo" data-aos="fade-up"  data-aos-duration="3000"><img src="'.$pic_path.'" alt="S+A '.$alt_text.'"></div>';		
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

foreach ($partners_area as $co) {
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
            <a href="<?= BASE_URL ?>projects/our_work" class="button-small">Back to Projects</a>
            </div>
        <a href="<?= $next_link ?>" class="next"><p class="pagination-tag"> next &nbsp; </p>&raquo;</a>
      </div>
</section>

<section class="border-top">
    <ul class="social-media">
    <?php 
       

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
        $view_new = BASE_URL.'projects/lookbooks/'.$project_obj->url_string;
        
        ?>

        <div class="fb-share-button fb_iframe_widget"
            data-href="<?= $view_new ?>"
            data-layout="button_count" fb-xfbml-state="rendered"
            fb-iframe-plugin-query="app_id=&amp;container_width=0&amp;href=https%3A%2F%2F<?= $domain ?>%2F<?= $segment1 ?>%2F<?= $segment2 ?>%2F<?= $project_obj->url_string ?>&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey" target="_blank">
            <span style="vertical-align: bottom; width: 77px; height: 20px"><iframe name="f7d0a341284b7e"
                    width="1000px" height="1000px" data-testid="fb:share_button Facebook Social Plugin"
                    title="fb:share_button Facebook Social Plugin" frameborder="0" allowtransparency="true"
                    allowfullscreen="true" scrolling="no" allow="encrypted-media"
                    src="https://www.facebook.com/v3.0/plugins/share_button.php?app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df278e1a89f7bd7c%26domain%3D<?= $domain ?>%26origin%3Dhttps%253A%252F%252F<?= $domain ?>%252Ff3989f96af8d352%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2F<?= $domain ?>%2F<?= $segment1 ?>%2F<?= $segment2 ?>%2F<?= $project_obj->url_string ?>&amp;layout=button_count&amp;locale=en_US&amp;sdk=joey"
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

