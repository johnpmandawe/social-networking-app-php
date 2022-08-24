<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
echo $_SESSION['unique_id'];

?>