<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
  $_SESSION["to_download"]+=1;
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


  <title>Please work</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
  <link rel="stylesheet" href="./main_user.css"/>

  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet-heatmap@1.0.0/leaflet-heatmap.js"></script>
  
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

<div id="demo3" name="demo3"></div>

<?php if ($_SESSION["to_download"] == 0): ?>
  <a href="../streaming_hars/cleanFile.json" download>
  <img src="./imgs/cats.jpg"  alt="cat" id='catss' width="104" height="142" onclick="hideDown()">
</a>
<?php endif; ?>


<p><?php echo $_SESSION["to_download"]?></p>



<div id="userStats">
  <h3>My stats:</h3>
    <table>
      <tr>
        <th>Latest Upload</th>
        <th>Num of Records</th>
      </tr>
      <tr>
        <td> </td>
        <td> </td>
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
<form action="../streaming_hars/clearHAR.php" method="post" enctype="multipart/form-data" name="file-form" id="file-form">
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


<div id="demo4"></div>
<script src="ready_download.js"></script>
<div id="map">
  <!--
    <h3>Heatmap</h3>
    <img src="map.png" alt="heatmap example" width="640" height="389"> 
  -->
  <div id="mapid"></div>
</div>
<script src="for_heatmap_test.js"></script> <!--FOR HEATMAP-->

      <script> 

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
          document.getElementById('file-form').action = "../streaming_hars/clearHAR.php";
          
          
        }
      }


      function hideDown() {
          var x = document.getElementById("catss");
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
      } 
      </script>

 

  </body>
</html>
