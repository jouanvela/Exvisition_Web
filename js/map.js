  /*icon*/
var customIcons = {
  obstacle: {
    icon: 'https://www.gstatic.com/mapspro/images/stock/1125-crisis-caution.png',
    scaledSize: new google.maps.Size(10, 10)
  },
  wheelchair: {
    icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
  },
  visual: {
    icon: 'http://labs.google.com/ridefinder/images/mm_20_yellow.png'
  }
};

/*map*/
function load() {
  var map = new google.maps.Map(document.getElementById("map"), {
    center: new google.maps.LatLng(23.974040, 120.979943),
    zoom: 16,
    mapTypeId: 'roadmap'
  });
  var infoWindow = new google.maps.InfoWindow({map: map});

  // HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('You are here!');
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }

  // Load markers
  downloadUrl("map_genxml2.php", function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("marker");
    for (var i = 0; i < markers.length; i++) {
      var place = markers[i].getAttribute("place");
      var description = markers[i].getAttribute("description");
      var type = markers[i].getAttribute("type");
      var point = new google.maps.LatLng(
          parseFloat(markers[i].getAttribute("lat")),
          parseFloat(markers[i].getAttribute("lng")));
      var html = "<a href='#'><b>" + place + "</b></a><br>" + description;
      var icon = customIcons[type] || {};
      var marker = new google.maps.Marker({
        map: map,
        position: point,
        icon: icon.icon
      });
      bindInfoWindow(marker, map, infoWindow, html);
    }
  });
}

function bindInfoWindow(marker, map, infoWindow, html) {
  google.maps.event.addListener(marker, 'click', function() {
    infoWindow.setContent(html);
    infoWindow.open(map, marker);
  });
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
    new ActiveXObject('Microsoft.XMLHTTP') :
    new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
}