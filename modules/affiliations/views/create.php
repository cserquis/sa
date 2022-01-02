<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Affiliation Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Entity');
        echo form_input('entity', $entity, array("placeholder" => "Enter Entity"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>