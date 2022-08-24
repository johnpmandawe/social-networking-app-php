<?php 

header('Access-Control-Allow-Origin', '*');
include_once 'config.php'; // Importing the file containing the Engine class.
$engine = new Engine(); // Creating a new object of the Engine class.

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$address = $_POST["address"];
$contact = $_POST["contact"];
$email = $_POST["email"];
$uname = $_POST["uname"];
$pword = $_POST["pword"];
$conpword = $_POST["conpword"];

if (!empty($fname) && !empty($lname) && !empty($address) && !empty($contact) && !empty($email) && !empty($uname) && !empty($pword) && !empty($conpword)) { // If all fields are filled.
  if (strlen($contact) == 11) {    // If contact number is valid.
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {    // If email is valid.
      $getUserEmail = $engine->getUserEmail($email);    // Validate email.
      if ($getUserEmail->rowCount() == 0) {    // If email doesnt exist.
        if (strlen($pword) >= 8) {    // If password is valid.
          if ($pword == $conpword) {    // If password is equal to confirm password.
            if ($_FILES["profile_pic"]["name"] != "") {    // If file is uploaded.
              $extensions = ["jpeg", "png", "jpg"];    // Image extension array.
              $fileName = $_FILES["profile_pic"]["name"];
              $tmpFileName = $_FILES["profile_pic"]["tmp_name"];
              $splitted = explode('.', $fileName);
              $extension = end($splitted);
              if(in_array($extension, $extensions) == true) { //    If extension is valid.
                $time = time();
                $newFileName = $time.$fileName;
                if(move_uploaded_file($tmpFileName, "../../users/profile_pics/".$newFileName)) { // Move file to a folder.
                  $unique_id = rand(100000, 1000000);
                  $insert = $engine->insertNewUser($unique_id, $fname, $lname, $address, $contact, $email, $uname, $pword, $newFileName);
                  if ($insert) {
                    echo "success";
                  } else {
                    echo "Something went wrong.";
                  }
                }
              }
            } else {
              echo "Upload an image.";
            }
          } else {
            echo "Passwords didn't match.";
          }
        } else {
          echo "Password must be 8 characters above.";
        }
      } else {
        echo "Email already exists.";
      }
    }
  } else {
    echo "Contact must be 11 characters.";
  }
} else {
  echo "All fields are required.";
}

?>