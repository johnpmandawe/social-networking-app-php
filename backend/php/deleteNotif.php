<?php 

header('Access-Control-Allow-Origin', '*');
include_once 'config.php';
$engine = new Engine();
$deleteNotif = $engine->deleteNotif($_POST['notif_id']);

if ($deleteNotif) {
  echo 'deleted';
} else { echo 'error'; }

?>