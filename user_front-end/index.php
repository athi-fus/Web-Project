<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Its all about HAR</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        
    </script>
</head>

<body>
    <div class="container">
        <div class="nav-wrapper">
            <div class="nav-link-wrapper">
                <a href="#">Basic Analytics</a>
            </div>
            <div class="nav-link-wrapper">
                <a href="analyze-time.html">Response times</a>
            </div>
            <div class="nav-link-wrapper">
                <a href="analyze-headers.html">Headers HTTP</a>
            </div>
            <div class="nav-link-wrapper">
                <a href="map.html">Map for IPs</a>
            </div>
        </div>
    </div>


    <div class="content-wrapper">
        <div class="graph-items-wrapper">
            <div class="graph-item-wrapper">
                <canvas id="myChart" style="width: 100%; height: 60vh; background: #222;border: 1px solid #555652; margin-top: 10px;"></canvas>
                <button id="btn">Get Sum of Registered Users</button>
            </div>
        </div>
    </div>
</body>
<script src="js/chart.js"></script>
</html>