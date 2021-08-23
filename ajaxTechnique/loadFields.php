<?php 
    include 'dbh.php';

    $commentsNewCount = $_POST['commentsNewCount'];

    $sql = "SELECT id_entry,value FROM header LIMIT $commentsNewCount";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<p>";
            echo $row['id_entry'];
            echo "<br>";
            echo $row['value'];
            echo "</p>";

        }
    }else{
        echo 'There are no comments!';
    }
?>