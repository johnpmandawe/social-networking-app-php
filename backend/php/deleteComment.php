<?php

header('Access-Control-Allow-Origin', '*');
include_once 'config.php';
$engine = new Engine();
$com_id = $_POST['com_id'];

$deleteComment = $engine->deleteComment($com_id);

if ($deleteComment) {
  echo 'deleted';
} else {
  echo 'error';
}

?>