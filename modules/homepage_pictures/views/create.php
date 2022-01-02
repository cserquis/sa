<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Homepage Picture Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Link Name');
        echo form_input('link_name', $link_name, array("placeholder" => "Enter Link Name"));
        echo form_label('Picture Link');
        echo form_input('picture_link', $picture_link, array("placeholder" => "Enter Picture Link"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>