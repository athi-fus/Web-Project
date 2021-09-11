<?php
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} 
else {
    // Redirect them to the login page
    header("Location: login.html");
}
ini_set('display_errors',1);
error_reporting(E_ALL);


$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "webdb";

/*
$serverName = "localhost";
$userName = "athinaf";
$password = "12345#";
$databaseName = 'har_proj';
*/
$filename =  $_FILES['myfile']['name'];
/*echo file_get_contents("test.txt");
echo file_get_contents($filename);*/

$location = "../server_folder/".$filename;

if (move_uploaded_file($_FILES['myfile']['tmp_name'], $location)){
  echo '<p> File uploaded successfully</p>';
}
else{
  echo '<b> Error uploading file.</b>';
}

$isp = $_POST['isp'];
$city = $_POST['city'];
$lon = $_POST['lon'];
$lat = $_POST['lat'];

$redir = 0;
//--------------------------------------

require_once 'vendor/autoload.php';

use JsonMachine\JsonDecoder\ExtJsonDecoder;
use JsonMachine\JsonMachine;

$fp = fopen('cleanFile.json', 'w');

$objects = JsonMachine::fromFile($location, '/log/entries', new ExtJsonDecoder);
foreach($objects as $object){
    foreach ($object as $key => $value) {
            if ($key == "pageref") {
                unset($object->{$key});
            }
            if ($key == "request") {
                foreach($value as $val => $thi){
                    if($val == "bodySize"){
                        unset($object->$key->$val);
                    }
                    if($val == "url"){
                        $object->$key->$val =  parse_url($thi, PHP_URL_HOST);
                    }
                    if($val == "httpVersion"){
                        unset($object->$key->$val);
                    }
                    if($val == "headers"){
                        $object->$key->$val = explode(",", $val);
                        foreach($thi as $valu => $inn){
                            if(strcasecmp($inn->{"name"}, 'Host') == 0 or strcasecmp($inn->{"name"}, 'content-type') == 0 or strcasecmp($inn->{"name"}, 'cache-control') == 0 or strcasecmp($inn->{"name"}, 'pragma') == 0 or strcasecmp($inn->{"name"}, 'expires') == 0 or strcasecmp($inn->{"name"}, 'age') == 0 or strcasecmp($inn->{"name"}, 'last-modified') == 0){
                                continue;
                                
                            }
                            else{
                                unset($object->$key->$val->$inn);
                            }
               
                        }
                    }
                    if($val == "cookies"){
                        unset($object->$key->$val);
                    }
                    if($val == "queryString"){
                        unset($object->$key->$val);
                    }
                    if($val == "headersSize"){
                        unset($object->$key->$val);
                    }
                }
            }
            if ($key == "response") {
                foreach($value as $val => $thi){
                    if($val == "httpVersion"){
                        unset($object->$key->$val);
                    }
                    if($val == "headers"){
                        $x = 0;
                        foreach($thi as $valu => $inn){
                            if(strcasecmp($inn->{"name"}, 'Host') == 0 or strcasecmp($inn->{"name"}, 'content-type') == 0 or strcasecmp($inn->{"name"}, 'cache-control') == 0 or strcasecmp($inn->{"name"}, 'pragma') == 0 or strcasecmp($inn->{"name"}, 'expires') == 0 or strcasecmp($inn->{"name"}, 'age') == 0 or strcasecmp($inn->{"name"}, 'last-modified') == 0){
                                $x++;
                                continue;
                                
                            }
                            else{
                                unset($object->$key->$val[$x]);
                                $x++;
                            }
               
                        }
                        
                    }
                    if($val == "cookies"){
                        unset($object->$key->$val);
                    }
                    if($val == "content"){
                        unset($object->$key->$val);
                    }
                    if($val == "redirectURL"){
                        unset($object->$key->$val);
                    }
                    if($val == "headersSize"){
                        unset($object->$key->$val);
                    }
                    if($val == "bodySize"){
                        unset($object->$key->$val);
                    }
                }
            }
            if ($key == "cache") {
                unset($object->{$key});
            }
            if ($key == "timings") {
                foreach($value as $val => $thi){
                    if($val != "wait"){
                        unset($object->$key->$val);
                    }
                }
            }
            if ($key == "time") {
                unset($object->{$key});
            }
            if ($key == "_securityState") {
                unset($object->{$key});
            }
            if ($key == "connection") {
                unset($object->{$key});
            }


    
}
fwrite($fp, json_encode((array)$object));


}



fclose($fp);
$redir = 1;

$files = glob('../server_folder/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
  }
}

if ($redir == 1) {
    $_SESSION["to_download"] = -1;
    header("Location: ../user_functionality/main_user.php");
    echo $redir;
  //exit;
  }

?>