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
      padding-right: 10px;
      padding-bottom: 10px;
      border-radius: 3%;
      position: absolute;
      top: 240px;
      left: 10%;
    }

    #upload{
      border: 3px solid #62aad3;
      background-color: rgba(240, 240, 240, 0.8);
      font-family: Arial, Helvetica, sans-serif;
      display: block;
      width: 220px;
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

/*------------------------------------------------------------------------------------------- */
.switch {
  position: relative;
  display: inline-block;
  width: 120px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #3D2AAD;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #3DA8AD;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(85px);
  -ms-transform: translateX(85px);
  transform: translateX(85px);
}

/*------ ADDED CSS ---------*/
.on
{
  display: none;
}

.on, .off
{
  color: white;
  position: absolute;
  transform: translate(-50%,-50%);
  top: 50%;
  left: 50%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
}

input:checked+ .slider .on
{display: block;}

input:checked + .slider .off
{display: none;}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;}

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
table, td, th {  
  border: 1px solid black;
  text-align: left;
  font-size: 15px;
  align-self: center;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 10px;
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
    <table>
      <tr>
        <th>Latest Upload</th>
        <th>Num of Records</th>
      </tr>
      <tr>
        <td>Peter</td>
        <td>Griffin</td>
      </tr>
    </table>
</div>

<script src="basic_stats.js"></script>

<div id="upload">
<h4>Select a file:</h4>
<!-- Rectangular switch -->
<label class="switch">
 <input type="checkbox" id="togBtn" onclick="onOff()">
 <div class="slider round">
  <!--ADDED HTML -->
  <span class="on">Upload</span>
  <span class="off">Download</span>
  <!--END-->
 </div>
</label>
<form action="../test2.php" method="post" enctype="multipart/form-data" name="file-form" id="file-form">
  <!--"../streaming_hars/hars.php"-->
  
  <div class="fakeFileButton" onmouseover="getInfo()">
    Browse
    <input type="file" id="myfile" name="myfile"><br><br>
  </div>
  <input type="hidden" id="isp" name="isp" >
  <input type="hidden" id="city" name="city" >
  <input type="hidden" id="lat" name="lat" >
  <input type="hidden" id="lon" name="lon" >
  <input type="submit" id = 'mysubmit' value = "File Away">
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
     
function getInfo(){
                $.getJSON('http://ip-api.com/json', function(data) {
                //console.log(JSON.stringify(data, null, 2));
                document.getElementById("isp").value = data.org;
                document.getElementById("city").value = data.city;
                document.getElementById("lat").value = data.lat;
                document.getElementById("lon").value = data.lon;
            });
            } 


function onOff(){
  var isChecked=document.getElementById("togBtn").checked;
  //alert(isChecked);

  if( isChecked == true) {
    document.getElementById('file-form').action = "../streaming_hars/hars.php";   
  }
  else{
    document.getElementById('file-form').action = "../test2.php";
    
     
  }
}
        </script>

 

  </body>
</html>
