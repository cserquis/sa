<div  class="landing">
    <h1><?= $headline ?>  </h1>           
</div>
        
<section  class="projects-nav">  
        <ul>
        <?php 
        foreach ($categories as $categorie) {
            $link = BASE_URL.'projects/categories/'.$categorie->url_string;
            if( $segmento3 == $categorie->url_string) {
                $class_active = 'class="active"';
            } else {
                $class_active = '';
            }

         ?>
            <li <?= $class_active ?>><a href="<?= $link ?>">  
        
            <?= $categorie->category_name ?></a></li>
            <?php } ?>
                      
        </ul>   
</section>
<section class="projects-container">
<?php 
if ($total_rows>0) { 

    foreach ($projects as $project) {
        if($project->picture != '') {
            $picture_path_big = BASE_URL.'pictures/projects_pics_media/'.$project->project_id.'/'.$project->picture;
            $picture_path_small = BASE_URL.'pictures/projects_pics_thumbnails/'.$project->project_id.'/'.$project->picture;
        } else {
            $picture_path_big = $no_picture;   
            $picture_path_small = $no_picture;         
        }   

        $project_categories = $project->categories;
        $is_lookbook = 0;
        foreach($project_categories as $p_category) {
           
            if($p_category == 'Lookbooks') {
                $is_lookbook = 1;
            }
            
        }

        if($is_lookbook == 1) {
            $project_url = BASE_URL.'our_work/lookbooks/'.$project->url_string; 
        } else {
            $project_url = BASE_URL.'projects/our_project/'.$project->url_string;
        }   
?>

<?php if($width > 2000) { ?>

<div class="project">
            
    <a href="<?= $project_url ?>"  >
        <div class="project-img">
            <img  src="<?= $picture_path_big ?>" alt="S+A <?= $project->project_title ?>"> 
                
        </div>
        <div class="project-title">     
            <h2><?= $project->project_title ?></h2> 
        </div> 
        
    </a>
        
</div>  
<?php } else {?>

<div class="project">
            
    <a href="<?= $project_url ?>"  >
        <div class="project-img">
            <img  src="<?= $picture_path_small ?>" alt="S+A <?= $project->project_title ?>"> 
                
        </div>
        <div class="project-title">     
            <h2><?= $project->project_title ?></h2> 
        </div> 
        
    </a>
        
</div>  
<?php }  ?>
<?php  } ?>
</section>
    <section class=" border-top">
    <?php
            unset($data['include_showing_statement']);
            echo Pagination::display($data);
            } else { echo $no_projects;}
            ?>
    
    
    </section>


<style>


.projects-nav ul li:active a {
    color: var(--primary-color);
}
</style>