<?php 

header('Access-Control-Allow-Origin', '*');
session_start();
include_once 'config.php';
$engine = new Engine();
$post_arr = array();
$visited_id = $_SESSION['visited_id'];

$getOwnPost = $engine->getOwnPosts($visited_id);

foreach ($getOwnPost as $row) {
  if ($row['unique_id'] == $_SESSION['unique_id']) {
    $row['post_type'] = 'self';
  } else { $row['post_type'] = 'others'; }
  // $getLikers = $engine->getLikes($_SESSION['unique_id'], $row['post_id']);
  // if ($getLikers->rowCount() > 0) {
  //   $row['liked'] = 'yes';
  // } else { $row['liked'] = 'no'; }
  $getLikesCount = $engine->getLikesCount($row['post_id']);
  foreach ($getLikesCount as $like) {
    $row['likes'] = $like['likes'];
  }
  $getCommentsCount = $engine->getCommentsCount($row['post_id']);
  foreach ($getCommentsCount as $comment) {
    $row['comments'] = $comment['comments'];
  }
  $getComments = $engine->getComments($row['post_id']);
  if ($getComments->rowCount() > 0) {
    foreach ($getComments as $comments) {
      if ($comments['unique_id'] == $_SESSION['unique_id']) {
        $comments['com_type'] = 'self';
      } else {
        $comments['com_type'] = 'others';
      }
      $row['comments_arr'][] = $comments;
    }
  } else {
    $row['comments_arr'][] = [];
  }
  $post_arr[] = $row;
}

echo json_encode($post_arr);

?>