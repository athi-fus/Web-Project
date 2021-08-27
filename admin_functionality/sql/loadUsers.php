<?php 
    include 'dbh.php';
    $users = '';
    $sql = "SELECT COUNT(username) FROM users";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $users =  $row['COUNT(username)'];
        }
    }else{
        echo 'There are no users!';
    }
    $users = intval($users);
    echo json_encode($users);
    $conn->close();
?>