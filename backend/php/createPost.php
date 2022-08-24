<?php 

  header('Access-Control-Allow-Origin', '*');
  session_start();
  include_once 'config.php';
  date_default_timezone_set('Asia/Manila');
  $engine = new Engine();

  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('M j Y G:i:s');
  if (!empty($title) && !empty($content)) {
    $createPost = $engine->createPost($title, $content, $date, $_SESSION['unique_id']);
    if ($createPost) {
        echo 'inserted';
    } else {
        echo 'error';
    }
  } else {
    echo 'Please input something.';
  }
?>