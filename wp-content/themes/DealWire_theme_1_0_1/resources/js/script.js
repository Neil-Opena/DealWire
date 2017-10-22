// Google Maps
function initMap(){
    var location = {lat: 40.772661, lng: -73.412804};
    var center = {lat: 42, lng: -70};
    var map = new google.maps.Map(document.getElementById('test'), {
        zoom: 6,
        center: center
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}

/*

//parallax
$(function(){
    //cache the window object
    var $window = $(window);

    $('section[data-type="background"]').each(function(){
        var $bgobj = $(this);

        $window.scroll(function(){
            //scroll the background at var speed
            //the yPos is a negative value because we're scrolling it Up!!1
            var yPos = -($window.scrollTop() / $bgobj.data('speed'));

            //put together our final background position
            var coords = '50% ' + yPos + 'px';

            //move the background
            $bgobj.css({backgroundPosition: coords});
        });
    });
});

$(document).ready(function(){
    $(window).scroll(function(){

        $('.deal').each(function(){
            var imagePos = $(this).offset().top;

            var topOfWindow = $(window).scrollTop();
            if(imagePos < topOfWindow + 400){
                $(this).css("visibility","visible");
                $(this).css("animation-duration","0.5s");
                $(this).addClass("animated slideInUp");
            }
        });
    });

});

*/