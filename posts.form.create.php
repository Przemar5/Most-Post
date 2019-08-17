<?php
	
	session_start();
	
	require_once 'if_not_logged.php';
	include_once 'display.error.php';
	require_once 'connect/connect.php';
	require_once 'check.get.php';
	
?>


<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  
<div class="container">

	<form class="needs-validation" action="posts.create.php" method="post" novalidate>
			
		<div class="form-group">
			<label>
				<span class="input-label-text">Post title: </span><br>
				<input class="form-control mr-lg-2" type="text" name="title" id="title" placeholder="Enter post title" required>
			</label>
		</div>
		
		<?php
			displayError('error_title');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">Post content: </span><br>
				<textarea class="form-control mr-lg-2" name="content" id="content" cols="100" rows="10" placeholder="Your post here..." required></textarea>
			</label>
		</div>
		
		<?php
			displayError('error_content');
		?>
		
		<div class="form-group">
			<label>
				<span class="input-label-text">Tags (optional): </span><br>
				<input class="form-control mr-lg-2" type="text" name="tags" id="tags" placeholder="#tag1 #tag2">
			</label>
		</div>
		
		<?php
			displayError('error_tags');
		?>
		
		<div><button type="submit" id="submit" name="submit" class="btn btn-primary mb-2">Submit post</button></div>
		
		<?php
			displayError('error_cannot');
		?>
		
		<a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a>
		
	</form>
	
</div>