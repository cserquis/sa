<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Testimonial Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Testimonial Title');
        echo form_input('testimonial_title', $testimonial_title, array("placeholder" => "Enter Testimonial Title"));
        echo form_label('Testimonial Name');
        echo form_input('testimonial_name', $testimonial_name, array("placeholder" => "Enter Testimonial Name"));
        echo form_label('Testimonial Text');
        echo form_textarea('testimonial_text', $testimonial_text, array("placeholder" => "Enter Testimonial Text"));
        echo form_label('Date Posted');
        $attr = array("class"=>"date-picker", "autocomplete"=>"off", "placeholder"=>"Select Date Posted");
        echo form_input('date_posted', $date_posted, $attr);
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>