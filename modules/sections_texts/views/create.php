<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Sections Text Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Page');
        echo form_dropdown('page', $page_options, $page, array("class" => "form-select", "placeholder" => "Enter Page"), 'required');
        echo form_label('Title');
        echo form_input('title', $title, array("placeholder" => "Enter Title"));
        echo form_label('Page Content');
        echo form_textarea('page_content', $page_content, array("placeholder" => "Enter Page Content"));
        echo '<h2>SEO Section</h2>';
        echo form_label('Page Title');
        echo form_input('page_title', $page_title, array("placeholder" => "Enter Page Title"));
        echo form_label('Meta Description');
        echo form_input('meta_description', $meta_description, array("placeholder" => "Enter Meta Description"));
        echo form_label('Meta Keywords');
        echo form_input('meta_keywords', $meta_keywords, array("placeholder" => "Enter Meta Keywords"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>