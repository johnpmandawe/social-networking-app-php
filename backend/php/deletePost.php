<?php 

header('Access-Control-Allow-Origin', '*');
include_once 'config.php';
$engine = new Engine();

$deletePost = $engine->deletePost($_POST['post_id']);

if ($deletePost) {
  echo 'deleted';
} else { echo 'error'; }

?>