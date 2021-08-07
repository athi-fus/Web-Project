<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "webdb";

$connection = mysqli_connect($serverName, $userName, $password, $databaseName);

require_once 'vendor/autoload.php';

 use \JsonMachine\JsonMachine;
 use JsonMachine\JsonDecoder\PassThruDecoder;

 $fruits = JsonMachine::fromFile("techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har",'/log/entries', new PassThruDecoder);
 foreach ($fruits as $fruit){
   foreach (JsonMachine::fromString($fruit, "/startedDateTime") as $data){
   //print_r($startedDateTime);
    $date = new DateTime($data);
    $new_data = date_format($date,'Y-m-d H:i:s');
    $insertRecordQuery = "INSERT INTO hars VALUES('".$new_data."')";
    if(mysqli_query($connection, $insertRecordQuery)){
       echo "success";
    }
    else{
       echo "error:".mysqli_error($connection);
    }
  }
 }

?>