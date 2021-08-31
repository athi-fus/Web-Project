<?php 
    session_start();
    include 'dbh.php';
    $total = array();
    $sql = "SELECT DISTINCT value as ContentType FROM `header` WHERE name LIKE 'content-type'";
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