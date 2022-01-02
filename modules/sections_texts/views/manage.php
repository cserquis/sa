<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('sections_texts/create', 'Create New Sections Text Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="7">
                    <div>
                        <div><?php
                        echo form_open('sections_texts/manage/1/', array("method" => "get"));
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
                <th>Page</th>
                <th>Title</th>
                <th>Text</th>
                <th>Page Title</th>
                <th>Meta Description</th>
                <th>Meta Keywords</th>                            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= anchor('sections_texts/show/'.$row->id, 'View', $attr) ?></td>
                <td><?= $row->page ?></td>
                <td><?= $row->title ?></td>
                <td><?= $row->page_content ?></td>
                <td><?= $row->page_title ?></td>
                <td><?= $row->meta_description ?></td>
                <td><?= $row->meta_keywords ?></td>                        
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