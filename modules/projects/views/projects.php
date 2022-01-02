<div  class="landing">
    <h1> Projects </h1>
</div>
        
<section class="projects-nav"> 
    <ul>
        <?php 
        foreach ($categories as $categorie) {
          
            $link = BASE_URL.'projects/categories/'.$categorie->url_string;
            
            if(( $segmento2 == 'projects') && ($categorie->category_name == 'Featured')) {
                $class_active = 'class="active"';
            } else {
                $class_active = '';
            }
            
         ?>
         
         <li <?= $class_active ?> >
            <a href="<?= $link ?>">              
                <?= $categorie->category_name ?>
            </a>
         </li>

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
        

        if(!isset($project->categories[0]) || ($project->categories[0] == '')){
            $project_category = '';
        } else {
            $project_category = $project->categories[0];
        }

        if($is_lookbook == 1) {
            $project_url = BASE_URL.'projects/lookbooks/'.$project->url_string; 
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
            <h2><?= $project->project_title ?>  </h2> 
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
            <h2>  <?= $project->project_title ?></h2> 
        </div> 
        
    </a>
        
</div>  
<?php } ?>
<?php } ?>
</section> 

<section class=" border-top">
<?php
        unset($data['include_showing_statement']);
        echo Pagination::display($data);
        } else { echo $no_projects;}
        ?>


</section>
<style>

    .projects {
        overflow-y: scroll;
        height: auto;
    }
</style>


<script>
var baseUrl = '<?= BASE_URL ?>';
let page = 1;
let rows = 2;
let botones = 3;
const width = window.screen.width;
var imagePath = '<?= $image_path ?>'


function submitSearch(cat_id){

    document.getElementById("showProjects").innerHTML = '';

    localStorage.setItem("category", cat_id);

    var target_url = baseUrl + 'projects/api_projects_categories/' + cat_id;

    const http = new XMLHttpRequest()
    http.open('GET', target_url)
    http.setRequestHeader('Content-type', 'application/json')
    http.send()
    http.onload = function () {

        var projects = JSON.parse(http.responseText);

        var data = pagination(projects,page, rows);

        projects = data.querySet;

        var projectsRecord = '';

        for (var i = 0; i < projects.length; i++) {
            projects[i];

            var projectUrl = baseUrl + 'projects/our_project/' + projects[i]['project_url'];
            if(projects[i]['picture'] != '') {
                if(width > 792) {
                    var picturePath = baseUrl + 'projects_pics/' + projects[i]['project_id'] + '/' + projects[i]['picture'];
                } else {
                    var picturePath = baseUrl + 'projects_pics_thumbnails/' + projects[i]['project_id'] + '/' + projects[i]['picture'];
                }
                
            } else {
                var picturePath = imagePath;           
            }
            let newRecord = '<section class=" project"><a href="' + projectUrl + '" target="_blank" ><div class="project-title"><h2>' + projects[i]['project_title'] + '</h2></div><div class="hero-img"><img src="' + picturePath + '" alt="' + projects[i]['project_title'] + '"></div></a></section>';

            projectsRecord = projectsRecord.concat(newRecord);
            var newCategory = projects[i]['category_name'];
        }

        if (projects.length>0) {
              
              document.getElementById("showProjects").innerHTML = projectsRecord;
              document.getElementById("categoryTitle").innerHTML = '';
              document.getElementById("categoryTitle").innerHTML = newCategory;

              pageButtons(data.pages, page);

          } else {
            document.getElementById("showProjects").innerHTML = 'We have no projets in this category yet....';
          }

        }
    }

   function pagination(querySet, page, rows) {

        var trimStart = (page - 1) * rows;
        var trimEnd = trimStart + rows;
        var pages = Math.ceil(querySet.length / rows);
        var trimmedData = querySet.slice(trimStart,trimEnd);

        return{
        'querySet': trimmedData,
        'pages': pages
        }
     }

function pageButtons(pages,page) {

    var wrapper = document.getElementById('paginar');
    wrapper.innerHTML = '';

    var maxLeft = (page - Math.floor(botones /2));
    var maxRight = (page + Math.floor(botones /2));

    if (maxLeft < 1) {
    maxLeft = 1;
    maxRight = botones;
    }

    if (maxRight > pages) {
    maxLeft = pages - (botones -1);
    maxRight = pages;

    if(maxLeft < 1) {
        maxLeft = 1;
    }
    }

    if (page != 1){
    wrapper.innerHTML = `<a onclick="getInputValue(1)" id="page-1" >&laquo;</a>`;
    }

    for (var page = maxLeft; page <=maxRight; page ++) {
    wrapper.innerHTML += `<a onclick="getInputValue(${page})" id="page-${page}">${page}</a>`;
    }

    if (page != pages){
    wrapper.innerHTML += `<a onclick="getInputValue(${page})" id="page-${page}">&raquo;</a>`;
    }

}

function getInputValue(pageSelected){

    page = pageSelected;
    document.getElementById("showProjects").innerHTML = '';
    var category_id = localStorage.getItem('category');
    submitSearch(category_id);
}

  

</script>