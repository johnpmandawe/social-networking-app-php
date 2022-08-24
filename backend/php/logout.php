<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
if (isset($_SESSION['unique_id']) && isset($_SESSION['name'])) {
  unset($_SESSION['unique_id']);
  unset($_SESSION['name']);
  unset($_SESSION['visited_id']);
  echo 'loggedout';
}

?>