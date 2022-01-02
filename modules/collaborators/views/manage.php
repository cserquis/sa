<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('collaborators/create', 'Create New Collaborator Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="7">
                    <div>
                        <div><?php
                        echo form_open('collaborators/manage/1/', array("method" => "get"));
                        echo form_input('searchphrase', '', array("placeholder" => "Search records..."));
                        echo form_submit('submit', 'Search', array("class" => "alt"));
                        echo form_close();
                        ?></div>
                        <div>Records Per Page: <?php
                        $dropdown_attr['onchange'] = 'setPerPage()';
                        echo form_dropdown('per_page', $per_page_options, $selected_per_page, $dropdown_attr); 
                        ?></div>

                    </div>                    
                </th>
            </tr>
            <tr>
                <th style="width: 20px;">Action</th>
                <th>Last Contact</th>
                <th>Collaborator Name</th>
                <th>Collaborator email</th>
                <th>Contact Person</th>
                <th>Collaborator Telephone</th>
                <th>Collaborator Address</th>                            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= anchor('collaborators/show/'.$row->id, 'View', $attr) ?></td>
                <td><?= $row->last_contact ?></td>
                <td><?= $row->collaborator_name ?></td>
                <td><?= $row->collaborator_email ?></td>
                <td><?= $row->contact_person ?></td>
                <td><?= $row->collaborator_telephone ?></td>
                <td><?= $row->collaborator_address ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php 
    if(count($rows)>9) {
        unset($pagination_data['include_showing_statement']);
        echo Pagination::display($pagination_data);
    }
}
?>