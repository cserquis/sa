// inicio MENU DESPLEGABLE 

$('#menu-toggle').click(function() {
    $(this).toggleClass('open');
});

$('#menu-toggle').click(function() {
    $('nav , .redes').toggleClass('abierto');
});


// fin MENU DESPLEGABLE


// Read more button

function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}


// Initialize and add the map
function initMap() {
    // The location of Uluru
    const trailhead = { lat: 35.674880, lng: -105.961820 };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: trailhead,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: trailhead,
        map: map,
    });
}

// Toggle in about

function toggleAbout(id) {
    var x = document.getElementById(id);
    var icon = document.getElementById('icon-arrow-' + id);
    if (x.style.display === "none") {
        x.style.display = "block";
        icon.style.transform = "rotate(0.5turn)";
    } else {
        x.style.display = "none";
        icon.style.transform = "rotate(0turn)";
    }
}


// Animado
function toggleServices() {
    var x = document.getElementById("toggle-services");
    var icon = document.getElementById("icon-arrow");
    if (x.style.height === "0px") {
        x.style.height = "100%";
        x.style.transition = "height .2s";
        icon.style.transform = "rotate(0.5turn)";

    } else {
        x.style.height = "0px";
        x.style.transition = "height .2s";
        icon.style.transform = "rotate(0turn)";
    }
}


// AOS ?
AOS.init();