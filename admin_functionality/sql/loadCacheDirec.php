<?php 
    session_start();
    include 'dbh.php';
    $content_types = $_POST['content_types'];
    $isps = $_POST['isps'];

    $total = array();
    $sql = 
    "SELECT A.value AS ContentType, B.value AS Cacheability, COUNT(*) as Records 
    FROM header A
    INNER JOIN header B ON A.id_entry = B.id_entry
    INNER JOIN entries eA ON eA.id_entry = A.id_entry 
    INNER JOIN entries eB ON eB.id_entry = B.id_entry
    INNER JOIN har_file hf  ON eA.id_har = hf.id_har
    WHERE A.id_entry = B.id_entry 
    AND A.name LIKE 'content-type' 
    AND A.value IN $content_types
    AND hf.provider IN $isps
    AND B.name LIKE 'cache-control' 
    AND (B.value LIKE '%public%' 
    OR B.value Like '%private%' 
    OR B.value Like '%no-cache%' 
    OR B.value Like '%no-store%') 
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