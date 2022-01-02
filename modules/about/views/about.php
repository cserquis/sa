
<section  class="landing border-bottom">
    <h1><?= $title ?></h1>
    <div class="left underline full-overflow"></div>
    <h2><?= $page_content ?> </h2>
</section>
    
<?php 
$i = 0;
        foreach ($our_story as $story) {
            if($i % 2 == 0) {
                $orientation = 'right';
            } else {
                $orientation = 'left';
            }
            
            $story_picture = BASE_URL.'pictures/abouts_pics/'.$story->id.'/'.$story->picture;
         ?>

<section id="container-about" class="main-about <?= $orientation ?> border-bottom">

<div class="img-about">
    <img src="<?= $story_picture ?>" alt="S+A <?= $story->about_title ?>">
</div>
<div class="info-about " >

        <h3> <?= $story->about_title ?></h3>
        <h4> <?= $story->about_sub_title ?></h4>
        <p><?= nl2br($story->about_text) ?></p>
</div>

</section>
      
<?php 
$i++; 
} ?>

<section id="container-about" class="main-about">
    <div class="toggle-info services ">
    
        <h3>Press & Publications
        <a id="iconarrow" class="arrow-btn" onclick="toggleAbout('services')">
                <i id="icon-arrow-services" class="las la-angle-down" style="transform: rotate(0turn)"></i>            
            </a>
        </h3>
         
    <div id="services" class="toggle-items" style="display: none;">
    <?= Modules::run('publications/_display', $data) ?>

        
    
    </div>

</div>

    <div class="toggle-info awards">
        <h3>Awards
            <a id="iconarrow" onclick="toggleAbout('awards')">
                <i id="icon-arrow-awards" class="las la-angle-down " style="transform: rotate(0turn)"></i>
            </a>
        </h3>
        <div  id="awards" class="toggle-items" style="display: none;">
            <ul>
        <?php         
            foreach ($ori_awards as $ori_award) {
                if($ori_award->award_link == '') {
                    $ori_award->award_link = 'https://www.serquis.com';
                }
            ?>
                <li><b><?= $ori_award->year ?></b> – <a href="<?= $ori_award->award_link ?>"><?= $ori_award->award_title ?> </a> <?= $ori_award->award_info ?> 
                </li>
                <?php } ?>            
            </ul>

            <div class="houzz-badges">
            <?php 
            foreach ($houzz as $houzz_award) {
            ?>
                <a href="<?= $houzz_award->picture_link ?>"><img
                src="<?= $houzz_award->picture_link ?>"
                alt="Solange Serquis in Santa Fe, NM on Houzz <?= $houzz_award->award_year ?>" width="" height="54" border="0" /></a>
            <?php } ?>
            </div>
        </div>
    </div>

    <div class="toggle-info affiliations">
        <h3>Afiliations
            <a id="iconarrow" onclick="toggleAbout('affiliations')">
                <i id="icon-arrow-affiliations" class="las la-angle-down" style="transform: rotate(0turn)"></i>
            </a>
        </h3>
        <div class="toggle-items" id="affiliations" style="display: none;">
            <ul>
            <?php 
            foreach ($affiliations as $affiliation) {
            ?>
                <li><?= $affiliation->entity ?> 
                </li>
                <?php } ?> 
                
            </ul>
        </div>
    </div>
</section>

<section id="" class="conversation">
    <h2>Start a Conversation </h2>
    <div class="butons">
        <a href="<?= BASE_URL ?>contactus" class="button-small">Contact Us</a>
        
    </div>
</section>

<?= Modules::run('testimonials/_draw_view_testimonials')?>


<style>

#container-about {
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-template-rows: auto;
    }
    .about .right {
        padding: 0;
        margin: 1em 0;
    }
    .about .left {
        padding: 0;
        margin: 1em 0;
    }
</style>

