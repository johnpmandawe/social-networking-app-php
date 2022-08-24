<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$currFname = $_POST['firstname'];
$currLname = $_POST['lastname'];
$currAdd = $_POST['address'];
$currCont = $_POST['contact'];
$currEmail = $_POST['email'];
$currUname = $_POST['username'];
$defFname = '';
$defLname = '';
$defAdd = '';
$defCont = '';
$defEmail = '';
$defUname = '';
if (!empty($currFname) && !empty($currLname) && !empty($currAdd) && !empty($currCont) && !empty($currEmail) && !empty($currUname)) {
	foreach ($engine->getUserUniqueId($_SESSION['unique_id']) as $row) {
		$defFname = $row['fname'];
		$defLname = $row['lname'];
		$defAdd = $row['address'];
		$defCont = $row['contact'];
		$defEmail = $row['email'];
		$defUname = $row['uname'];
	}
	if ($row['fname'] == $currFname && $row['lname'] == $currLname && $row['address'] == $currAdd && $row['contact'] == $currCont && $row['email'] == $currEmail && $row['uname'] == $currUname) {
	  echo 'Details didn\'t change. Profile won\'t be updated.';
	} else {
	  $editUserDetails = $engine->editUserDetails($currFname, $currLname, $currAdd, $currCont, $currEmail, $currUname, $_SESSION['unique_id']);
		if($editUserDetails) {
			$_SESSION['name'] = $currFname.' '.$currLname;
			echo 'Profile updated!';
		}
	}
} else {
  echo 'All fields are required.';
}
?>