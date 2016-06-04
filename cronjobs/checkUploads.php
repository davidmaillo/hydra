<?php

require dirname(dirname(__FILE__)) . "/bootstrap.php";

use Kat\User;
use Hydra\Hydra;
use Hydra\Provider;

// SETUP
$uploaderNick = "DWizz";
$pasteType = Provider::TYPE_PRIVATE; // this can also be Provider::TYPE_PUBLIC
// ---------------

$user = new User(["nick" => $uploaderNick]);

$uploads = $user->getUploads(); // will copy all uploads
// If you only want today's uploads 
// $uploads = $user->getUploads(1, strtotime(date("Y-m-d"))); // timestamp

foreach ($uploads as $basicData)
{
    $upload = $basicData->getFullInfo();
    
    $text = "Magnet: " . $upload->magnet . "\nTorrent: " .  $upload->torrent . "\nText: " .  $upload->text;
    
    $r = $hydra->publish($upload->name, $text, $pasteType);
    //print_r($r); will return the created paste code ex: pM85AxFM, or false
}