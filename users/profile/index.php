<?php include 'security.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include '../head/non_index_head.php'; ?>
  <title>Profile</title>
</head>
<body>
  <?php include '../headers/profile_header.php'; ?>
  <main>
    <div class="flex" style="justify-content: space-between; margin-bottom: 0.5rem;">
      <h1>Profile</h1>
      <li id="logout"><i class="fa-solid logout fa-right-from-bracket"></i></li>
    </div>
    <div class="flex" style="justify-content: space-evenly; flex-wrap: wrap; gap: 0.5rem;">
      <section class="profile_wrapper">
        <p>Me</p>
        <div class="profile_content">
          
        </div>
      </section>
      <section class="profile_wrapper">
        <p>Posts</p>
        <div class="posts">
          
        </div>
      </section>
    </div>
  </main>
  <div class="modal" id="update_msg">
    <div class="modal_content">
      <h3 class="content_title"></h3>
      <p class="content_content"></p>
    </div>
  </div>
  <div class="modal" id="update_pp">
    <div class="modal_content">
      <h3 class="content_title">Update profile picture</h3>
      <form action="#" id="update_pp_form">
        <p id="err_msg"></p>
        <div class="input_wrapper">
          <input type="file" name="pp"/>
        </div>
        <div class="flex">
          <button type="submit" class="confirm">Confirm</button>
          <button class="cancel">Cancel</button>
        </div>
      </form>
    </div>
  </div>
  <div class="modal" id="upp_msg">
    <div class="modal_content">
      <h3 class="content_title"></h3>
      <p class="content_content"></p>
    </div>
  </div>
  <div class="modal" id="logout_modal">
    <div class="modal_content">
      <h3 class="content_title">Logout?</h3>
      <p>Are you sure you want to logout?</p>
      <div class="btn_group flex">
        <button id="yes">Yes</button>
        <button id="cancel">No</button>
      </div>
    </div>
  </div>
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
  <script type="module" src="../../backend/ajax/users.js"></script>
  <script type="module" src="../../backend/ajax/profile.js"></script>
  <script type="module" src="../../backend/ajax/countNotifs.js"></script>
  <script src="../../backend/ajax/showHints.js"></script>
  <script type="module" src="../../backend/ajax/getPost.js"></script>
</body>
</html>