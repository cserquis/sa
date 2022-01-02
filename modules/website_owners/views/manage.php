<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('website_owners/create', 'Create New Website Owner Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="7">
                    <div>
                        <div><?php
                        echo form_open('website_owners/manage/1/', array("method" => "get"));
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
                <th>Owner</th>
                <th>Website Name</th>
                <th>Website Address</th>
                <th>Website Address 2</th>
                <th>Website Phone</th>
                <th>Website Email</th>
                <th style="width: 20px;">Action</th>            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= $row->owner ?></td>
                <td><?= $row->website_name ?></td>
                <td><?= $row->website_address ?></td>
                <td><?= $row->website_address_2 ?></td>
                <td><?= $row->website_phone ?></td>
                <td><?= $row->website_email ?></td>
                <td><?= anchor('website_owners/show/'.$row->id, 'View', $attr) ?></td>        
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