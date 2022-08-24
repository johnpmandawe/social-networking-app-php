<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$search_arr = array();
$searchStr = $_POST['searchStr'];
$searchNewFriend = $engine->searchNewFriend($searchStr, $_SESSION['unique_id']);
if (!empty($searchStr)) {
	foreach ($searchNewFriend as $row) {
		$search_arr[] = $row;
	}
}

echo json_encode($search_arr);

?>