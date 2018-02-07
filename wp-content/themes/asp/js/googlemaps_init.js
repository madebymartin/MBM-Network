function initialize() {
  var myLatlng = new google.maps.LatLng(51.480160100000000000,-0.019258199999967474);
  var mapOptions = {
    zoom: 9,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
  });
}

google.maps.event.addDomListener(window, 'load', initialize);