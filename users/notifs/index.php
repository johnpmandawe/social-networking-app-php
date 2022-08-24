<?php include 'security.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include '../head/non_index_head.php' ?>
  <title>Notifications</title>
</head>
<body>
	<?php include '../headers/settings_header.php'; ?>
  	<main>
			<h1>Notifications</h1>
			<div id="notifs">
				<h2>Notifs</h2>
				<div id="load_notifs" class="flex">
					
				</div>
			</div>
		</main>
	<script type="module" src="../../backend/ajax/notifs.js"></script>
  <script type="module" src="../../backend/ajax/countNotifs.js"></script>
	<script src="../../backend/ajax/showHints.js"></script>
</body>
</html>