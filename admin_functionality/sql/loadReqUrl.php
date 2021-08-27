<?php 
    include 'dbh.php';
    $url = array();
    $sql = "SELECT COUNT(DISTINCT req_url) FROM entries";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $url = $row['COUNT(DISTINCT req_url)'];
        }
    }else{
        echo 'There are no domains!';
    }
    $url = intval($url);
    echo  json_encode($url);
    $conn->close();
?>