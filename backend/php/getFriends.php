<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$receiverArr = array();
$requestorArr = array();
$mergedArr = array();
$getAcceptedRequests = $engine->getAcceptedRequests();

if ($getAcceptedRequests->rowCount() > 0) {
	foreach ($getAcceptedRequests as $row) {
		if ($row['req_from'] == $_SESSION['unique_id']) {
			$getFriendsFromRequestor = $engine->getFriendsFromRequestor($_SESSION['unique_id']);
			foreach($getFriendsFromRequestor as $row) {
				$requestorArr[] = $row;
			}
		} 
		else if ($row['req_to'] == $_SESSION['unique_id']) {
			$getFriendsFromReceiver = $engine->getFriendsFromReceiver($_SESSION['unique_id']);
			foreach($getFriendsFromReceiver as $row) {
				$receiverArr[] = $row;
			}
		}
	}
}

foreach ($receiverArr as $row) {
	if (!in_array($row, $mergedArr)) {
		array_push($mergedArr, $row);
	}
}
foreach ($requestorArr as $row) {
	if (!in_array($row, $mergedArr)) {
		array_push($mergedArr, $row);
	}
}

echo json_encode($mergedArr);

?>