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
      var myLatLng;
      var latlng;
      var icn, name;

      function initMap() {

        if(navigator.geolocation){
              navigator.geolocation.getCurrentPosition(success,fail);
          }else{
              alert("Browser not supported.")
          }

          function success(position) {
            console.log(position);
            var latVal = position.coords.latitude;
            var lngVal = position.coords.longitude;
            createMap(latVal,lngVal);
          }

          function fail(){
            alert("it's fail.");
          }
        
          
        //var center = {lat: 24.006355, lng: 89.249298};
       function createMap(lat,lng){
        myLatLng = new google.maps.LatLng(lat, lng);
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 15
        });

        createMarker(myLatLng);
        //serchHouseLocation(lat,lng);
        searchNearBy();
      }
        function createMarker(latlng,icn='',name='') {
          var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            icon: icn,
            title: name
       
          });

          google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(name);
          infowindow.open(map, this);
          });
      }
        
    /*function serchHouseLocation(lat,lng){
          $.post('http://localhost:8000/api/houses',{lat:lat lng:lng},function(match){
              console.log(match);
          });
     }*/

     function searchNearBy(){
          var request = {
          location: myLatLng,
          radius: 500,
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
            var place = results[i];
            latlng = place.geometry.location;
            icn = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
            name = place.name;

            createMarker(latlng,icn,name);

          }
        }
      }
  }

    </script>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0faAjitkuP2u-PDl9XvVEEUtYitnXb8Y&libraries=places&callback=initMap" async defer></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </body>
</html>