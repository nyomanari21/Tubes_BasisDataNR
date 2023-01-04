<?php
    require_once __DIR__ . "/vendor/autoload.php";
    
    $collection = (new MongoDB\Client())->tubes_basdatnr->user;
    $collection_transaksi = (new MongoDB\Client())->tubes_basdatnr->transaksi;
    $collection_driver = (new MongoDB\Client())->tubes_basdatnr->driver;
    $collection_review = (new MongoDB\Client())->tubes_basdatnr->review;
    $collection_riwayat = (new MongoDB\Client())->tubes_basdatnr->riwayat;
?>