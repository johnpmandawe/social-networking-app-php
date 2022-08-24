<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
  date_default_timezone_set('Asia/Manila');
$engine = new Engine();
$notif_date = date('M j Y G:i:s');
$req_to = explode('=', $_POST['url'])[1];
$message = $_SESSION['name'] . ' ' . 'sent you a friend request.';

$addFriend = $engine->addFriend($_SESSION['unique_id'], $req_to);
if($addFriend) {
  $newNotif = $engine->newNotif($message, $_SESSION['unique_id'], $req_to, $notif_date, 'request');
  if($newNotif) {
    echo 'success';
  }
} else {
	echo 'error';
}

?>