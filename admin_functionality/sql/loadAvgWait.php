<?php 
    session_start();
    include 'dbh.php';
    $content_types = $_POST['content_types'];
    $days = $_POST['days'];
    $req_methods = $_POST['req_methods'];
    $isps = $_POST['isps'];
    // print_r($days);

    $total = array();
    $sql = 
    "SELECT HOUR(e.StartedDateTime) AS hour,Round(AVG(e.wait),2) AS Average 
    FROM entries e
    INNER JOIN header hr ON e.id_entry = hr.id_entry
    INNER JOIN har_file hf  ON e.id_har = hf.id_har
    WHERE hr.name LIKE 'content-type' 
    AND hr.value IN $content_types
    AND    DAYOFWEEK(e.StartedDateTime) IN $days
    AND e.req_method IN $req_methods
    AND hf.provider IN $isps
    GROUP BY HOUR(e.StartedDateTime)";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $total[] = $row;
        }
    }
    echo json_encode($total);
    $conn->close();
?>

