<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('clients/create', 'Create New Client Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="8">
                    <div>
                        <div><?php
                        echo form_open('clients/manage/1/', array("method" => "get"));
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
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Telephone Number</th>
                <th>Address</th>
                <th>Since</th>               
                <th>Active</th>                                          
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
            <td><?= anchor('clients/show/'.$row->id, 'View', $attr) ?></td>
                <td><?= $row->last_contact ?></td>
                <td><?= $row->client_name ?></td>
                <td><?= $row->client_email ?></td>
                <td><?= $row->telephone_number ?></td>
                <td><?= $row->address ?></td>
                <td><?= date('l jS F Y',  strtotime($row->since)) ?></td>
                <td><?= $row->active ?></td>                        
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