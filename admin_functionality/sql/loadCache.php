<?php 
    session_start();
    include 'dbh.php';
    $total = array();
    $sql = 
    "SELECT A.value AS ContentType 
    FROM header A, header B 
    WHERE A.id_entry = B.id_entry 
    AND A.name LIKE 'content-type' 
    AND B.name LIKE 'cache-control' 
    AND (B.value LIKE '%public%' 
    OR B.value Like '%private%' 
    OR B.value Like '%no-cache%' 
    OR B.value Like '%no-store%') 
    GROUP BY A.value";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $total[] = $row;
        }
    }
    echo json_encode($total);
    $conn->close();
?>