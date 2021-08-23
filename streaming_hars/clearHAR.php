<?php


require_once 'vendor/autoload.php';

use JsonMachine\JsonDecoder\ExtJsonDecoder;
use JsonMachine\JsonMachine;

$fp = fopen('cleanFile.json', 'w');

$objects = JsonMachine::fromFile('techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har', '/log/entries', new ExtJsonDecoder);
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
                        foreach($thi as $valu => $inn){
                            if(strcasecmp($inn->{"name"}, 'Host') == 0 or strcasecmp($inn->{"name"}, 'content-type') == 0 or strcasecmp($inn->{"name"}, 'cache-control') == 0 or strcasecmp($inn->{"name"}, 'pragma') == 0 or strcasecmp($inn->{"name"}, 'expires') == 0 or strcasecmp($inn->{"name"}, 'age') == 0 or strcasecmp($inn->{"name"}, 'last-modified') == 0){
                                echo $inn->{"name"};
                                continue;
                                
                            }
                            else{
                                echo "in else";
                                unset($object->$key->$val->$inn);
                            }
               
                        }
                    }
                }
            }
    
}
fwrite($fp, json_encode((array)$object));
}



fclose($fp);

?>