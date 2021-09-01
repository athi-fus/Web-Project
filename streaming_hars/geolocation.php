
<?php


require_once 'vendor/autoload.php';

use \JsonMachine\JsonMachine;

$fruits = JsonMachine::fromFile('techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har', '/log/entries/-/serverIPAddress');
foreach ($fruits as $key => $value) {
    $response = file_get_contents('https://freegeoip.app/json/'.$value);
    $data = json_decode($response);
    echo $data->latitude;
}

?>