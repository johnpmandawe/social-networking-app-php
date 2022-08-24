<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$visited_user_id = (int)explode('=', $_POST['url'])[1];
$_SESSION['visited_id'] = $visited_user_id;
$visited_data_arr = array();
$pushed_visited_data_arr = array();
$pushed_visited_profile_arr = array();
$accepted = 'stranger';
$getRequests = $engine->getRequests();
$getUserPosts = $engine->getVisitedUserPosts($visited_user_id);
$getUserProfilePic = $engine->getUserProfilePic($visited_user_id);

foreach($getRequests as $row) {
	if ($_SESSION['unique_id'] == $row['req_from'] AND $visited_user_id == $row['req_to']) {
		if ($row['accepted'] == '0') {
			$accepted = 'pending';
		} elseif ($row['accepted'] == '1') {
			$accepted = 'friends';
		}
	} 
	elseif ($_SESSION['unique_id'] == $row['req_to'] AND $visited_user_id == $row['req_from']) {
		if ($row['accepted'] == '0') {
			$accepted = 'requested';
		} elseif ($row['accepted'] == '1') {
			$accepted = 'friends';
		}
	}
}
if ($visited_user_id == $_SESSION['unique_id']) { $accepted = 'self'; }
foreach($getUserPosts as $row) {
	$pushed_visited_data_arr[] = $row;
}
$pushed_visited_profile_arr[] = ['profile' => $getUserProfilePic];
$visited_data_arr[] = ['accepted' => $accepted];
$visited_data_arr[] = $pushed_visited_data_arr;
$visited_data_arr[] = $pushed_visited_profile_arr;

echo json_encode($visited_data_arr);
?>