<?php
    require_once __DIR__ . "/vendor/autoload.php";
    
    $collection = (new MongoDb\Client)->tubes_basdatnr->user;

?>