<h1><?= $headline ?></h1>
<?php
flashdata();
echo '<p>'.anchor('testimonials/create', 'Create New Testimonial Record', array("class" => "button")).'</p>'; 
echo Pagination::display($pagination_data);
if (count($rows)>0) { ?>
    <table id="results-tbl">
        <thead>
            <tr>
                <th colspan="5">
                    <div>
                        <div><?php
                        echo form_open('testimonials/manage/1/', array("method" => "get"));
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
                <th>Testimonial Title</th>
                <th>Testimonial Name</th>
                <th>Testimonial Text</th>
                <th>Date Posted</th>                            
            </tr>
        </thead>
        <tbody>
            <?php 
            $attr['class'] = 'button alt';
            foreach($rows as $row) { ?>
            <tr>
                <td><?= anchor('testimonials/show/'.$row->id, 'View', $attr) ?></td>
                <td><?= $row->testimonial_title ?></td>
                <td><?= $row->testimonial_name ?></td>
                <td><?= $row->testimonial_text ?></td>
                <td><?= date('l jS F Y',  strtotime($row->date_posted)) ?></td>                       
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