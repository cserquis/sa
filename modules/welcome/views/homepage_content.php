<div  class="landing index-main">                      
    <h1>"<?= $homepage_title ?>"</h1>
    <div class="left underline full-overflow"></div>         
    
</div>
<div class="landing-photos-container">

    <?php 
        if ($total_rows>0) {
            $i = 1;
            foreach ($homepage_pictures as $homepage) {

                if($i%2 == 0) {
                    $side = 'left';
                    $data_stellar = 0.3;
                }   else {
                    $side = 'right';
                    $data_stellar = 0.2;
                }    
            if($width < 1700) {
                $src = BASE_URL.'pictures/homepage_pictures_pics_thumbnails/'.$homepage->id.'/'.$homepage->picture;
            } else {
                $src = BASE_URL.'pictures/homepage_pictures_pics/'.$homepage->id.'/'.$homepage->picture;
            } 

    ?>


    <section class="section<?= $i ?> overflow <?= $side ?>">
        <a href="<?= $homepage->picture_link ?>">
            <div class="landing-photo overflow ">
                <img src="<?= $src ?>" alt="S+A <?= $homepage->link_name ?>" class="overflow" data-stellar-ratio="<?= $data_stellar ?>" data-stellar-offset-parent="false">
            </div>
            <h2 class="landing-link"> <?= $homepage->link_name ?></h2>
        </a>
    </section>
         

    <?php $i++; }   } ?>
   
</div>
    <section class="info border-top border-bottom">
        <p><?= $homepage_text ?></p>          
    </section>
    
    <section class="index-conversation conversation full-overflow" >
        <h2>Start a Conversation </h2>
        <div class="butons">
            <a href="<?= BASE_URL ?>our_story" class="button-small">Read More</a>
            <a href="<?= BASE_URL ?>contactus" class="button-small">Contact Us</a>            
        </div>
        <p>
            Please
            <a href="<?= BASE_URL ?>contactus" title="Contact Us" style="color: white;font-weight: bold;">get in touch</a>
            to discuss your project with us. We would love to hear from you.
        </p>
        
    </section>