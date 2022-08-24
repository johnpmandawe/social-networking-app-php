<?php

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
parse_str($_POST['loginForm'], $output); // Extracting form data from ajax

$uname = $output["username"];
$pword = $output["password"];

$getLoginDetails = $engine->getLoginDetails($uname, $pword);

if (!empty($uname) && !empty($pword)) {
  if ($getLoginDetails->rowCount() > 0) {
    foreach ($getLoginDetails as $row) {
      $_SESSION['unique_id'] = $row['unique_id'];
      $_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];
    }
    echo "success";
  } else {
    echo "Invalid username or password.";
  }
} else {
  echo "All fields are required.";
}


?>