<?php
if(!isset($_SESSION['screen_width'])){ ?>
    <script>
    function fetchWidth() {

        var screenWidth = screen.width;
        var template = 'welcome';
    
        var apiUrl = '<?= BASE_URL ?>' + template + '/width_screen';
    
        var params = {
            screenWidth: screenWidth
        }
        
        sendToApi(apiUrl, 'POST', params);
    }

    function sendToApi(apiUrl, requestType, params) {
        const http = new XMLHttpRequest()
    http.open(requestType, apiUrl)
    http.setRequestHeader('Content-type', 'application/json')
    http.send(JSON.stringify(params))
    http.onload = function() {
        if (http.status == 200) {
            console.log('ok');
        } else {
            console.log('NOTok');
        }
    }
    }

    window.onload = function() {
        
        fetchWidth();
        location.reload();

}

    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $page_title ?>  </title>
    <meta property="title" content=" <?= $page_title ?>  " />
    <meta name="description" content="<?= $meta_description ?>"/>
    <meta name="keywords" content="<?= $meta_keywords ?>"/>
    <link rel="canonical" href="<?= current_url() ?>" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="<?= $og_type ?>" />
    <meta property="og:title" content=" <?= $page_title ?>  " />
    <meta property="og:description" content="<?= $meta_description ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:site_name" content="<?= $website_name ?>" />
    <meta property="og:image" content="<?= $image_path ?>" />
    <?php 
        if((($segmento == 'projects') && ($segmento2 == 'our_project')) ||  (($segmento == 'our_work') && ($segmento2 == 'lookbooks'))) {  ?>
            
    <meta property="article:section" content="Project <?= $project_obj->project_title ?>" />
    <meta property="article:published_time" content="<?= $published_time ?>" />
    <meta property="article:updated_time" content="<?= $published_time ?>" />
    <meta property="article:tag" content="Project <?= $categories[0] ?>" />
    
   
    <?php } ?>
    
    

    <meta name="robots" content="index, follow">

    <!-- font -->
    <link rel="stylesheet" href="https://use.typekit.net/sud0zuo.css">

    <?= $additional_includes_middle ?>
      
    <link rel="stylesheet" href="<?= BASE_URL ?>src/css/trongate.css">
    
    <link rel="stylesheet" href="<?= BASE_URL ?>src/css/trongate.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/line-awesome/css/line-awesome.min.css">
    <!-- brand icons -->
    <link href="<?= BASE_URL ?>src/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/fontawesome/css/brands.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>src/css/aos.css">
    
    <link rel="stylesheet" href="<?= BASE_URL ?>src/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>src/css/style.css">
    <?= $additional_includes_top ?>

    <link rel="shortcut icon" href="<?= BASE_URL ?>src/img/favicon/favicon-16x16.png" type="image/png" />
    <link rel="shortcut icon" href="<?= BASE_URL ?>src/img/favicon/favicon.ico">

    <link rel="icon" type="image/png" href="<?= BASE_URL ?>src/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>src/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>src/img/favicon/favicon-96x96.png" sizes="96x96">

    <link rel="apple-touch-icon" sizes="57x57" href="<?= BASE_URL ?>src/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= BASE_URL ?>src/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= BASE_URL ?>src/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= BASE_URL ?>src/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= BASE_URL ?>src/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= BASE_URL ?>src/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= BASE_URL ?>src/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= BASE_URL ?>src/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= BASE_URL ?>src/img/favicon/apple-icon-180x180.png">
    <link rel="apple-icon"  href="<?= BASE_URL ?>src/img/favicon/apple-icon-precomposed.png">

    <link rel="android-icon" sizes="36x36" href="<?= BASE_URL ?>src/img/favicon/android-icon-36x36.png">
    <link rel="android-icon" sizes="48x48" href="<?= BASE_URL ?>src/img/favicon/android-icon-48x48.png">
    <link rel="android-icon" sizes="72x72" href="<?= BASE_URL ?>src/img/favicon/android-icon-72x72.png">
    <link rel="android-icon" sizes="96x96" href="<?= BASE_URL ?>src/img/favicon/android-icon-96x96.png">
    <link rel="android-icon" sizes="192x192" href="<?= BASE_URL ?>src/img/favicon/android-icon-192x192.png">

    <link rel="manifest" href="<?= BASE_URL ?>src/img/favicon/manifest.json">
    <link rel="browserconfig" href="<?= BASE_URL ?>src/img/favicon/browserconfig.xml">
    <meta name="msapplication-TileImage" content="<?= $image_path ?>" />
    <meta name="msapplication-TileColor" content="#8f9427">
   
    <script type='application/ld+json'> 
    {
        "@context": "http://www.schema.org",
        "@type": "HomeAndConstructionBusiness",
        "name": "<?= $page_title ?> <?= OUR_NAME ?>",
        "url": "<?= current_url() ?>",
        "sameAs": [
            "<?= BASE_URL ?>contactus",
            "<?= BASE_URL ?>our_work/projects",
            "<?= BASE_URL ?>news/display",
            "https://www.trailheadsantafe.com/"
        ],
        "audience": "Creative Work",
        "email": "contact@serquis.com",
        "ownershipFundingInfo": "<?= BASE_URL ?>our_story",
        "brand" = "<?= OUR_NAME ?>",
        "logo": "<?= BASE_URL ?>logo/header/S+A-full-logo-small.svg",

        "image": "<?= $image_path ?>",
        
        "description": "<?= $meta_description ?>",
        "category": "Landscape Architecture",
        "isRelatedTo": [
            "Design",
            "Landscape Architecture",
            "Construction"
            ], 
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "922A Shoofly St, Suite #201",
            "addressLocality": "Santa Fe",
            "addressRegion": "New Mexico",
            "postalCode": "87507",
            "addressCountry": "United States of America"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "35.67527",
            "longitude": "-105.96203"
        },
        "hasMap": "https://goo.gl/maps/ZkGotzSrKgx9KwnaA",
        "openingHours": "Mo, Tu, We, Th, Fr 09:00-17:00 Sa 10:00-13:00",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "(505) 629 - 1009",
            "contactType": "contact@serquis.com"
        }
    }
 </script>

