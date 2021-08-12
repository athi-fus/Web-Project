<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "webdb";

$connection = mysqli_connect($serverName, $userName, $password, $databaseName);

require_once 'vendor/autoload.php';

 use \JsonMachine\JsonMachine;
 use JsonMachine\JsonDecoder\PassThruDecoder;

 
 $insertRecordQuery = "INSERT INTO har_file VALUES(null,'user1@email.com','cosmote')";

 $result = $connection->query("SELECT MAX(id_har) FROM har_file WHERE user_email = 'user1@email.com';");

 if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
     $har_id = $row["id_har"];
   }
 }

 


 $entries = JsonMachine::fromFile("techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har",'/log/entries', new PassThruDecoder);
 foreach ($entries as $entry){
  $x = 1;
   foreach (JsonMachine::fromString($entry, "") as $data){
    if($x === 2){ //startedDateTime
      
      $date = new DateTime($data);
      $new_data = date_format($date,'Y-m-d H:i:s');
      echo $data."<br>";
    }
    if($x === 3){//request
      $y = 1;
      foreach ($data as &$value) {
        if($y === 2){ //method
          echo $value."<br>";
          
        }
        if($y === 3){ //url
          $url = parse_url($value, PHP_URL_HOST);
          echo $url."<br>";
          
        }
        if ($y === 5){ //headers
          foreach ($value as &$in) {
            $z = 1;
            foreach ($in as &$inn) {
              if($z === 1){ //name
                if(strcasecmp($inn, 'host') == 0 or strcasecmp($inn, 'content-type') == 0 or strcasecmp($inn, 'cache-control') == 0 or strcasecmp($inn, 'pragma') == 0 or strcasecmp($inn, 'expires') == 0 or strcasecmp($inn, 'age') == 0 or strcasecmp($inn, 'last-modified') == 0){
                echo "name:".$inn."<br>";
                }
                else{
                  break;
                }
              }
              if($z === 2){ //value
                echo "value:".$inn."<br>";
              }
              $z++;
          }
        }
        }
        $y++;
      }
    }
    if($x === 4){//response
      $y = 1;
      foreach($data as $value){
        if($y === 1){ //status
          echo $value."<br>";
          
        }
        if($y === 2){ //statusText
          echo $value."<br>";
          
        }
        if ($y === 4){ //headers
          foreach ($value as &$in) {
            $z = 1;
            foreach ($in as &$inn) {
              if($z === 1){ //name
                if(strcasecmp($inn, 'host') == 0 or strcasecmp($inn, 'content-type') == 0 or strcasecmp($inn, 'cache-control') == 0 or strcasecmp($inn, 'pragma') == 0 or strcasecmp($inn, 'expires') == 0 or strcasecmp($inn, 'age') == 0 or strcasecmp($inn, 'last-modified') == 0){
                echo "name:".$inn."<br>";
                }
                else{
                  break;
                }
              }
              if($z === 2){ //value
                echo "value:".$inn."<br>";
              }
              $z++;
          }
        }
        }
        $y++;
      }
    }
    if($x === 6){ //timings
      $y = 1;
      foreach($data as &$inside){
        if($y === 6){ //wait
          echo $inside."<br>";
        }
        $y++;
      }
      
      
    }
    if($x === 9){//serverIPAddress
      echo $data."<br>"; // output: dog
      echo "end foreach \n";
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