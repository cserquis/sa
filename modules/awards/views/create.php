<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Award Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Award Title');
        echo form_input('award_title', $award_title, array("placeholder" => "Enter Award Title"));
        echo form_label('Award Info');
        echo form_input('award_info', $award_info, array("placeholder" => "Enter Award Info"));
        echo form_label('Award Link');
        echo form_input('award_link', $award_link, array("placeholder" => "Enter Award Link"));
        echo form_label('Year');
        echo form_input('year', $year, array("placeholder" => "Enter Year"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>