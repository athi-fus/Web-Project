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
    header("Location: ../user_functionality/login.html"); //BALE TO SWSTO PATH
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/image.png" type="image/gif" sizes="16x16">
    <title>Its all about HAR</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    

    <!-- Css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    
    <!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

</head>


<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="imgs/image.png" width="30" height="30" class="d-inline-block align-top" alt="">harHARias</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Basic Analytics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="analyze-time.php">Response times</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="analyze-headers.php">Headers HTTP</a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link" href="map.php">Map for IPs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user_functionality/logout.php">Logout</a>
                </li>
            </ul> 
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="graph-items-wrapper">
            <div class="graph-item-wrapper" >
                <div class="welcomeText" id="welcomeText">Please select one of the following to be displayed on the graph:</div>
                <div class="buttonsLayout">
                    <button class="selectButton" id="selectUsers">Registered users</button>
                    <button class="selectButton" id="selectReqMethods">Records Per Methods</button>
                    <button class="selectButton" id="selectResponseStatus">Records Per Status</button>
                    <button class="selectButton" id="selectDomains">Distinct Domains</button>
                    <button class="selectButton" id="selectISP">ISP</button>
                    <button class="selectButton" id="selectAge">Average Age Per content-type</button>
                </div>
                <div class="canvas-item" id="canvas-item">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
            </div>   
        </div> 
    </div>
    <script src="js/chartUsers.js"></script>
</body>

</html>
<!-- 
 _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _       
|             Creators:                      |  
|Athina Fouseki, Github:athi-fus             |  
|Katerina Dervou, Github: katderv            |  
|Konstantinos Kaskantiris, Github:KwstasKaska|
|_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ |  
                    
 -->