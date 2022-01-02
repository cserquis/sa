<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('houzz_pictures/create', 'Create New Houzz Picture Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="4">
                    <div>
                        <div><?php
                        echo form_open('houzz_pictures/manage/1/', array("method" => "get"));
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
                <th>Picture Link</th>
                <th>Picture Link</th>
                <th>Award Year</th>                            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= anchor('houzz_pictures/show/'.$row->id, 'View', $attr) ?></td>
                <td><img src="<?= $row->picture_link ?>" alt="Houzz <?= $award_year ?> Serquis & Associates" style="max-width: 100px;"></td>
                <td><?= $row->picture_link ?></td>
                <td><?= $row->award_year ?></td>       
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