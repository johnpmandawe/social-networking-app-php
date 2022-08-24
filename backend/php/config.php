<?php 

  class Engine {
    
    public function connect() { // Connect to database function.

      // $hostname = "sql200.epizy.com";
      // $username = "epiz_30074036";
      // $password = "N7SQtDwf4yS4";
      // $dbname = "epiz_30074036_social_app";
      $hostname = "localhost";
      $username = "root";
      $password = "";
      $dbname = "social_app";
      $dsn = "mysql:host=$hostname;dbname=$dbname";

      try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        if (!$pdo) {
          echo "Not connected.";
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
      }

      return $pdo;
    }

    public function getUserEmail($email) {
      $query = "SELECT * FROM users WHERE email = :email";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":email" => $email]);
      return $stmt;
      $stmt = null;
    }

    public function insertNewUser($unique_id, $fname, $lname, $address, $contact, $email, $uname, $pword, $profile_pic) {
      $query = "INSERT INTO users (unique_id, fname, lname, address, contact, email, uname, pword, profile_pic) VALUES 
      (:unique_id, :fname, :lname, :address, :contact, :email, :uname, :pword, :profile_pic)";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $unique_id, ":fname" => $fname, ":lname" => $lname, ":address" => $address, 
      ":contact" => $contact, ":email" => $email, ":uname" => $uname, ":pword" => $pword, ":profile_pic" => $profile_pic]);
      return $stmt;
      $stmt = null;
    }

    public function getLoginDetails($uname, $pword) {
      $query = "SELECT * FROM users WHERE uname = :uname AND pword = :pword";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":uname" => $uname, ":pword" => $pword]);
      return $stmt;
      $stmt = null;
    }

    public function getUserUniqueId($unique_id) {
      $query = "SELECT * FROM users WHERE unique_id = :unique_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $unique_id]);
      return $stmt;
      $stmt = null;
    }

    public function createPost($title, $content, $date_posted, $unique_id) {
      $query = "INSERT INTO posts (post_title, post_content, date_posted, unique_id) VALUES (:post_title, :post_content, :date_posted, :unique_id)";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":post_title" => $title, ":post_content" => $content, ":date_posted" => $date_posted, ":unique_id" => $unique_id]);
      return $stmt;
      $stmt = null;
    }

    public function getUserPosts() {
      $query = "SELECT posts.post_id, posts.post_title, posts.post_content, posts.date_posted, users.fname, users.lname, users.unique_id, users.profile_pic 
      FROM posts INNER JOIN users ON users.unique_id = posts.unique_id ORDER BY posts.post_id DESC";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      return $stmt;
      $stmt = null;
    }

    public function getOwnPosts($unique_id) {
      $query = "SELECT posts.post_id, posts.post_title, posts.post_content, posts.date_posted, users.fname, users.lname, users.unique_id, users.profile_pic 
      FROM posts INNER JOIN users ON users.unique_id = posts.unique_id WHERE users.unique_id = :unique_id ORDER BY posts.post_id DESC";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $unique_id]);
      return $stmt;
      $stmt = null;
    }

    public function getVisitedUserPosts($unique_id) {
      $query = "SELECT posts.post_id, posts.post_title, posts.post_content, posts.date_posted, users.fname, users.lname, users.unique_id, users.profile_pic 
      FROM posts INNER JOIN users ON users.unique_id = posts.unique_id 
      WHERE posts.unique_id = :unique_id ORDER BY posts.post_id DESC";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $unique_id]);
      return $stmt;
      $stmt = null;
    }

    public function getUserProfilePic($id) {
      $query = "SELECT profile_pic FROM users WHERE unique_id = :unique_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $id]);
      return $stmt->fetchColumn();
      $stmt = null;
    }

    public function getRequests() {
      $query = "SELECT * FROM requests";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      return $stmt;
      $stmt = null;
    }

    public function getAcceptedRequests() {
      $query = "SELECT * FROM requests WHERE accepted = '1'";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      return $stmt;
      $stmt = null;
    }

    public function getAllPosts() {
      $query = "SELECT posts.post_id,  posts.post_title, posts.post_content, posts.date_posted, users.fname, users.lname, users.profile_pic FROM posts INNER JOIN users ON users.unique_id = posts.unique_id 
      ORDER BY posts.post_id DESC";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      return $stmt;
      $stmt = null;
    }

    public function editUserDetails($fname, $lname, $address, $contact, $email, $uname, $id) {
      $query = "UPDATE users SET fname = :fname, lname = :lname, address = :address, contact = :contact, email = :email, uname = :uname WHERE unique_id = :unique_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":fname" => $fname, ":lname" => $lname, ":address" => $address, ":contact" => $contact, ":email" => $email, ":uname" => $uname, ":unique_id" => $id]);
      return $stmt;
      $stmt = null;
    }

    public function editProfilePic($profile_pic, $id) {
      $query = "UPDATE users SET profile_pic = :profile_pic WHERE unique_id = :unique_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":profile_pic" => $profile_pic, ":unique_id" => $id]);
      return $stmt;
      $stmt = null;
    }

    public function searchNewFriend($searchStr, $currUserId) {
      $query = "SELECT unique_id, fname, lname, profile_pic FROM users WHERE NOT unique_id = :unique_id AND (fname LIKE :searchStr OR lname LIKE :searchStr)";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":searchStr" => "%".$searchStr."%", ":unique_id" => $currUserId]);
      return $stmt;
      $stmt = null;
    }

    public function addFriend($req_from, $req_to) {
      $query = "INSERT INTO requests (req_from, req_to) VALUES (:req_from, :req_to)";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":req_from" => $req_from, ":req_to" => $req_to]);
      return $stmt;
      $stmt = null;
    }

    public function newNotif($notif_content, $notif_from, $notif_to, $notif_date, $notif_type) {
      $query = "INSERT INTO notifs (notif_content, notif_from, notif_to, notif_date, notif_type) VALUES (:notif_content, :notif_from, :notif_to, :notif_date, :notif_type)";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":notif_content" => $notif_content, ":notif_from" => $notif_from, ":notif_to" => $notif_to, ":notif_date" => $notif_date, ":notif_type" => $notif_type]);
      return $stmt;
      $stmt = null;
    }

    public function cancelRequest($req_from, $req_to) {
      $query = "DELETE FROM requests WHERE (req_from = :req_from AND req_to = :req_to) OR (req_to = :req_from AND req_from = :req_to); 
      DELETE FROM notifs WHERE (notif_from = :notif_from AND notif_to = :notif_to AND notif_type = 'request') OR (notif_to = :notif_from AND notif_from = :notif_to AND notif_type = 'request')";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":req_from" => $req_from, ":req_to" => $req_to, ":notif_from" => $req_from, ":notif_to" => $req_to]);
      return $stmt;
      $stmt = null;
    }

    public function acceptRequest($req_from, $req_to) {
      $query = "UPDATE requests SET accepted = '1' WHERE req_from = :visited_id AND req_to = :sess_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":visited_id" => $req_from, ":sess_id" => $req_to]);
      return $stmt;
      $stmt = null;
    }

    public function getFriendsFromRequestor($id) {
      $query = "SELECT users.unique_id, users.lname, users.fname, users.profile_pic FROM users INNER JOIN requests 
      ON users.unique_id = requests.req_to WHERE requests.req_from = :id AND requests.accepted = '1'";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":id" => $id]);
      return $stmt;
      $stmt = null;
    }

    public function getFriendsFromReceiver($id) {
      $query = "SELECT users.unique_id, users.lname, users.fname, users.profile_pic FROM users INNER JOIN requests 
      ON users.unique_id = requests.req_from WHERE requests.req_to = :id AND requests.accepted = '1'";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":id" => $id]);
      return $stmt;
      $stmt = null;
    }

    public function searchFriendsFromRequestor($id, $searchStr) {
      $query = "SELECT users.unique_id, users.lname, users.fname, users.profile_pic FROM users INNER JOIN requests 
      ON users.unique_id = requests.req_to WHERE (users.fname LIKE :searchStr OR users.lname LIKE :searchStr) AND requests.req_from = :id AND requests.accepted = '1'";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":id" => $id, ":searchStr" => "%".$searchStr."%"]);
      return $stmt;
      $stmt = null;
    }

    public function searchFriendsFromReceiver($id, $searchStr) {
      $query = "SELECT users.unique_id, users.lname, users.fname, users.profile_pic FROM users INNER JOIN requests 
      ON users.unique_id = requests.req_from WHERE (users.fname LIKE :searchStr OR users.lname LIKE :searchStr) AND requests.req_to = :id AND requests.accepted = '1'";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":id" => $id, ":searchStr" => "%".$searchStr."%"]);
      return $stmt;
      $stmt = null;
    }

    public function getNotifs($id) {
      $query = "SELECT * FROM notifs WHERE notif_to = :id AND NOT notif_from = :id ORDER BY notif_date DESC";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":id" => $id]);
      return $stmt;
      $stmt = null;
    }

    public function countNotifs($sess_id) {
      $query = "SELECT * FROM notifs WHERE notif_to = :id AND NOT notif_from = :id AND opened = '0'";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":id" => $sess_id]);
      return $stmt;
      $stmt = null;
    }

    public function openNotif($id) {
      $query = "UPDATE notifs SET opened = '1' WHERE notif_id = :id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":id" => $id]);
      return $stmt;
      $stmt = null;
    }

    public function getLikes($unique_id, $post_id) {
      $query = "SELECT * FROM likers WHERE unique_id = :unique_id AND post_id = :post_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $unique_id, ":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function likePost($unique_id, $post_id) {
      $query = "INSERT INTO likers (unique_id, post_id) VALUES (:unique_id, :post_id)";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $unique_id, ":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function getLikesCount($post_id) {
      $query = "SELECT count(post_id) as likes FROM likers WHERE post_id = :post_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function getCommentsCount($post_id) {
      $query = "SELECT count(post_id) as comments FROM comments WHERE post_id = :post_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function unlikePost($unique_id, $post_id) {
      $query = "DELETE FROM likers WHERE unique_id = :unique_id AND post_id = :post_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":unique_id" => $unique_id, ":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function submitComment($content, $date, $post_id, $user_id) {
      $query = "INSERT INTO comments (com_content, com_date, post_id, unique_id) VALUES 
      (:content, :com_date, :post_id, :sess_id)";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":content" => $content, ":com_date" => $date, ":post_id" => $post_id, ":sess_id" => $user_id]);
      return $stmt;
      $stmt = null;
    }

    public function getComments($post_id) {
      $query = "SELECT comments.com_id, comments.com_content, comments.com_date, users.fname, users.lname, comments.unique_id FROM comments 
      INNER JOIN users ON comments.unique_id = users.unique_id WHERE comments.post_id = :post_id ORDER BY comments.com_date DESC";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function deleteNotif($notif_id) {
      $query = "DELETE FROM notifs WHERE notif_id = :notif_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":notif_id" => $notif_id]);
      return $stmt;
      $stmt = null;
    }

    public function deleteComment($com_id) {
      $query = "DELETE FROM comments WHERE com_id = :com_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":com_id" => $com_id]);
      return $stmt;
      $stmt = null;
    }

    public function updateComment($com_content, $com_id) {
      $query = "UPDATE comments SET com_content = :com_content WHERE com_id = :com_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":com_content" => $com_content, ":com_id" => $com_id]);
      return $stmt;
      $stmt = null;
    }

    public function deletePost($post_id) {
      $query = "DELETE FROM posts WHERE post_id = :post_id;
      DELETE FROM likers WHERE post_id = :post_id;
      DELETE FROM comments WHERE post_id = :post_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function editPost($post_title, $post_content, $post_id) {
      $query = "UPDATE posts SET post_title = :post_title, post_content = :post_content WHERE post_id = :post_id";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":post_title" => $post_title, ":post_content" => $post_content, ":post_id" => $post_id]);
      return $stmt;
      $stmt = null;
    }

    public function resetPass($pass, $email) {
      $query = "UPDATE users SET pword = :pword WHERE email = :email";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute([":pword" => $pass, ":email" => $email]);
      return $stmt;
      $stmt = null;
    }
    
  }

?>