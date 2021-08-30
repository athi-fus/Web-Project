<?php 
    session_start();
    include 'dbh.php';
    $total = array();
    $sql = "SELECT HOUR(StartedDateTime) as hour,COUNT(id_entry) as Records,DAYOFWEEK(startedDateTime) AS WEEKDAY FROM `entries`  GROUP BY HOUR(StartedDateTime)";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $total[] = $row;
        }
    }
    // $age = intval($age);
    echo json_encode($total);
    $conn->close();
?>