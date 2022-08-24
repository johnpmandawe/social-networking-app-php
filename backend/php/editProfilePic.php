<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$profile_pic = '';

if (isset($_FILES['pp']) && $_FILES['pp']['name'] != '') {
	foreach($engine->getUserUniqueId($_SESSION['unique_id']) as $row) {$profile_pic = $row['profile_pic'];}
	$extensions = ['jpg', 'jpeg', 'png'];
	$name = $_FILES['pp']['name'];
	$tmp = $_FILES['pp']['tmp_name'];
	$sliced = explode('.', $name);
	if(in_array($sliced[1], $extensions)) {
		$time = time();
		$new_name = $time.$name;
		if(move_uploaded_file($tmp, '../../users/profile_pics/'.$new_name)) {
			unlink('../../users/profile_pics/'.$profile_pic);
			$editProfilePic = $engine->editProfilePic($new_name, $_SESSION['unique_id']);
			if($editProfilePic) {
				echo 'success';
			}
		}
	} else {
		echo 'File is not an image. Try again.';
	}
} else { 
	echo 'Please upload something.'; 
}

?>