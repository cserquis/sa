<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Collaborator Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Last Contact');
        echo form_input('last_contact', $last_contact, array("class"=>"datetime-picker", "autocomplete"=>"off", "placeholder" => "Enter Last Contact"));
        echo form_label('Collaborator Name');
        echo form_input('collaborator_name', $collaborator_name, array("placeholder" => "Enter Collaborator Name"));
        echo form_label('Collaborator email');
        echo form_input('collaborator_email', $collaborator_email, array("placeholder" => "Enter Collaborator email"));
        echo form_label('Contact Person');
        echo form_input('contact_person', $contact_person, array("placeholder" => "Enter Contact Person"));
        echo form_label('Collaborator Telephone');
        echo form_input('collaborator_telephone', $collaborator_telephone, array("placeholder" => "Enter Collaborator Telephone"));
        echo form_label('Collaborator Address');
        echo form_input('collaborator_address', $collaborator_address, array("placeholder" => "Enter Collaborator Address"));
        
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>