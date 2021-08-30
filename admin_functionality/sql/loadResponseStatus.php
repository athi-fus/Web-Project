<?php 
    session_start();
    include 'dbh.php';
    $status = array();
    $sql = "SELECT res_status,COUNT(*) as number FROM entries GROUP BY res_status";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $status[] = $row;
        }
    }else{
        echo 'There are no statuses!';
    }
    echo  json_encode(array_values($status));
    $conn->close();
?>