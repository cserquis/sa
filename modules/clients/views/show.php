<h1><?= $headline ?> <span class="smaller hide-sm">(<?= $client_name ?> ID: <?= $update_id ?>)</span></h1>
<?= flashdata() ?>
<div class="card">
    <div class="card-heading">
        Options
    </div>
    <div class="card-body">
        <?php 
        echo anchor('clients/manage', 'View All Clients', array("class" => "button alt"));
        echo anchor('clients/create/'.$update_id, 'Update Details', array("class" => "button"));
        $attr_delete = array( 
            "class" => "danger go-right",
            "id" => "btn-delete-modal",
            "onclick" => "openModal('delete-modal')"
        );
        echo form_button('delete', 'Delete', $attr_delete);
        ?>
    </div>
</div>
<div class="three-col">
    <div class="card">
        <div class="card-heading">
            Client Details
        </div>
        <div class="card-body">
            <div class="record-details">
                <div class="row">
                    <div>Client Name</div>
                    <div><?= $client_name ?></div>
                </div>
                <div class="row">
                    <div>Client Email</div>
                    <div><?= $client_email ?></div>
                </div>
                <div class="row">
                    <div>Telephone Number</div>
                    <div><?= $telephone_number ?></div>
                </div>
                <div class="row">
                    <div>Address</div>
                    <div><?= $address ?></div>
                </div>
                <div class="row">
                    <div class="full-width">
                        <div><b>Details</b></div>
                        <div><?= nl2br($details) ?></div>
                    </div>
                </div>
                <div class="row">
                    <div>Since</div>
                    <div><?= date('l jS F Y',  strtotime($since)) ?></div>
                </div>
                <div class="row">
                    <div>Last Contact</div>
                    <div><?php if($last_contact != '1970-01-01 01:00:00') { echo $last_contact;} ?></div>
                </div>
                <div class="row">
                    <div>Active</div>
                    <div><?= $active ?></div>
                </div>
            </div>
        </div>
    </div>
    
    <?= Modules::run('module_relations/_draw_summary_panel', 'projects', $token) ?>

    <div class="card">
        <div class="card-heading">
            Comments
        </div>
        <div class="card-body">
            <div class="text-center">
                <p><button class="alt" onclick="openModal('comment-modal')">Add New Comment</button></p>
                <div id="comments-block"><table></table></div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="comment-modal" style="display: none;">
    <div class="modal-heading"><i class="fa fa-commenting-o"></i> Add New Comment</div>
    <div class="modal-body">
        <p><textarea placeholder="Enter comment here..."></textarea></p>
        <p><?php
            $attr_close = array( 
                "class" => "alt",
                "onclick" => "closeModal()"
            );
            echo form_button('close', 'Cancel', $attr_close);
            echo form_button('submit', 'Submit Comment', array("onclick" => "submitComment()"));
            ?>
        </p>
    </div>
</div>
<div class="modal" id="delete-modal" style="display: none;">
    <div class="modal-heading danger"><i class="fa fa-trash"></i> Delete Record</div>
    <div class="modal-body">
        <?= form_open('clients/submit_delete/'.$update_id) ?>
        <p>Are you sure?</p>
        <p>You are about to delete a Client record.  This cannot be undone.  Do you really want to do this?</p> 
        <?php 
        echo '<p>'.form_button('close', 'Cancel', $attr_close);
        echo form_submit('submit', 'Yes - Delete Now', array("class" => 'danger')).'</p>';
        echo form_close();
        ?>
    </div>
</div>
<script>
var token = '<?= $token ?>';
var baseUrl = '<?= BASE_URL ?>';
var segment1 = '<?= segment(1) ?>';
var updateId = '<?= $update_id ?>';
var drawComments = true;
</script>