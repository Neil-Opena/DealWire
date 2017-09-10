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
};
