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
      <div>Encoding:</div>
        <textarea id="encoded-polyline"></textarea>
          <div id="encoded-polyline">
          <table>
          <tr><td></td> <td><input type='hidden' id='start_node'/> </td> </tr>
          <tr><td></td> <td><input type='hidden' id='end_node' /> </td> </tr>
          <tr><td></td> <td><input type='hidden' id='encoded-polyline'/> </td> </tr>
          
          
              <tr><td></td><td><input type='button' value='Save' onclick='saveData()'/></td></tr>

          </table>
        </div>
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
      var encodeString;

      function initMap() {
      
        var lat= 24.006355, lng= 89.249298;
     
      	createMap(lat, lng);
        function createMap(lat,lng){	
        myLatLng = new google.maps.LatLng(lat, lng);
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 16,
           
        });

        createMarker(myLatLng);
        
      }

        var poly = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1,
          strokeWeight: 3,
          map: map
        });

        // Add a listener for the click event
        google.maps.event.addListener(map, 'click', function(event) {
          addLatLngToPoly(event.latLng, poly);
        });
      }
     

      /**
       * Handles click events on a map, and adds a new point to the Polyline.
       * Updates the encoding text area with the path's encoded values.
       */
      function addLatLngToPoly(latLng, poly) {
        var path = poly.getPath();
        console.log("lat = "); 
        console.log(latLng.lat());
        console.log("lng = ");
        console.log(latLng.lng());
        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear
        //console.log("Path = ");
        //console.log(path);
        path.push(latLng);
        /**
          path.push({
          lat: latLng.lat(),
          lng: latLng.lng()
        });
        */
      

       /* var marker = new google.maps.Marker({
          position: latLng,
          title: '#' + path.getLength(),
          icon: 
          map: map
        });*/

        // Update the text field to display the polyline encodings
        jQuery(document).ready(function(){
           //console.log('into = ');
           encodeString = JSON.stringify(path);  
        });
        
        if (encodeString) {

          console.log('encodeString = ');
          console.log(encodeString);  
          document.getElementById('start_node').value = 'start_node';
          document.getElementById('end_node').value = 'end_node';
          document.getElementById('encoded-polyline').value = encodeString;
          console.log('save toform  = ');
         console.log( escape(document.getElementById('encoded-polyline').value));
          
        }

      }

      function saveData(){
          console.log('into saveData = ');
         console.log( escape(document.getElementById('encoded-polyline').value));

        var start_node = escape(document.getElementById('start_node').value);
         var end_node = escape(document.getElementById('end_node').value);
         var encoding = escape(document.getElementById('encoded-polyline').value);
          jQuery(document).ready(function(){

               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/path/input/submit') }}",
                  method: 'post',
                   data: {
                     start_node: 'start_node',
                     end_node: 'end_node',
                     encoding: encodeString
                     
                  },
                   success: function(result){
                     console.log('succeed-path-insert!!!');
                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success); 
                  },
                  error: function(result){ console.log('Error!!!'); }

                });

            }); 
      

      }

     

       function createMarker(latlng,icn='',name='myHome', adr='', type='', lat='', lng=''){
          var marker = new google.maps.Marker({
            map: map,
            position: latlng,
            icon: icn,
            title: name
       
          });
          console.log(name);
          /*console.log(adr);
          console.log(type);
          console.log(lat);
          console.log(lng);
          */

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(name);
          infowindow.open(map, this);
          });
              
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0faAjitkuP2u-PDl9XvVEEUtYitnXb8Y&libraries=places&callback=initMap" async defer></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="jquery-3.3.1.min.js"></script>
  </body>
</html>