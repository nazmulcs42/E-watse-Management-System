<!DOCTYPE html>
<html>
  <head>
    <title>Encoding Methods</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="_token" content="{{csrf_token()}}" />
    <style>
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        width: 50%;
        float: left;
      }
      #right-panel {
        width: 46%;
        float: left;
      }
      #encoded-polyline {
        height: 100px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="right-panel">
      
    </div>
    <script>
      // This example requires the Geometry library. Include the libraries=geometry
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=geometry">
      var map;
      var infowindow;
      var myLatLng;
      var latlng;
      var icn, name;
      var gname, gaddress, gtype, glat, glng;

      function initMap() {
      
        var lat= 24.006355, lng= 89.249298;
     
        createMap(lat, lng);
        function createMap(lat,lng){  
        myLatLng = new google.maps.LatLng(lat, lng);
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 16,
           
        });

        
      }

        var poly = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1,
          strokeWeight: 3,
          map: map
        });

          console.log('Click on map: ');
        // Add a listener for the click event
        google.maps.event.addListener(map, 'click', function(event) {
          addLatLngToPoly(event.latLng, poly);
        });
      }

      function addLatLngToPoly(latLng, poly) {
        var path = poly.getPath();
             path.push(latLng);

        /*jQuery(document).ready(function(){
           console.log('into = ');
          var encodeString = JSON.stringify(path);
          console.log('encodeString = ');
          console.log(encodeString);
          var decode = JSON.parse(encodeString);
          console.log('decode = ');
          console.log(decode);

        });*/

        // Update the text field to display the polyline encodings
        var encodeString = google.maps.geometry.encoding.encodePath(path);
        console.log('encoded : ');
          console.log(encodeString);
    
        if (encodeString) {
          var decodedPolyline = google.maps.geometry.encoding.decodePath(encodeString);

          console.log('decoded : ');        
          console.log(decodedPolyline);
          createPaths(decodedPolyline);
          
        }

      }
 
      function createPaths(paths) {
        var polyline = new google.maps.Polyline({
              path: paths,
              strokeColor: '#FF0000',
              strokeOpacity: 1.5,
              strokeWeight: 2
              
          });

         polyline.setMap(map);
      }

      
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0faAjitkuP2u-PDl9XvVEEUtYitnXb8Y&libraries=places&callback=initMap" async defer></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="jquery-3.3.1.min.js"></script>
  </body>
</html>