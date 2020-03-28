<!DOCTYPE html>
<html>
  <head>
    <title>decoding Methods</title>
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
        width: 100%;
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
      var  decode;

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
        searchPath(lat,lng);

        
      }
    }
     
 

       function searchPath(lat,lng){
          $.post('http://localhost:8000/api/paths',{lat:lat, lng:lng},function(match){
           
              $.each(match, function(i,val){
                 var start_node= val.startNode;
                 var end_node= val.endNode;
                  encodedString= val.encodedstring;

                 DrawPolyline(encodedString);

              });
          });
     }

      function DrawPolyline(encodeString) {
          console.log('encoded value= ');
          console.log(encodeString);

           if (encodeString) {
              jQuery(document).ready(function(){
                console.log('into->show = ');
                
                decode = JSON.parse(encodeString);
                var path = [];
            for (var i = 0; i < decode.j.length; i++) {
                  path.push({
                    lat: decode.j[i].lat,
                    lng: decode.j[i].lng
                  });
            }
   
                createPaths(path);

            });
          
        }

      }

      function createPaths(paths) {
        console.log('pathdraw= ');
        var polyline = new google.maps.Polyline({
              path: paths,
              strokeColor: '#FF0000',
              strokeOpacity: 1.5,
              strokeWeight: 2
              
          });
          console.log(polyline);
         polyline.setMap(map);
         //polyline.setMap(null);


      }


       function createMarker(latlng,icn='',name='myHome', adr='', type='', lat='', lng=''){
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
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0faAjitkuP2u-PDl9XvVEEUtYitnXb8Y&libraries=places&callback=initMap" async defer></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </body>
</html>