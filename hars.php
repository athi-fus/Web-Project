<?php

require_once 'vendor/autoload.php';
 $stream = fopen('techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har', 'r');
$listener = new \JsonStreamingParser\Listener\InMemoryListener();
$items = [];
try {
  $parser = new \JsonStreamingParser\Parser($stream, $listener);
  $parser->parse();
  fclose($stream);
} catch (Exception $e) {
  fclose($stream);
  throw $e;
}
?>