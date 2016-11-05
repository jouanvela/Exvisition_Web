var map;
var marker;
function initialize() {
  var geocoder = new google.maps.Geocoder();
  map = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(23.974040, 120.979943),
    zoom: 16,
    mapTypeId: 'roadmap'
  });
}
document.getElementById("file-input").onchange = function(e) {
  EXIF.getData(e.target.files[0], function() {
    var lat=EXIF.getTag(this, 'GPSLatitude')[0]+EXIF.getTag(this, 'GPSLatitude')[1]/60+EXIF.getTag(this, 'GPSLatitude')[2]/3600;
    var lng=EXIF.getTag(this, 'GPSLongitude')[0]+EXIF.getTag(this, 'GPSLongitude')[1]/60+EXIF.getTag(this, 'GPSLongitude')[2]/3600;
    document.getElementById("lat").value=lat;
    document.getElementById("lng").value=lng;
    var pos = {
      lat: lat,
      lng: lng
    };
    map.setCenter(pos);
    if (marker) {
      marker.setPosition(pos);
    }
    else {
      marker = new google.maps.Marker({
        map: map,
        position: pos,
      });
    }
  });
}