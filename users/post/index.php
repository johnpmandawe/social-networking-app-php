<?php include 'security.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include '../head/non_index_head.php'; ?>
  <title>Post</title>
</head>
<body>
	<?php include '../headers/post_header.php'; ?>
	<main>
		<h1>Post</h1>
		<form action="#" id="post_form">
			<h2>Create Post</h2>
			<input type="text" name="title" placeholder="Caption..."/>
			<textarea name="content" placeholder="Content..." cols="30" rows="10"></textarea>
			<input type="submit" id="post_btn" value="Post"/>
		</form>
	</main>
	<div id="post_modal" class="modal">
		<div class="modal_content">
			<h3 class="content_title"></h3>
			<p class="content_content"></p>
		</div>
	</div>
	<script type="module" src="../../backend/ajax/createPost.js"></script>
  <script type="module" src="../../backend/ajax/countNotifs.js"></script>
	<script src="../../backend/ajax/showHints.js"></script>
</body>
</html>