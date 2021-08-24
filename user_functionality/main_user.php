<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} 
else {
    // Redirect them to the login page
    header("Location: login.html");
}
?>

<html>
  <head>
  <link rel="icon" href="imgs/image.png" type="image/gif" sizes="16x16">
  <style>
    body{
            /* background-image: url("cats.jpg");*/
            height: 100%;
            background-image: linear-gradient(to bottom right, rgb(102, 178, 2535), rgb(0, 0, 102));
        }
    
    #userStats{
      border: 3px solid #62aad3;
      background-color: rgba(240, 240, 240, 0.8);
      font-family: Arial, Helvetica, sans-serif;
      display: block;
      width: 300px;
      padding: 1px;
      margin-top: 5px;
      padding-left: 10px;
      padding-bottom: 10px;
      border-radius: 3%;
      position: absolute;
      top: 250px;
      left: 10%;
    }

    #upload{
      border: 3px solid #62aad3;
      background-color: rgba(240, 240, 240, 0.8);
      font-family: Arial, Helvetica, sans-serif;
      display: block;
      width: 300px;
      padding: 1px;
      margin-top: 5px;
      padding-left: 10px;
      padding-bottom: 10px;
      border-radius: 3%;
      position: absolute;
      top: 420px;
      left: 10%;
    }
    /*
    #map{
      border: 3px solid #62aad3;
      background-color: rgba(240, 240, 240, 0.8);
      font-family: Arial, Helvetica, sans-serif;
      display: block;
      width: 680px;
      height: 460px;
      padding: 1px;
      margin-top: 5px;
      padding-left: 10px;
      padding-bottom: 10px;
      
      position: absolute;
      top: 150px;
      left: 50%;
    }  */  

    #welcome{
      color: white;
    }

    #mapid {
      border: 5px blue;
      display: block;
      width: 680px;
      height: 460px;
      padding: 1px;
      margin-top: 5px;
      padding-left: 10px;
      padding-bottom: 10px;
      border-radius: 1%;
      position: absolute;
      top: 150px;
      left: 50%; }




    #mysubmit {
      background-color: rgb(40, 38, 43);
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      width: 160px;


    /*----------------------------------------------------------------------------------------------------------------------*/
    /*----------------------------------------------------------------------------------------------------------------------*/
   
    }



  input[type=file] {
  position: absolute;
  top:-5px; /* size of border */
  left:-5px; /* size of border */
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  width: 240px;
  height: 50px;
  border: 1px solid red;
  opacity: 0; /* hide actual input */
  cursor: pointer
}

.fakeFileButton {
  position: relative;
  margin: 0;
  padding: 15px 32px;
  margin: 4px 2px;
  /*width: 240px;  same as button */
  height: 50px; /* same as button */
  background-color: rgb(40, 38, 43);
  border: none;
  font-size: 16px;
  color: rgb(255,255,255);
  text-align: center;
  width: 160px;
  display: inline-block;
}
.fakeFileButton:hover {
  background-color: rgb(100,150,255);
  color: rgb(0,0,0);
}

  </style>

  <title>Please work</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet-heatmap@1.0.0/leaflet-heatmap.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
      <img src="imgs/image.png" width="30" height="30" class="d-inline-block align-top" alt="">
      harHARias</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Me</a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="changeuname.php">Change Username</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="changepass.php">Change Password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
          </li>
          
      </div>
    </nav>



<?php 
echo '<h1 id="welcome"> Hello, '.$_SESSION["uname"].'</h1>';
?>

<div id="userStats">
<h3>My stats:</h3>
<ul>
  <li>Date of latest upload:</li>
  <li>Total of uploads:</li>
</ul>  

</div>

<div id="upload">
<h4>Select a file:</h4>
<form action="/action_page.php">
  <!--<label for="myfile">Select a file:<br></label>-->
  <div class="fakeFileButton">
    Browse
    <input type="file" id="myfile" name="myfile"><br><br>
  </div>
  
  <input type="submit" id = 'mysubmit' value = "Upload">
</form>
</ul>  

</div>

<div id="map">
  
  <!--
    <h3>Heatmap</h3>
    <img src="map.png" alt="heatmap example" width="640" height="389"> 
  -->
  <div id="mapid"></div>
</div>

<script> 
    
        //let mymap = L.map('mapid');

        var mymap = L.map('mapid').setView([38.272689, 21.621094], 13);
        
        var  baselayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 10,
        id: 'mapbox/satellite-v9',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoiYXRoaWZ1cyIsImEiOiJja3M0ZmxsNDgyNGp2MnFtc2Zuc3ZhMzVhIn0.7ksVgRuaF49NHovtEWChXA'
        }).addTo(mymap);

        var marker = L.marker([38.107547, 21.502991]).addTo(mymap);
        marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

        //click event
        //function onMapClick(e) {
        //alert("You clicked the map at " + e.latlng);
        //}
        //mymap.on('click', onMapClick);

        var popup = L.popup();

        function onMapClick(e) {
            popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(mymap);
        }

        mymap.on('click', onMapClick);



/*
let mymap = L.map("mapid");
let osmUrl = "https://tile.openstreetmap.org/{z}/{x}/{y}.png";
let osmAttrib =
  'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
let osm = new L.TileLayer(osmUrl, { attribution: osmAttrib });
mymap.addLayer(osm);
mymap.setView([38.246242, 21.7350847],8);
*/

let testData = {
  max: 8,
  data: [
{lat: 38.246242, lng: 21.735085, count:3},
{lat: 38.323343, lng: 21.865082, count:2},
{lat: 38.34381, lng: 21.57074, count:8},
{lat: 38.108628, lng: 21.502075, count:7},
{lat: 38.123034, lng: 21.917725, count:4}]
};
  
let cfg = {
  // radius should be small ONLY if scaleRadius is true (or small radius is intended)
  // if scaleRadius is false it will be the constant radius used in pixels
  "radius": 40,
  "maxOpacity": 0.8,
  // scales the radius based on map zoom
  "scaleRadius": false,
  // if set to false the heatmap uses the global maximum for colorization
  // if activated: uses the data maximum within the current map boundaries
  //   (there will always be a red spot with useLocalExtremas true)
  "useLocalExtrema": false,
  // which field name in your data represents the latitude - default "lat"
  latField: 'lat',
  // which field name in your data represents the longitude - default "lng"
  lngField: 'lng',
  // which field name in your data represents the data value - default "value"
  valueField: 'count'
};

let heatmapLayer =  new HeatmapOverlay(cfg);

mymap.addLayer(heatmapLayer);
heatmapLayer.setData(testData);
     

        </script>

  </body>
</html>
