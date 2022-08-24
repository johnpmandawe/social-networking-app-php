<?php 

header('Access-Control-Allow-Origin', '*');
include_once 'config.php';
$engine = new Engine();
$notif_id = (int)$_POST['notif_id'];
$openNotif = $engine->openNotif($notif_id);

if($openNotif) {
  echo 'opened';
} else { echo 'error'; }

?>