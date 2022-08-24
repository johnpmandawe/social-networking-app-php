<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$searchStr = $_POST['searchStr'];
$receiverSearchArr = array();
$requestorSearchArr = array();
$mergedArr = array();
$getAcceptedRequests = $engine->getAcceptedRequests();

if ($getAcceptedRequests->rowCount() > 0) {
	foreach ($getAcceptedRequests as $row) {
		if ($row['req_from'] == $_SESSION['unique_id']) {
			$getFriendsFromRequestor = $engine->searchFriendsFromRequestor($_SESSION['unique_id'], $searchStr);
			foreach($getFriendsFromRequestor as $row) {
				$requestorSearchArr[] = $row;
			}
		} 
		else if ($row['req_to'] == $_SESSION['unique_id']) {
			$getFriendsFromReceiver = $engine->searchFriendsFromReceiver($_SESSION['unique_id'], $searchStr);
			foreach($getFriendsFromReceiver as $row) {
				$receiverSearchArr[] = $row;
			}
		}
	}
}

foreach ($receiverSearchArr as $row) {
	if (!in_array($row, $mergedArr)) {
		array_push($mergedArr, $row);
	}
}
foreach ($requestorSearchArr as $row) {
	if (!in_array($row, $mergedArr)) {
		array_push($mergedArr, $row);
	}
}

echo json_encode($mergedArr);

?>