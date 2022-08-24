<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$getNotifs = $engine->getNotifs($_SESSION['unique_id']);
$notifsArr = array();

if($getNotifs->rowCount() > 0) {
  foreach($getNotifs as $row) {
    $notifsArr[] = $row;
  }
}

echo json_encode($notifsArr);

?>