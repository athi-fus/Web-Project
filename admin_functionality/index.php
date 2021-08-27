<?php require_once 'header.php'; ?>

<body>
    <div class="container">
        <div class="nav-wrapper">
            <div class="nav-link-wrapper active-nav-link">
                <a href="index.php">Basic Analytics</a>
            </div>
            <div class="nav-link-wrapper">
                <a href="analyze-time.php">Response times</a>
            </div>
            <div class="nav-link-wrapper">
                <a href="analyze-headers.php">Headers HTTP</a>
            </div>
            <div class="nav-link-wrapper">
                <a href="map.php">Map for IPs</a>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="graph-items-wrapper">
            <div class="graph-item-wrapper" >
                <div class="canvas-item" id="canvas-item">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
                <div class="welcomeText" id="welcomeText">Please select on of the following to be displayed on the graph:</div>
                <div class="buttonsLayout">
                    <button class="selectButton" id="selectUsers">Registered users</button>
                    <button class="selectButton" id="selectReqMethods">Records Per Methods</button>
                    <button class="selectButton" id="selectResponseStatus">Records Per Status</button>
                    <button class="selectButton" id="selectDomains">Distinct Domains</button>
                    <button class="selectButton" id="selectISP">ISP</button>
                    <button class="selectButton" id="selectAge">Average Age Per content-type</button>
                </div>
            </div>   
        </div> 
    </div>
    <script src="js/chartUsers.js"></script>
</body>

</html>
