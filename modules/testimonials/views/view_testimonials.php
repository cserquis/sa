

<section class="testimonials">
        
    <h3>What They Say...</h3>
            
       
    <div class="w3-content w3-display-container">

        <?php 
            foreach ($testimonials as $testimonial) {
               
            ?>

        <div class="mySlides" id=<?= $testimonial->id ?>>
            <div class="quote">
                <span> 
                    <h5 class="quote-icon"> “ </h5> 
                    <strong class="quote-title" ><?= $testimonial->testimonial_title ?></strong>
                </span> 
                    
                <p>
                <?= $testimonial->testimonial_text ?>
                </p>
                <div class="quote-name"> – <?= $testimonial->testimonial_name ?> </div>
                              
            </div>
        </div>
        <?php } ?>   
 
            <div class="testimonial-nav w3-center w3-container w3-large " >
              <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
              <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
              
              <?php 
              for($i = 0; $i<= $testimonials_lenght; $i++) {            
              ?>
              <span class="w3-badge dots w3-border  w3-hover-white " onclick="currentDiv(<?= $i ?>)"></span>
              <?php  } ?>
             
            </div>
          </div>
        </section>


<script>

    // TESTIMONIAL

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function currentDiv(n) {
    showDivs(slideIndex = n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dots");
    if (n > x.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = x.length }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
        // setTimeout(showDivs, 1000);  NO logro hacer que sea automatico
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace("dot-active", "");
    }
    x[slideIndex - 1].style.display = "block";

    dots[slideIndex - 1].className += " dot-active";

}
</script>
