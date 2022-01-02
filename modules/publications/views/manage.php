<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('publications/create', 'Create New Publication Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="6">
                    <div>
                        <div><?php
                        echo form_open('publications/manage/1/', array("method" => "get"));
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
                <th>Publication Title</th>
                <th>Publication Media</th>
                <th>Media Link</th>
                <th>Published Date</th>
                <th>Live on Website</th>                            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= anchor('publications/show/'.$row->id, 'View', $attr) ?></td>
                <td><?= $row->publication_title ?></td>
                <td><?= $row->publication_media ?></td>
                <td><?= $row->media_link ?></td>
                <td><?= date('m\/d\/Y', $row->published_date) ?></td>
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