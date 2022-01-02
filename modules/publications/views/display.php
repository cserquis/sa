
<ul>
<?php 
if($results > 0) {
    foreach ($news as $new) {
        ?>
    <li>
        <b> <?= strtoupper(date('M j \, Y', $new->published_date)) ?> </b><a href="<?= $new->media_link?>"> – <?= $new->publication_media?> – </a> <?= $new->publication_title?> 
    </li>
    <?php  
    }  } else {?>
    <p>No Publications</p>
    <?php } ?>
</ul>