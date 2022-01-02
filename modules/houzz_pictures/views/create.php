<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Houzz Picture Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Picture Link');
        echo form_input('picture_link', $picture_link, array("placeholder" => "Enter Picture Link"));
        echo form_label('Award Year');
        echo form_input('award_year', $award_year, array("placeholder" => "Enter Award Year"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>