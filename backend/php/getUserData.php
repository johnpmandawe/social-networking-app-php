<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$json_arr = array();

foreach ($engine->getUserUniqueId($_SESSION['unique_id']) as $row) {
  $json_arr[] = $row;
}

echo json_encode($json_arr);
?>