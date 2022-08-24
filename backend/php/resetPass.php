<?php 

include_once 'config.php';
$engine = new Engine();

$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$email = $_POST['email'];

if (!empty($email) && !empty($pass1) && !empty($pass2)) {
  $getEmail = $engine->getUserEmail($email);
  if ($getEmail->rowCount() > 0) {
    if ($pass1 == $pass2) {
      $resetPass = $engine->resetPass($pass2, $email);
      if ($resetPass) {
        echo 'success';
      } else {
        echo 'Something went wrong.';
      }
    } else {
      echo 'Passwords didn\'t match';
    }
  } else {
    echo 'Email doesn\'t exist.';
  }
} else {
  echo 'All fields are required.';
}

?>