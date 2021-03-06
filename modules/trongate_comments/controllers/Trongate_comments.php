<?php
class Trongate_comments extends Trongate {

    function submit_delete($update_id) {

         $update_id = segment(3);
         
   
             if (!is_numeric($update_id)) {
                 die();
             } else {
                 $result = $this->model->get_where($update_id, 'trongate_comments');
 
                 $data['update_id'] = $update_id;
                 
                 if ($result == false) {
                   $flash_msg = 'No Comments';
                 } else {
                     $module = $result->target_table;
                     $reg_id = $result->update_id;
     
                     $flash_msg = 'Comment';
                     //delete the record
                 $this->model->delete($update_id, 'trongate_comments');
   
                 //set the flashdata
                 $flash_msg = 'Comment Deleted';
                 set_flashdata($flash_msg);
   
                 //redirect to the manage page
                 redirect($module.'/show/'.$reg_id);
                 }
     
         }
     }

    function _prep_comments($output) {
        //return comments with nicely formatted date
        $body = $output['body'];

        //get an array of all trongate_administrators
        $sql = 'SELECT trongate_users.id, trongate_administrators.username 
                FROM trongate_comments 
                INNER JOIN trongate_users ON trongate_comments.user_id = trongate_users.id 
                INNER JOIN trongate_administrators ON trongate_users.id = trongate_administrators.trongate_user_id';
        $all_admins = $this->model->query($sql, 'object');

        $admin_users = [];
        foreach($all_admins as $admin_user) {
            $admin_users[$admin_user->id] = $admin_user->username;
        }

        $comments = json_decode($body);
        $data = [];
        foreach ($comments as $key=>$value) {
            $row_data['comment'] = nl2br($value->comment);

            if (isset($admin_users[$value->user_id])) {
                $posted_by = $admin_users[$value->user_id];
            } else {
                $posted_by = 'an unknown user';
            }

            $date_created = date('l jS \of F Y \a\t h:i:s A', $value->date_created);
            $row_data['date_created'] = ' On '.$date_created;
            $row_data['id'] = $value->id;
            $row_data['user_id'] = $value->user_id;
            $row_data['target_table'] = $value->target_table;
            $row_data['update_id'] = $value->update_id;
            $row_data['code'] = $value->code;
            $data[] = $row_data;
        }

        $output['body'] = json_encode($data);
        return $output;
    }

    function _pre_insert($input) {
        //establish user_id, date_created and code before doing an insert
        $this->module('trongate_tokens');
        $token = $input['token'];
        $user = $this->trongate_tokens->_fetch_token_obj($token);

        $input['params']['user_id'] = $user->user_id;
        $input['params']['date_created'] = time();
        $input['params']['code'] = make_rand_str(6);

        return $input;
    }
    

}