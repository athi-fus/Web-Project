<?php 
    session_start();
    include 'dbh.php';
    $methods = array();
    $sql = "SELECT req_method,COUNT(*) as number FROM entries GROUP BY req_method";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $methods[] = $row;
        }
    }
    echo  json_encode(array_values($methods));
    $conn->close();
?>
