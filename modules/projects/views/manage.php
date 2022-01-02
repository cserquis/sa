<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('projects/create', 'Create New Project Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="11">
                    <div>
                        <div><?php
                        echo form_open('projects/manage/1/', array("method" => "get"));
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
                <th>Picture</th>
                <th>Project Title</th>
                <th>Project Name / Client</th>
                <th>Location</th>
                <th>Start Date to Finish Date</th>
                <th>Categories</th>
                <th>Postcard</th>
                <th>Final Cost</th>
                <th>Date Created</th>
                <th>Live on Website</th>                           
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { 
                $image_url = BASE_URL.'pictures/projects_pics_thumbnails/'.$row->id.'/'.$row->picture;
                $categories = $row->categories;
                $clients = $row->clients;
                ?>
            <tr>
                <td><?= anchor('projects/show/'.$row->id, 'View', $attr) ?></td>
                <td><img src="<?= $image_url ?>" alt="<?= $row->project_title ?> Serquis & Associates" style="max-width: 100px;"></td>
                <td><?= $row->project_title ?></td>
                <td><?= $row->project_name ?> <br>  <?php foreach($clients as $client) {echo $client; echo '<br>';}  ?></td>
                <td><?= $row->location ?></td>
                <td><?= $row->start_date  ?> <?= $row->finish_date  ?></td>
                <td><?php foreach($categories as $category) {echo $category; echo '<br>';}  ?></td>           
                <td><?= $row->postcard ?></td>
                <td><?= $row->final_cost ?></td>
                <td><?= date('Y-m-d',  $row->date_created) ?></td>
                <td><?= $row->live_on_website ?></td>                        
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