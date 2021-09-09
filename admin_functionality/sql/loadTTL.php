<?php 
    session_start();
    include 'dbh.php';

    $content_types = $_POST['content_types'];
    // $isps = $_POST['isps'];


    $total = array();
    $sql = 
    "SELECT  B.value AS MaxAge, COUNT(*) as Records 
    FROM header A, header B 
    WHERE A.id_entry = B.id_entry 
    AND A.name LIKE 'content-type' 
    AND B.value LIKE '%max-age%' 
    AND A.value IN $content_types
    GROUP BY A.value,B.value";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $total[] = $row;
        }
    }
    echo json_encode($total);
    $conn->close();
?>