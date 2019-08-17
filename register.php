<?php
	
	session_start();
	
	require_once 'if_logged.php';
	
	try {
		if(!isset($_POST['submit'])) {
			header('Location: register_form.php');
			exit();
				
		} else {
			require_once 'classes/class.validate.php';
			
			$login = $_POST['login'];
			$pass1 = $_POST['pass1'];
			$pass2 = $_POST['pass2'];
			$email = $_POST['email'];
			$question = $_POST['question'];
			$answer = $_POST['answer'];
			$regulations = !empty($_POST['regulations'])	?	$_POST['regulations']	:	'';
			$OK = true;
			$validate = new Validate();
			
			require_once 'connect/connect.php';		// Bad option
			
			
			//	REGEX - don't know why, but i have to contain string length to avoid regex error
			
			//	Check login
			if(!$validate -> check($login, 3, 45, '%^[A-Za-z0-9 _]{3,45}$%')) {
				$OK = false;
				$errMatch = 'Nick may contain only letters, numbers, underscores and spaces';
				$validate -> makeError('error_login', 'nick', null, null, $errMatch, 3, 45);
			
			} else {
				$sql = 'SELECT id FROM users WHERE login=:login';
				$params = array('login' => $login);
				
				if(!empty($validate -> getRowCount($conn, $sql, $params))) {
					$OK = false;
					$_SESSION['error_login'] = 'Given nick is already taken. Please choose another one';
				}
			}
			
			//	Check first password
			if(!$validate -> check($pass1, 8, 40, '%\A(?=[_A-Za-z0-9]*?[A-Z])(?=[_A-Za-z0-9]*?[a-z])(?=[_A-Za-z0-9]*?[0-9])\S{3,45}\z%')) {
				$OK = false;
				$errMatch = 'Password must contain at least 1 uppercase letter, 1 lowercase letter and 1 number. It also may contain underscores';
				$validate -> makeError('error_pass1', 'Password', null, null, $errMatch, 8, 40);
			}
			
			//	Check passwords matching
			if($OK && ($pass1 !== $pass2)) {
				$OK = false;
				$_SESSION['error_pass2'] = 'Both passwords must match each other';
			}
			
			//	repair match
			//	Check email
			if(!$validate -> check($email, 0, 60, '%^[A-Za-z0-9_.\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%') ||
				!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$OK = false;
				$errMatch = 'This isn\'t the proper e-mail';
				$validate -> makeError('error_email', 'e-mail', null, null, $errMatch, 0, 60);
				
			} else {
				$sql = 'SELECT id FROM users WHERE email=:email';
				$params = array('email' => $email);
				
				if(!empty($validate -> getRowCount($conn, $sql, $params))) {
					$OK = false;
					$_SESSION['error_email'] = 'User with given e-mail has already an account';
				}
			}
			
			//	Check question
			if(empty($question) || !preg_match('%^[0-9]{1,2}$%', $question) || 
				($question < 1) || ($question > 4)) {
				
				$OK = false;
				$_SESSION['error_question'] = 'You must select the question. It\'s used in case of password recovery';
			
			} else {
				//	Check answer
				if(!$validate -> check($answer, 0, 60, '%^[A-Za-z0-9_ /.,-@]{1,60}$%')) {
					$OK = false;
					$errMatch = 'Answer may contain only letters, numbers, spaces, underscores, right slashes, dots, commas, dashes and \'@\' sign';
					$validate -> makeError('error_answer', 'Your answer', null, null, $errMatch, 0, 60);
				}
			}
			
			//	Check regulations
			if($regulations !== 'on') {
				$_SESSION['error_regul'] = 'You must accept regulations to register';
				$evrthngOK = false;
			}
			
			
			if(!$OK) {
				header('Location: register.form.php');
				exit();
				
			} else {
				//	Add RSA encryption
				$pass = password_hash($pass1, PASSWORD_DEFAULT);
				$sql = 'INSERT INTO users ';
				$sql .= '(login, pass, email, question, answer, register_date, posts, comments, admin)';
				$sql .= 'VALUES (:login, :pass, :email, :question, :answer, NOW(), 0, 0, :admin)';
				$params = array('login'		=>	$login,
								'pass'		=>	$pass,
								'email'		=>	$email,
								'question'	=>	$question,
								'answer'	=>	$answer,
								'admin'		=>	'n');
				$rows = $validate -> getRowCount($conn, $sql, $params);
				
				if($rows !== 1) {
					throw new Exception('Something gone wrong');
					
				} else {
					$_SESSION['success_registration'] = 'Now you can login to your account';
					
					header('Location: login.form.php');
					exit();
				}
			}
		}
		
	} catch(Exception $e) {
		echo 'Something gone wrong';
	}
	
	
?>