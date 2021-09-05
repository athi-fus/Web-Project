<?php 
    include 'dbh.php';
    $ips = array();
    $sql = "SELECT longitude,latitude,COUNT(*) AS records FROM entries GROUP BY longitude ORDER BY records DESC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $ips[] = $row;
        }
    }
    echo  json_encode($ips);
    $conn->close();
?>