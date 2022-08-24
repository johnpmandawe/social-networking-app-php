<?php 

header('Access-Control-Allow-Origin', '*');
include_once 'config.php';
$engine = new Engine();
$com_id = $_POST['com_id'];
$com_content = $_POST['com_content'];

if (!empty($com_content)) { 
  $updateComment = $engine->updateComment($com_content, $com_id);
  if ($updateComment) {
    echo 'updated';
  } else {
    echo 'error';
  }
} else {
  echo 'empty field';
}


?>