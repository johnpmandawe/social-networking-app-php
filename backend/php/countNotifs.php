<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$countNotifs = $engine->countNotifs($_SESSION['unique_id']);
echo $countNotifs->rowCount();

?>