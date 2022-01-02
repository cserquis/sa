<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        About Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('About Title');
        echo form_input('about_title', $about_title, array("placeholder" => "Enter About Title"));
        echo form_label('About Sub Title');
        echo form_input('about_sub_title', $about_sub_title, array("placeholder" => "Enter About Sub Title"));
        echo form_label('About Text');
        echo form_textarea('about_text', $about_text, array("placeholder" => "Enter About Text"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>