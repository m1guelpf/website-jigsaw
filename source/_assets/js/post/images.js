import Lightense from 'lightense-images';

/*
 * Koenig Editor - Gallery
 * ------------
 */
var images = document.querySelectorAll(".kg-gallery-image img");
images.forEach(function (e) {
    var a = e.closest(".kg-gallery-image"),
        t = e.attributes.width.value / e.attributes.height.value;
    a.style.flex = t + " 1 0%"
});

/* Custom settings for lightense-images */
window.addEventListener('load', function () {
    Lightense('.post-wrap img:not(.no-lightense)', {
        time: 300,
        padding: 60,
        offset: 30,
        keyboard: true,
        cubicBezier: 'cubic-bezier(.2, 0, .1, 1)',
        background: 'rgb(255, 255, 255)',
        zIndex: 999
    });
}, false);