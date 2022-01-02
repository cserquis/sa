<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Project Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Project Title');
        echo form_input('project_title', $project_title, array("placeholder" => "Enter Project Title"));
        echo form_label('Project Name');
        echo form_input('project_name', $project_name, array("placeholder" => "Enter Project Name"));
        echo form_label('Location');
        echo form_input('location', $location, array("placeholder" => "Enter Location"));
        echo form_label('Project Description');
        echo form_textarea('project_description', $project_description, array("placeholder" => "Enter Project Description"));
        echo form_label('ISSUU Code');
        echo form_input('issuu_code', $issuu_code, array("placeholder" => "Enter Issu Code"));
        echo form_label('Start Date');
        $attr = array("class"=>"date-picker", "autocomplete"=>"off", "placeholder"=>"Select Start Date");
        echo form_input('start_date', $start_date, $attr);
        echo form_label('Finish Date');
        $attr = array("class"=>"date-picker", "autocomplete"=>"off", "placeholder"=>"Select Finish Date");
        echo form_input('finish_date', $finish_date, $attr);
        echo form_label('Project Folder');
        echo form_input('project_folder', $project_folder, array("placeholder" => "Enter Project Folder"));
        echo form_label('Best Pic Folder');
        echo form_input('best_pic_folder', $best_pic_folder, array("placeholder" => "Enter Best Pic Folder"));
        echo '<div>';
        echo 'Postcard ';
        echo form_checkbox('postcard', 1, $checked=$postcard);
        echo '</div>';
        echo form_label('Cost From');
        echo form_input('cost_from', $cost_from, array("placeholder" => "Enter Cost From"));
        echo form_label('Cost To');
        echo form_input('cost_to', $cost_to, array("placeholder" => "Enter Cost To"));
        echo form_label('Final Cost');
        echo form_input('final_cost', $final_cost, array("placeholder" => "Enter Final Cost"));
        echo '<div>';
        echo 'Live on Website ';
        echo form_checkbox('live_on_website', 1, $checked=$live_on_website);
        echo '</div>';
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>