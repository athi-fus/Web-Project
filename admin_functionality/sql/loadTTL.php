<?php 
    session_start();
    include 'dbh.php';

    $content_types = $_POST['content_types'];
    $isps = $_POST['isps'];


    $total = array();
    $sql = 
    "SELECT  B.value AS MaxAge, COUNT(*) as Records
    FROM header A
    INNER JOIN header B ON A.id_entry = B.id_entry
    INNER JOIN entries eA ON eA.id_entry = A.id_entry 
    INNER JOIN entries eB ON eB.id_entry = B.id_entry
    INNER JOIN har_file hf  ON eA.id_har = hf.id_har
    WHERE A.name LIKE 'content-type' 
    AND A.value IN $content_types
    AND B.value LIKE '%max-age%' 
    AND hf.isprovider IN $isps
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