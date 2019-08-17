<?php
	
	session_start();
	
?>


<!DOCTYPE html>
<html>
	
	<head>
		
		<title>myBlog</title>
		
		<script
			src="https://code.jquery.com/jquery-3.4.1.min.js"
			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			crossorigin="anonymous"></script>
		
	</head>
	
	<body>
		
		<?php
			require_once 'posts.show_all.php';
		?>
		
	</body>
	
</html>