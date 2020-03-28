<!DOCTYPE html >
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="_token" content="{{csrf_token()}}" />
    <title>Edit Map</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        width: 100%
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

  </head>
  <body>
    <div id="map" height="460px" width="100%">
      
    </div>
    <div id="form">
      <table>
      <tr><td>Name:</td> <td><input type='text' id='name' value=''/> </td> </tr>
      <tr><td>Address:</td> <td><input type='text' id='address' value=''/> </td> </tr>
      <!--<tr> <td><input type='hidden' id='glat' value=event.latLng.lat()/> </td> </tr>
      <tr> <td><input type='hidden' id='glng' value=event.latLng.lng()/> </td> </tr>
     -->
      <tr><td>Type:</td> <td><select id='type'> +
                 <option value='' SELECTED></option>
                 <option value='house' >house</option>
                 <option value='school'>school</option>
                 <option value='hotel'>hotel</option>
                 <option value='hospital'>hospital</option>
                 <option value='hospital'>store</option>
                 <option value='hospital'>Others</option>
                 </select> </td></tr>
                 <tr><td></td><td><input type='button' value='Save' onclick='saveData()'/></td></tr>
      </table>
    </div>
    <div id="message"><!--Location saved--></div>
    <script>

      var map;
      var marker;
      var infowindow;
      var messagewindow;
      var gname, gaddress, gtype, glat, glng;

      function initMap() {
         if(navigator.geolocation){
              navigator.geolocation.getCurrentPosition(success,fail);
          }else{
              alert("Browser not supported.");
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
        
       function createMap(lat,lng){
        myLatLng = new google.maps.LatLng(lat, lng);
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 17,
            tilt: 90,
            heading: 90
        });
        createMarker(myLatLng);
     // }

        infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
        });

        messagewindow = new google.maps.InfoWindow({
          content: document.getElementById('message')
        });

        google.maps.event.addListener(map, 'click', function(event) {
          var marker = new google.maps.Marker({
            position: event.latLng,
            map: map,
            draggable:true,
          });


          google.maps.event.addListener(marker, 'click', function(event) {
            infowindow.open(map, marker);
          });
           glat = event.latLng.lat();
           glng = event.latLng.lng()
          
        });
      }//end of createMap func
      }//end of initMap func


       function createMarker(latlng,icn='',name='') {
          let marker = new google.maps.Marker({
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

      function saveData() {

         gname = escape(document.getElementById('name').value);
         gaddress = escape(document.getElementById('address').value);
         gtype = document.getElementById('type').value;
       /* var glat = document.getElementById('glat').value;
        var glng = document.getElementById('glng').value;
        var latlng = marker.getPosition();//doesn't work
       name: jQuery('#name').val(),
       address: jQuery('#address').val(),
       type: jQuery('#type').val(),*/
      
        console.log(gname);
        console.log(gaddress);
        console.log(gtype);
        console.log(glat);
        console.log(glng);

        jQuery(document).ready(function(){

               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/house/input/submit') }}",
                  method: 'post',
                   data: {
                     name: jQuery('#name').val(),
                     address: jQuery('#address').val(),
                     type: jQuery('#type').val(),
                     lat: glat,
                     lng: glng
                  },
                   success: function(result){
                     console.log('succeed-me!!!');
                     jQuery('.alert').show();
                     jQuery('.alert').html(result.success); 
                  },
                  error: function(result){ console.log('Error!!!'); }

                });

            });  
     
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0faAjitkuP2u-PDl9XvVEEUtYitnXb8Y&callback=initMap">
    </script>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </body>
</html>