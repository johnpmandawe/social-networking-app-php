<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$visited_id = (int)explode('=', $_POST['url'])[1];

$acceptRequest = $engine->acceptRequest($visited_id, $_SESSION['unique_id']);

if ($acceptRequest) {
  echo 'success';
} else { echo 'error'; }

?>