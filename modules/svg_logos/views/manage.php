<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('svg_logos/create', 'Create New SVG Logo Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="4">
                    <div>
                        <div><?php
                        echo form_open('svg_logos/manage/1/', array("method" => "get"));
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
                <th style="width: 20px;"> Logo Place</th>
                <th  style="width: 200px;">Image </th>
                <th>Image Name</th>                           
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= anchor('svg_logos/show/'.$row->id, 'View', $attr) ?></td>
                <td><?= $row->place_logo ?></td>
                <td><?= $row->svg_tag ?></td>
                <td><?= $row->image_name ?></td>                                       
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