<?php

require_once 'vendor/autoload.php';

use JsonMachine\JsonMachine;
use JsonMachine\JsonDecoder\PassThruDecoder;

$entries = JsonMachine::fromFile("techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har",'/log/entries', new PassThruDecoder);
foreach($entries as $entry){
    echo gettype($entry);
}


?>


<html>
    <body>
        <script>

            var entries = [];
            
            entries.push(<?php echo json_encode($entries) ?>);

            alert(entries[0].startedDateTime);
            

        </script>
    </body>
</html>