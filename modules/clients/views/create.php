<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Client Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Last Contact');
        $attr = array("class"=>"datetime-picker", "autocomplete"=>"off", "placeholder"=>"Select Last Contact");
        echo form_input('last_contact', $last_contact, $attr);
        echo form_label('Client Name');
        echo form_input('client_name', $client_name, array("placeholder" => "Enter Client Name"));
        echo form_label('Client Email');
        echo form_input('client_email', $client_email, array("placeholder" => "Enter Client Email"));
        echo form_label('Telephone Number');
        echo form_input('telephone_number', $telephone_number, array("placeholder" => "Enter Telephone Number"));
        echo form_label('Address');
        echo form_input('address', $address, array("placeholder" => "Enter Address"));
        echo form_label('Details');
        echo form_textarea('details', $details, array("placeholder" => "Enter Details"));
        echo form_label('Since');
        $attr = array("class"=>"date-picker", "autocomplete"=>"off", "placeholder"=>"Select Since");
        echo form_input('since', $since, $attr);
        
        echo '<div>';
        echo 'Active ';
        echo form_checkbox('active', 1, $checked=$active);
        echo '</div>';
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>