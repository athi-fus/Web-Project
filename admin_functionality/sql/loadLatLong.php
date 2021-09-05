<?php 
    include 'dbh.php';
    $ips = array();
    $sql = "SELECT e.longitude,e.latitude,COUNT(e.id_entry) AS records,hr.lon,hr.lat
    FROM entries as e
    INNER JOIN har_file as hr ON e.id_har = hr.id_har 
    GROUP BY e.longitude 
    ORDER BY records DESC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $ips[] = $row;
        }
    }
    echo  json_encode($ips);
    $conn->close();
?>