<?php

session_start();
include_once 'config.php';
date_default_timezone_set('Asia/Manila');
$engine = new Engine();
$date = date('M j Y G:i:s');
$content = $_POST['content'];
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$msg = $_SESSION['name'] . ' commented on your post';
$submitComment = $engine->submitComment($content, $date, $post_id, $_SESSION['unique_id']);

if ($submitComment) {
  if ($_SESSION['unique_id'] != $user_id) {
    $newNotif = $engine->newNotif($msg, $_SESSION['unique_id'], $user_id, $date, 'comment');
    if ($newNotif) {
      echo 'success';
    } else { echo 'error'; }
  } else {
    echo 'success';
  }
} else { echo 'error'; }

?>