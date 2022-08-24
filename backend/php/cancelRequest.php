<?php

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$visited_id = (int)explode('=', $_POST['url'])[1];
$engine = new Engine();

$cancelRequest = $engine->cancelRequest($visited_id, $_SESSION['unique_id']);

if($cancelRequest) {
  echo 'success';
} else {
	echo 'error';
}

?>