</head>


<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>

 <!-- Load Google Tags --> 
   <script>
      
    <?php if((isset($website_script) && ($website_script != '')))  {?>
   
   <?= $website_script ?>
   <?php } ?>

   </script>
    <?php 
   if(isset($_SESSION['screen_width'])) { $width = $_SESSION['screen_width'];}
   
   ?>
    <header>
       
        <div id="header-container" >
            <a href="<?= BASE_URL ?>" class="logo-header">
                <span id="logo">
                    
                    <img src="<?= $logo_header_path ?>" alt="logo <?= $website_name ?>" />
                </span>
            </a>
            <div id="menu-toggle" class="burger">
                <div id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div id="cross">
                    <span></span>
                    <span></span>
                </div>
            </div>
            <nav>
                <ul>

                <?php

                foreach($menu_links as $link) {
                    $class_active = '';
                    if (($segmento == 'projects') && ($link->menu_title == 'Projects')){

                         $class_active = 'class="active"';
                        } 
                    $linkTo = BASE_URL.$link->menu_path;
                    if(current_url() == $linkTo) {
                        $class_active = 'class="active"';
                    } 
                    if (($segmento == 'our_work') && ($link->menu_title == 'Projects')){

                        $class_active = 'class="active"';
                       } 
                    
                    ?>
                    <li <?= $class_active ?>><a href="<?= $linkTo ?>"><?= $link->menu_title ?></a></li>
                <?php } ?>

                </ul>
            </nav>
        </div>      
    </header>
    <?php  
     if(isset($class)) {
        $print_class = $class;
    } else {
        $print_class = '';
    }
    ?>
    <div id="master-container" <?= $print_class ?>>
    
        <?= Template::display($data) ?>       
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-info border-bottom">
                <picture>
                <!-- <?= $logo_footer_image ?> -->
                    <img src="<?= $logo_footer_path ?>" alt="serquis-logo" />
                </picture>
            <div class="addres-info">  
                <ul>
                    <li><?= $website_name ?></li>
                    <li> <a href="<?= $trailhead_link ?>" target="_blank"> Trailhead Compound</a></li>
                    <li><?= $website_address ?></li>
                    <li><?= $website_address_2 ?></li>           
                </ul>
            </div>
            <div class="contact-info">
                <ul>
                    <li> <?= $website_phone ?></li>
                    <li><a href="mailto:<?= $website_email ?>"><?= $website_email ?></a></li>
                </ul>
            </div>
            <div>
                <ul class="social-media">
                    <li><a href="<?= $website_facebook_link ?>" target="_blank"><i class="fab fa-facebook-square"></i></a></li>    
                    <li><a href="<?= $website_instagram_link ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>   
                    <li><a href="<?= $website_houzz_link ?>" target="_blank"><i class="fab fa-houzz"></i></a></li>               
                                 
                </ul>
            </div>   
        </div>

        <p>© Copyright <?php echo date("Y"); ?>, Serquis + Associates Landscape Architecture. All rights Reserved</p>
     </div>   
    </footer>

    
    
    <?php
        if ($segmento == '') { ?>
        <script src="<?= BASE_URL ?>src/js/jquery-2.0.2.js"></script>
        <script src="<?= BASE_URL ?>src/js/jquery.stellar.js"></script>
        <script>
        //stellar
        $(window).stellar({
            horizontalScrolling: false,
            verticalOffset: 0,
            horizontalOffset: 0,
            responsive: true,
            positionProperty: 'transform',
            hideDistantElements: false,
            scrollProperty: 'scroll',
        });
        </script>

        <?php
        } else {  ?>
        <script src="<?= BASE_URL ?>src/js/jquery.min.js"></script>
        <?php } ?>

    
    <script src="<?= BASE_URL ?>src/js/aos.js"></script>
    <script>
        
        AOS.init();
    </script>
    <script src="<?= BASE_URL ?>src/js/myjquery.js"></script>

    </body>

</html>

