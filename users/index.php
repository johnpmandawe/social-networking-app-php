<?php include 'security.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head/index_head.php'; ?>
  <title>Home</title>
</head>
<body>
  <?php include 'headers/index_header.php'; ?>
  <main id="home">
    <h1>Home</h1>
    <div class="posts">
    </div>
  </main>
  <div class="modal" id="comment_modal">
    <div class="modal_content">
      <h3 class="content_title"></h3>
      <p class="content_content"></p>
    </div>
  </div>
  <div class="modal" id="delete_post_modal">
    <div class="modal_content">
      <h3 class="content_title">Delete post?</h3>
      <p class="content_content">Are you sure you want to delete this post?</p>
      <div class="flex storage" style="justify-content: space-between;">
        <button class="yes">Yes</buttton>
        <button class="no">No</button>
      </div>
    </div>
  </div>
  <div class="modal" id="edit_comment">
    <div class="modal_content">
      <h3 class="content_title">Update comment</h3>
      <form action="#" id="edit_com_form" autocomplete="off">
        <input type="hidden" name="com_id"/>
        <div class="input_wrapper">
          <input type="text" name="com_content" placeholder="Write something..."/>
        </div>
        <div class="btn_group flex">
          <button type="submit">Update</button>
          <button type="reset">Discard</button>
        </div>
      </form>
    </div>
  </div>
  <div class="modal" id="edit_post">
    <div class="modal_content">
      <h3 class="content_title">Update post</h3>
      <form action="#" id="edit_post_form" autocomplete="off">
        <input type="hidden" name="id"/>
        <div class="input_wrapper flex">
          <input type="text" name="post_title" placeholder="Title..."/>
          <input type="text" name="post_content" placeholder="Content..."/>
        </div>
        <div class="btn_group flex">
          <button type="submit">Update</button>
          <button type="reset">Discard</button>
        </div>
      </form>
    </div>
  </div>
  <script type="module" src="../backend/ajax/getPost.js"></script>
  <script type="module" src="../backend/ajax/countNotifs.js"></script>
  <script src="../backend/ajax/showHints.js"></script>
</body>
</html>