<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Website Owner Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Owner');
        echo form_input('owner', $owner, array("placeholder" => "Enter Owner"));
        echo form_label('Website Name');
        echo form_input('website_name', $website_name, array("placeholder" => "Enter Website Name"));
        echo form_label('Website Address');
        echo form_input('website_address', $website_address, array("placeholder" => "Enter Website Address"));
        echo form_label('Website Address 2');
        echo form_input('website_address_2', $website_address_2, array("placeholder" => "Enter Website Address 2"));
        echo form_label('Website Phone');
        echo form_input('website_phone', $website_phone, array("placeholder" => "Enter Website Phone"));
        echo form_label('Website Email');
        echo form_input('website_email', $website_email, array("placeholder" => "Enter Website Email"));
        echo form_label('Houzz Link');
        echo form_input('houzz_link', $houzz_link, array("placeholder" => "Enter Houzz Link"));
        echo form_label('Facebook Link');
        echo form_input('facebook_link', $facebook_link, array("placeholder" => "Enter Facebook Link"));
        echo form_label('Instagram Link');
        echo form_input('instagram_link', $instagram_link, array("placeholder" => "Enter Instagram Link"));
        echo form_label('Trailhead Link');
        echo form_input('trailhead_link', $trailhead_link, array("placeholder" => "Enter Trailhead Link"));
        echo form_label('Facebook - Google Scripts');
        echo form_textarea('facebook__google_scripts', $facebook__google_scripts, array("placeholder" => "Enter Facebook - Google Scripts"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>