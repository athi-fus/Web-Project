<?php 
    include 'dbh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            var commentsCount = 2;
            $("#btn").click(function(){
                console.log("Success");
                commentsCount += 2;
                $("#comments").load("loadFields.php", {
                    commentsNewCount: commentsCount
                });
            });
        });
    </script>
    <title>Database Ajax Example</title>
</head>
<body>
    <div id="comments">
        <?php 
            $sql = "SELECT id_entry,value FROM header LIMIT 2";
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
    </div>
    
    <button id="btn">Show more!</button>
</body>
</html>