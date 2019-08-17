<?php
	
	session_start();
	
	require_once 'if_logged.php';
	
	try {
		if(!isset($_POST['submit'])) {
			header('Location: login.form.php');
			exit();
			
		} else {
			$login = $_POST['login'];
			$password = $_POST['password'];
			$OK = true;
			$stmt;
			
			//	CHECK CREDENTIALS
			
			//	Check login
			if(!preg_match('%^[A-Za-z0-9 _]{3,45}$%', $login)) {
				$OK = false;
				$_SESSION['error_login'] = 'Invalid login';
			
			} else {
				require_once 'connect/connect.php';		// Bad option
				
				$sql = 'SELECT * FROM users WHERE login=:login';
				$params = array('login' => $login);
				$stmt = $conn -> prepare($sql);
				$stmt -> execute($params);
				$rows = $stmt -> rowCount();
				
				if($rows !== 1) {
					$OK = false;
					$_SESSION['error_login'] = 'There doesn\'t exist any user of the given login';
				}
			}
			
			if(!$OK) {
				header('Location: login.form.php');
				exit();
			}
			
			//	Check Password
			$matchPattern = '%\A(?=[_A-Za-z0-9]*?[A-Z])(?=[_A-Za-z0-9]*?[a-z])(?=[_A-Za-z0-9]*?[0-9])\S{3,45}\z%';
			
			if(!preg_match($matchPattern, $password)) {
				$OK = false;
				$_SESSION['error_pass'] = 'Invalid password';
			}
			
			if(!$OK) {
				header('Location: login.form.php');
				exit();
				
			} else {
				$result = $stmt -> fetch();
				$_SESSION['id'] = $result['id'];
				$_SESSION['login'] = $result['login'];
				$_SESSION['email'] = $result['email'];
				$_SESSION['posts'] = $result['posts'];
				$_SESSION['admin'] = $result['admin'];
				
				header('Location: main.php?a=' . $_SESSION['id']);
				exit();
			}
		}
		
	} catch(Exception $e) {
		echo 'Something gone wrong';
	}
	
?>