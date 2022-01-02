<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Publication Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Publication Title');
        echo form_input('publication_title', $publication_title, array("placeholder" => "Enter Publication Title"));
        echo form_label('Publication Media');
        echo form_input('publication_media', $publication_media, array("placeholder" => "Enter Publication Media"));
        echo form_label('Media Link');
        echo form_input('media_link', $media_link, array("placeholder" => "Enter Media Link"));
        echo form_label('Published Date');
        echo form_input('published_date', $published_date, array("class"=>"date-picker", "autocomplete"=>"off", "placeholder" => "Enter Published Date"));
        echo '<div>';
        echo 'Live on Website ';
        echo form_checkbox('live_on_website', 1, $checked=$live_on_website);
        echo '</div>';
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>