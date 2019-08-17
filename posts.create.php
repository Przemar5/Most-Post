<?php
	
	session_start();
	
	require_once 'if_not_logged.php';
	
	if(!isset($_POST['submit'])) {
		header('Location: posts.form.create.php');		//	I wonder...
		exit();
		
	} else {
		$ttl = $_POST['title'];
		$cntt = $_POST['content'];
		$tg = $_POST['tags'];
		$evrthngOK = true;
		
		require_once 'connect/connect.php';
		
		//	Credentials checking
		
		//	Check title
		//$ttl = htmlentities($ttl, ENT_QUOTES, 'UTF-8');
		//echo $ttl;
		
		//$cntt = htmlentities($cntt, ENT_QUOTES, 'UTF-8');
		//echo $ttl;
		
		//$tg = htmlentities($tg, ENT_QUOTES, 'UTF-8');
		//echo $ttl;
		
		//	Check if it's update
		
		if(isset($_GET['a'])) {
			$athr = stripslashes($_GET['a']);
			$athr = trim($athr);
			
			if(preg_match('%^[0-9]{1,6}$%', $athr)) {
				$athr = mysqli_real_escape_string($conn, $athr);
				$athr = strip_tags($athr);
				
				if($_GET['a'] === $athr) {
					$sql = "SELECT login FROM users WHERE id='$athr'";
					$rstsel = $conn -> query($sql);
					$rwnumsel = $rstsel -> num_rows;
					
					if($rwnumsel === 0) {
						header('Location: main.php');
						exit();
						
					} elseif($rwnumsel === 1) {
						$rwsel = $rstsel -> fetch_assoc();
						$sqlqry = "SELECT DISTINCT p.* FROM posts AS p, users WHERE p.author='" . $rwsel['login'] . "' ORDER BY p.id DESC";
						
					} else {
						//	I don't know what to do yet
						//	Send e-mail with info about an error and client id to admins
					}
					
					$rstsel -> close();
				}
			}
			
		} else {
			$sqlqry = "SELECT * FROM posts ORDER BY id DESC";
		}
		
		
		if(!$evrthngOK) {
			header('Location: posts.form.create.php');
			exit();
			
		} else {
			$authr = $_SESSION['login'];
			$sql = "INSERT INTO posts (tags, content, title, author, add_date) VALUES ('$tg', '$cntt', '$ttl', '$authr', NOW())";
			$conn -> query($sql);
			$rwrst = mysqli_affected_rows($conn);
			$conn -> close();
			
			if($rwrst === 0) {
				$_SESSION['error_cannot'] = 'Something gone wrong';
				
				header('Location: posts.form.create.php');
				exit();
				
			} elseif($rwrst === 1) {
				header('Location: main.php');
				exit();
				
			} else {
				//	Inform admin
			}
		}
	}
	
?>