<!DOCTYPE html>
<!-- 
  <script>
   for creating device location->
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(success,fail);
    }else{
        alert("Browser not supported.")
    }
    </script>
-->
<html>
  <head>
    <title>Place Searches</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var map;
      var infowindow;
      var LatLng;
      var titleName;
      var icn;
      //var marker = "https://maps.gstatic.com/mapfiles/place_api/icons/school-71.png";

      function initMap() {
        var center = {lat: 24.006355, lng: 89.249298};

        map = new google.maps.Map(document.getElementById('map'), {
          center: center,
          zoom: 15
        });

        var request = {
          location: center,
          radius: 100,
          type: ['school']
        }

        infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);
      }

      function callback(results, status) {
        console.log(results);
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);

          }
        }
      }

     function createMarker(place) {
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location,
          icon: "https://maps.gstatic.com/mapfiles/place_api/icons/school-71.png"
     
        });

        google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
        });
      }
    </script>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0faAjitkuP2u-PDl9XvVEEUtYitnXb8Y&libraries=places&callback=initMap" async defer></script>
  </body>
</html>