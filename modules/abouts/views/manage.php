<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('abouts/create', 'Create New About Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="5">
                    <div>
                        <div><?php
                        echo form_open('abouts/manage/1/', array("method" => "get"));
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
                <th style="width: 10px;">Action</th>
                <th style="width: 20%;">About Picture</th>
                <th style="width: 20%;">About Title</th>
                <th style="width: 20%;">About Sub Title</th>   
                <th style="width: 40%;">About Text</th>                          
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { 
                $image_url = BASE_URL.'pictures/abouts_pics_thumbnails/'.$row->id.'/'.$row->picture;
                ?>
            <tr>
                <td><?= anchor('abouts/show/'.$row->id, 'View', $attr) ?></td>
                <td><img src="<?= $image_url ?>" alt="<?= $row->link_name ?> Serquis & Associates" style="max-width: 300px;"></td>
                <td><?= $row->about_title ?></td>
                <td><?= $row->about_sub_title ?></td>
                <td><?= $row->about_text ?></td>                        
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