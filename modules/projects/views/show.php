<h1><?= $headline ?> <span class="smaller hide-sm">(<?= $project_title ?> ID: <?= $update_id ?>)</span></h1>
<?= flashdata() ?>
<div class="card">
    <div class="card-heading">
        Options
    </div>
    <div class="card-body">
        <?php 
        echo anchor('projects/manage', 'View All Projects', array("class" => "button alt"));
        echo anchor('projects/create/'.$update_id, 'Update Details', array("class" => "button"));
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
            Project Details
        </div>
        <div class="card-body">
            <div class="record-details"><?= $project_title ?>
                <div class="row">
                    <div>Project Title</div>
                    <div></div>
                </div>
                <div class="row">
                    <div>Project Name</div>
                    <div><?= $project_name ?></div>
                </div>
                <div class="row">
                    <div>Location</div>
                    <div><?= $location ?></div>
                </div>
                <div class="row">
                    <div class="full-width">
                        <div><b>Project Description</b></div>
                        <div><?= nl2br($project_description) ?></div>
                    </div>
                </div>
                <div class="row">
                    <div>Issuu Code</div>
                    <div><?= $issuu_code ?></div>
                </div>
                <div class="row">
                    <div>Start Date</div>
                    <div><?= $start_date ?></div>
                </div>
                <div class="row">
                    <div>Finish Date</div>
                    <div><?= $finish_date ?></div>
                </div>
                <div class="row">
                    <div>Project Folder</div>
                    <div><?= $project_folder ?></div>
                </div>
                <div class="row">
                    <div>Best Pic Folder</div>
                    <div><?= $best_pic_folder ?></div>
                </div>
                <div class="row">
                    <div>Postcard</div>
                    <div><?= $postcard ?></div>
                </div>
                <div class="row">
                    <div>Cost From</div>
                    <div><?= $cost_from ?></div>
                </div>
                <div class="row">
                    <div>Cost To</div>
                    <div><?= $cost_to ?></div>
                </div>
                <div class="row">
                    <div>Final Cost</div>
                    <div><?= $final_cost ?></div>
                </div>
                <div class="row">
                    <div>Date Created</div>
                    <div><?= $date_created ?></div>
                </div>
                <div class="row">
                    <div>Live on Website</div>
                    <div><?= $live_on_website ?></div>
                </div>
            </div>
        </div>
    </div>
        <div class="card">
        <div class="card-heading">
            Picture
        </div>
        <div class="card-body picture-preview">
            <?php
            if ($draw_picture_uploader == true) {
                echo form_open_upload(segment(1).'/submit_upload_picture/'.$update_id);
                echo validation_errors();
                echo '<p>Please choose a picture from your computer and then press \'Upload\'.</p>';
                echo form_file_select('picture');
                echo form_submit('submit', 'Upload');
                echo form_close();
            } else {
                $picture_path = BASE_URL.'pictures/'.segment(1).'_pics_thumbnails/'.$update_id.'/'.$picture;
            ?>
                <p class="text-center">
                    <button class="danger" onclick="openModal('delete-picture-modal')"><i class="fa fa-trash"></i> Delete Picture</button>
                </p>
                <p class="text-center">
                    <img src="<?= $picture_path ?>" alt="picture preview" width="300">
                </p>

                <div class="modal" id="delete-picture-modal" style="display: none;">
                    <div class="modal-heading danger"><i class="fa fa-trash"></i> Delete Picture</div>
                    <div class="modal-body">
                        <?= form_open(segment(1).'/ditch_picture/'.$update_id) ?>
                            <p>Are you sure?</p>
                            <p>You are about to delete the picture.  This cannot be undone. Do you really want to do this?</p>
                            <p>
                                <button type="button" name="close" value="Cancel" class="alt" onclick="closeModal()">Cancel</button>
                                <button type="submit" name="submit" value="Yes - Delete Now" class="danger">Yes - Delete Now</button>
                            </p>
                        <?= form_close() ?>
                    </div>
                </div>

            <?php 
            }
            ?>
        </div>
    </div>
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
    
    <?= Modules::run('my_filezone/_draw_summary_panel', $update_id, $filezone_settings); ?>
    
    <?= Modules::run('module_relations/_draw_summary_panel', 'clients', $token) ?>

    <?= Modules::run('module_relations/_draw_summary_panel', 'collaborators', $token) ?>
  
    <?= Modules::run('module_relations/_draw_summary_panel', 'categories', $token) ?>
    
    <?= Modules::run('module_relations/_draw_summary_panel', 'tags', $token) ?>
  
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
        <?= form_open('projects/submit_delete/'.$update_id) ?>
        <p>Are you sure?</p>
        <p>You are about to delete a Project record.  This cannot be undone.  Do you really want to do this?</p> 
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