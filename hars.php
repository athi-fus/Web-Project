<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "webdb";

$connection = mysqli_connect($serverName, $userName, $password, $databaseName);

require_once 'vendor/autoload.php';

 use \JsonMachine\JsonMachine;
 use JsonMachine\JsonDecoder\PassThruDecoder;

 /*
 $insertRecordQuery = "INSERT INTO har_file VALUES(null,'user1@email.com','cosmote')";

 $result = $connection->query("SELECT MAX(id_har) FROM har_file WHERE user_email = 'user1@email.com';");

 if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
     $har_id = $row["id_har"];
   }
 }

 
*/

 $entries = JsonMachine::fromFile("techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har",'/log/entries', new PassThruDecoder);
 foreach ($entries as $entry){
  $x = 1;
   foreach (JsonMachine::fromString($entry, "") as $data){
    if($x === 2){
      //first item
      echo $data; // output: dog
      
    }
    if($x === 3){
      $y = 1;
      foreach ($data as &$value) {
        if ($y === 5){
          foreach ($value as &$in) {
            foreach ($in as &$inn) {
              echo $inn;
          }
        }
        }
        $y++;
      }
    }
    if($x === 9){
      //first item
      echo $data; // output: dog
      echo "end foreach";
    }
    $x++;
   //print_r($startedDateTime);
    //$date = new DateTime($data);
    //$new_data = date_format($date,'Y-m-d H:i:s');
    /*
    $insertRecordQuery = "INSERT INTO entries VALUES('".$new_data."')";
    if(mysqli_query($connection, $insertRecordQuery)){
       echo "success";
    }
    else{
       echo "error:".mysqli_error($connection);
    }
    */
  }
 }

?>