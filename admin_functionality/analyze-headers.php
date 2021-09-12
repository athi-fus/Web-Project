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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <!-- Css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/analyze-header.css">
    
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
                <li class="nav-item">
                    <a class="nav-link" href="analyze-time.php">Response times</a>
                </li>
                <li class="nav-item active">
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
        On first section select one filter for each category and see the results of TTL per Content type on graph.<br><br>
        On second section select one filter for each category and see the results of percentage of cacheability directives on graph.
    </div>
    <section id="sectionTTL">
        <div id="content-types" class="content-types">
            <h5>Content Types</h5>
            <div class="ct-wrapper">
                <div class="ct-checkbox-wrapper">
                    <input type="checkbox" required id="allCT" class="ct-box" value="allCT">
                    <label for="allCT">&nbsp All Content-Types </label>
                </div>
            </div>
        </div>
        <div class="canvas-item" id="canvas-item">
            <canvas class="chart" id="TTLchart"></canvas>
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
        <a href="#sectionCacheability">
            <div class="scroll-down"></div>
        </a>
    </section>
    
    <section id="sectionCacheability">
        <div id="content-types-cache" class="content-types-cache">
            <h5>Content Types</h5>
            <div class="ct-wrapper-cache">
                <div class="ct-checkbox-wrapper-cache">
                    <input type="checkbox" required id="allCT-cache" class="ct-box-cache" value="allCT-cache">
                    <label for="allCT-cache">&nbsp All Content-Types </label>
                </div>
            </div>
        </div>
        <div class="canvas-item" id="canvas-item">
            <canvas class="chart" id="cacheChart"></canvas>
        </div>
        <div id="isps-cache" class="isps-cache">
            <h5>ISPs</h5>
            <div class="isp-wrapper-cache">
                <div class="isp-checkbox-wrapper-cache">
                    <input type="checkbox" required id="allISP-cache" class="isp-box-cache" value="allISP-cache">
                    <label for="allISP-cache">&nbsp All ISPs</label>
                </div>
            </div>
        </div>
        
        <div class="button">
            <button class="selectButton" id="submitCache" class="submit">Submit Filters</button>
        </div>
        <a href="analyze-headers.php">
            <div class="scroll-up"></div>
        </a>
    </section>
    
    
    
    <script src="js/chartTTL.js"></script>
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