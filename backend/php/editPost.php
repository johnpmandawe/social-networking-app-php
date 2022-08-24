<?php 

include_once 'config.php';
$engine = new Engine();
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];
$post_id = $_POST['id'];

if (!empty($post_title) && !empty($post_content)) {
  $editPost = $engine->editPost($post_title, $post_content, $post_id);
  if ($editPost) {
    echo 'edited';
  } else {
    echo 'error';
  }
} else { echo 'empty fields'; }

?>