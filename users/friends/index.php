<?php include 'security.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include '../head/non_index_head.php'; ?>
  <title>Friends</title>
</head>
<body>
  <?php include '../headers/friends_header.php'; ?>
  <main>
    <h1>Friends</h1>
    <div class="friends_wrapper flex">
      <section class="friends">
        <h2>Friend list</h2>
        <form action="#" id="search_friend" class="flex" autocomplete="off">
          <input type="text" name="search" placeholder="Search here..."/><i class="fa-solid fa-magnifying-glass"></i>
        </form>
        <article class="friend_list flex">
        </article>
      </section>
      <section class="search_friends">
        <h2>Find new friends</h2>
        <form action="#" id="search_new_friend" class="flex" autocomplete="off">
          <input type="text" name="search" placeholder="Search here..."/><i class="fa-solid fa-magnifying-glass"></i>
        </form>
        <article class="new_friend_list flex">
    </div>
  </main>
  <script type="module" src="../../backend/ajax/friends.js"></script>
  <script type="module" src="../../backend/ajax/countNotifs.js"></script>
  <script src="../../backend/ajax/showHints.js"></script>
</body>
</html>