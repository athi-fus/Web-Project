<?php 
    session_start();
    include 'dbh.php';
    $total = array();
    $sql = "SELECT A.value AS ContentType, B.value AS MaxAge, COUNT(*) as Records FROM header A, header B WHERE A.id_entry = B.id_entry AND A.name LIKE 'content-type' AND B.value LIKE '%max-age%' GROUP BY A.value";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $total[] = $row;
        }
    }
    echo json_encode($total);
    $conn->close();
?>