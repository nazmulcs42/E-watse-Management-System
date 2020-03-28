
@extends('layouts.collectorlayouts')

    <title>City Maps</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/main.css">
     <script  type="text/javascript" src="jquery-3.3.1.min.js"></script>    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<style>
{
    box-sizing: border-box;
}

body {
  
    padding: 0px;
    background: #f1f1f1;
}

/* Header/Blog Title */



/* Style the top navigation bar */
.topnav {
    overflow: hidden;
    background-color: #333;
}

/* Style the topnav links */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 0px 0px;
    text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
    float: left;
    width: 80%;
}

/* Right column */
.rightcolumn {
    float: left;
    width: 20%;
    background-color: #f1f1f1;
    padding-left: 20px;
}

/* Fake image */
.fakeimg {
    background-color: #aaa;
    width: 100%;
    padding: 3px;
}

/* Add a card effect for articles */
.card {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Footer */
.footer {
    padding: 10px;
    text-align: center;
    background: #ddd;
    margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
    .leftcolumn, .rightcolumn {   
        width: 100%;
        padding: 0;
    }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
    .topnav a {
        float: none;
        width: 100%;
    }
}

.carousel-inner img {
    width: 100%;
    height: 100%;
    padding: 0;
  }

</style>

@section('content')
<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <div class="fakeimg" style="height:450px;">
        <div id="map"></div>
        <div id="right-panel"></div>
          <script>
            var map;
            var infowindow;
            var myLatLng;
            var latlng;
            var icn, name;
            var gname, gaddress, gtype, glat, glng;
            var  decode;
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

                function createMap(lat,lng){  
                myLatLng = new google.maps.LatLng(lat, lng);
                map = new google.maps.Map(document.getElementById('map'), {
                    center: myLatLng,
                    zoom: 16,
                   
                });

                createMarker(myLatLng);
                searchPath(lat,lng);
                
                serchHouseLocation(lat,lng);

                
              }
          }
          function serchHouseLocation(lat,lng){
                  $.post('http://localhost:8000/api/houses',{lat:lat, lng:lng},function(match){
                      //console.log(match);
                      $.each(match, function(i,val){
                        /*console.log(val.name);
                        console.log(val.adress);
                        console.log(val.type);
                        console.log(val.lat);
                        console.log(val.lng);*/
                         gname= val.name;
                         gaddress= val.adress;
                         gtype= val.type;
                         glat= val.lat;
                         glng= val.lng;
                         icn = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

                         infowindow = new google.maps.InfoWindow();
                         var gmyLatLng = new google.maps.LatLng(glat, glng);
                         createMarker(gmyLatLng, icn, gname, gaddress, gtype, glat, glng);



                      });
                  });
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
            

      </div>
      
    </div>
    <div class="card">
      <h2>Next Houses Table</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg" style="height:300px;">
       <p>next house info</p>
        <p>current house info<br/>no.of houses from collector to my house<br/>no.of clients from collector to my house<br/>distance from collectors to my house<br/>provable time to reach my house<br/>date of collectin<br/>number of collector's van </p>
      </div>
      
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h3>Collector information</h3>
      <p>name <br/>phone number<br/>image<br/></p>
      <div class="fakeimg" style="height:240px;">
          <table class="table table-hover table-bordered">
           <tbody>
               
          </tbody>
          </table>

      </div>
    </div>
    <div class="card">
      <h3>moving private notifications</h3>
      <div class="fakeimg" style="height:290px;">
        Notify Users
      </div>
    </div>
    <div class="card">
      <h3>Admin Info</h3>
      <div class="fakeimg" style="height:90px;">
        Admin contact
      </div>
    </div>
  </div>
</div>
@endsection