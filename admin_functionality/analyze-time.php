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
    <meta class="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/image.png" type="image/gif" sizes="16x16">
    <title>Its all about HAR</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <!-- Css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/analyze-time.css">
    
   
    
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
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Basic Analytics</a>
                </li>
                <li class="nav-item active">
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
    <div class="welcomeText">
        Select one filter for each category and scroll-down to see the graph:
    </div>
    <section id="sectionCheckboxes">
        <div id="content-types" class="content-types">
            <h5>Content Types</h5>
            <div class="ct-wrapper">
                <div class="ct-checkbox-wrapper">
                    <input type="checkbox" required id="allCT" class="ct-box" value="allCT">
                    <label for="allCT">&nbsp All Content-Types </label>
                </div>
            </div>
        </div>
        <div id="days" class="days">
            <h5>Days of week</h5>
            <div class="days-wrapper">
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="allDays" class="days-box" value="allDays">
                    <label for="allDays">&nbsp All days</label>
                </div>
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="Sunday" class="days-box" value="1">
                    <label for="Sunday">&nbsp Sunday</label>
                </div>
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="Monday" class="days-box" value="2">
                    <label for="Monday">&nbsp Monday</label>
                </div>
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="Tuesday" class="days-box" value="3">
                    <label for="Tuesday">&nbsp Tuesday</label>
                </div>
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="Wednesday" class="days-box" value="4">
                    <label for="Wednesday">&nbsp Wednesday</label>
                </div>
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="Thursday" class="days-box" value="5">
                    <label for="Thursday">&nbsp Thursday</label>
                </div>
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="Friday" class="days-box" value="6">
                    <label for="Friday">&nbsp Friday</label>
                </div>
                <div class="days-checkbox-wrapper">
                    <input type="checkbox" required id="Suturday" class="days-box" value="7">
                    <label for="Saturday">&nbsp Saturday</label>
                </div>   
            </div> 
        </div>
        <div id="req-methods" class="req-methods">
            <h5>HTTP request methods</h5>
            <div class="rm-wrapper">
                <div class="rm-checkbox-wrapper">
                    <input type="checkbox" required id="allRM" class="rm-box" value="allRM">
                    <label for="allRM">&nbsp All HTTP request methods</label>
                </div>
            </div>   
        </div>
        <div id="isps" class="isps">
            <h5>ISPs</h5>
            <div class="isp-wrapper">
                <div class="isp-checkbox-wrapper">
                    <input type="checkbox" required id="allISP" class="isp-box" value="allISP">
                    <label for="allISP">&nbsp All ISPs</label>
                </div>
            </div>
        </div>
        <div class="button">
            <button class="selectButton" id="submit" class="submit">Submit Filters</button>
        </div>
        <a href="#sectionGraph">
            <div class="scroll-down"></div>
        </a>  
    </section>
    <section id="sectionGraph">
        <div class="canvas-item" id="canvas-item">
            <canvas class="chart" id="myChart2"></canvas>
        </div>
        <a href="analyze-time.html">
            <div class="scroll-up"></div>
        </a>
    </section>
    <script src="js/loadCheckboxes.js"></script>
    <script src="js/chartResponseTimes.js"></script>
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