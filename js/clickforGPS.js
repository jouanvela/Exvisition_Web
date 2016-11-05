window.onload = function () {
      var marker;
      var mapOptions = {
            center: new google.maps.LatLng(22.6270179, 120.26741019999997),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      // HTML5 geolocation.
      if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                  };
                  map.setCenter(pos);
            }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());
            });
      }
      var latlngbounds = new google.maps.LatLngBounds();
      var map = new google.maps.Map(document.getElementById("map"), mapOptions);
      google.maps.event.addListener(map, 'click', function (e) {
            document.getElementById("lat").value=e.latLng.lat();
            document.getElementById("lng").value=e.latLng.lng();
            if (marker) {
                  marker.setPosition(e.latLng);
            }
            else {
                  marker = new google.maps.Marker({
                        map: map,
                        position: e.latLng,
                  });
            }
      });
}