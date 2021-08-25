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

?>