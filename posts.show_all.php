<?php
	
	require_once 'nbbc/nbbc.php';
	require_once 'connect/connect.php';
	require_once 'check.get.php';
	
	$sql = 'SELECT login FROM users WHERE id=:id';
	$getAuthor = $_GET['a'];
	$params = array('id' => $getAuthor);
	$stmt = checkGet($conn, $getAuthor, '%^[0-9]{1,10}$%', $sql, $params);
	
	if($stmt) {
		$rows = $stmt -> rowCount();
		
		if($rows === 1) {
			$row = $stmt -> fetch();
			$sql = "SELECT DISTINCT p.* FROM posts AS p, users WHERE p.author=:author ORDER BY p.id DESC";
			$params = array('author' => $row['login']);
		}
		
	} else {
		$sql = "SELECT * FROM posts ORDER BY id DESC";
	}
	
	$stmt = $conn -> prepare($sql);
	$stmt -> execute($params);
	$rows = $stmt -> rowCount();
	
	$bbcode = new BBCode;
	
	if(isset($_SESSION['login'])) {
		echo '<h2>Welcome ' . $_SESSION['login'] . '!</h2>';
	}
	
	if($rows == 0) {
		echo 'There are no posts yet';
		
	} elseif($rows > 0) {
		while($row = $stmt -> fetch()) {
			$id = $row['id'];
			$title = $row['title'];
			$content = $row['content'];
			$author = $row['author'];
			$edit = '';
			$delete = '';
			$dateDisplay;
			$datetime;
			
			if(!empty($row['edit_date'])) {
				$dateDisplay = 'Edited on ';
				$datetime = $row['edit_date'];
				
			} else {
				$dateDisplay = 'Added on ';
				$datetime = $row['add_date'];
			}
			
			$date = gmdate('j F Y', strtotime($datetime));
			$time = gmdate('g:i a', strtotime($datetime));
			
			if(isset($_SESSION['login'])) {
				if($author === $_SESSION['login']) {
					$edit .= '<p><a href="posts.edit.php?pid=' . $id . '">Edit post</a></p>';
				}
				
				if((isset($_SESSION['admin'])) && ($_SESSION['admin'] === "y")) {
					$delete .= '<p><a href="posts.delete.php?pid=' . $id . '">Delete post</a></p>';
				}
			}
			
			//	Not sanitized
			
			$output = $bbcode -> Parse($content);
			
			if(strlen($output) > 600) {
				$ouptut = substr($output, 0, 600);
				$output .= '... <a href="main.php?pid=' . $row['id'] . '">Read More</a>';
			}
			
			echo<<<END
			
			<div>
				<h2><a href="posts.view.php?pid=$id">$title</a>
					<small><i>$dateDisplay $date at $time</i></small></h2>
				<p>$output</p>
				$edit $delete
			</div>
			
			<hr>
END;
		}
		
	} else {
		//	I don't know what to do yet
		//	Send e-mail with info about an error and client id to admins
	}
	
	
	if(!isset($_SESSION['login'])) {
		echo '<p><a href="login.form.php">Login</a></p>';
		echo '<p><a href="register.form.php">Register</a></p>';
	
	} else {
		if((isset($_SESSION['admin'])) && ($_SESSION['admin'] == 1)) {
			echo '<p><a href="admin.php">Admin panel</a></p>';
			
		} else {
			echo '<p><a href="posts.form.create.php">Create a new post</a></p>';
		}
		
		echo '<p><a href="logout.php">Logout</a></p>';
	}
	
?>