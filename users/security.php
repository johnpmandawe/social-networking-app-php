<?php 

session_start();
include_once '../backend/php/config.php';

$engine = new Engine();

$getUserUniqueId = $engine->getUserUniqueId($_SESSION['unique_id']);

if(!$getUserUniqueId->rowCount() > 0) {
  header("location: ../");
}

?>