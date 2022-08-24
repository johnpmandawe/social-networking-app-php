<?php 

session_start();
include_once 'config.php';
$engine = new Engine();
$post_id = $_POST['post_id'];
$getLikes = $engine->getLikes($_SESSION['unique_id'], $post_id);

if($getLikes->rowCount() > 0) {
  $likePost = $engine->unlikePost($_SESSION['unique_id'], $post_id);
  if ($likePost) {
    echo 'unliked';
  } else { echo 'error'; }
} else { echo 'already liked'; }

?>