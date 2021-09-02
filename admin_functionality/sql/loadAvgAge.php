<?php 
    include 'dbh.php';
    $age = array();
    $sql = "SELECT A.value AS ContentType,ROUND(AVG(B.value),2) AS AverageAge FROM header A, header B WHERE A.id_entry = B.id_entry AND A.name LIKE 'content-type' AND B.name LIKE 'age' GROUP BY A.value";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $age[] = $row;
        }
    }else{
        echo 'There are no Ages!';
    }
    // $age = intval($age);
    echo  json_encode($age);
    $conn->close();
?>