<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        SVG Logo Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Place Logo');
        echo form_dropdown('place_logo', $place_options, $place_logo, array("class" => "form-select"), 'required');
        echo form_label('Image Name');
        echo form_input('image_name', $image_name, array("placeholder" => "Enter Image Name"));
        echo form_label('SVG Tag');
        echo form_textarea('svg_tag', $svg_tag, array("placeholder" => "Enter SVG Tag"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>