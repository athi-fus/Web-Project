<?php require_once 'header.php'; ?>

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
