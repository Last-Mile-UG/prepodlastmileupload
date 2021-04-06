
$(document).ready(function(){


function mapInit() {
var myLatLng = new google.maps.LatLng(24.9458511, 67.0536318);
    var mapProps = {
    zoom: 7,
    center: myLatLng
    }
var map1 = new google.maps.Map(document.getElementById("map"), mapProps);
};
google.maps.event.addDomListener(window, 'load', mapInit);
const marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
  });

});