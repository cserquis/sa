<?php 
function draw_btn($btn_data) {
	extract($btn_data);

	$inner_btn_text = $count.' '.$entity_plural;

	if ($count>0) {
		//make dark green (teal) since we have more than one
		$attributes['class'] = 'w3-btn w3-tiny w3-teal';

		if ($count == 1) {
			$inner_btn_text = $count.' '.$entity_singular;
		}

	} else {
		//make btn light grey since value = 0
		$attributes['class'] = 'w3-btn w3-tiny w3-light-grey w3-border';
	}

	return anchor($target_url, $inner_btn_text, $attributes);

}
?>

<div class="w3-row">
    <div class="w3-container">
        <h1><?= $headline ?></h1>
        <?= flashdata() ?>     
    </div>
	<div class="w3-container">

	<p>
            <a href="<?= BASE_URL ?>projects/create"><button class="w3-button w3-medium primary">
                <i class="fa fa-pencil"></i> CREATE NEW PROJECT</button>
            </a>
        </p>

	<ul>
		<?php 
		
		foreach($all_projects as $project) { 
			$link = BASE_URL.'projects/our_project/'.$project->url_string;
			$project_link = BASE_URL.'projects/show/'.$project->id;
			?>

		<li> <?= $project->project_name ?> &nbsp; <a href="<?= $project_link ?>">  <i class="fa fa-star"></i>  <?= $project->project_title ?></a> &nbsp; &nbsp;&nbsp; <a href="<?= $link ?>" target="_blank"> <button style="padding: 0.1em 0 0 0.2em;"><i class="fa fa-globe"></i></button></a>   </li>

		<?php }  ?>
		</ul>
	</div>
</div>



<style>
.w3-table {
    border: 1px #555 solid!important;
    border-color: #555!important;
}
</style>