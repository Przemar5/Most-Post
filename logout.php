<?php
	
	session_start();
	
	if(!isset($_SESSION['login'])) {		//	Add 'go back'
		header('Location: main.php');
		exit();
	}
	
	session_unset();
	
	header('Location: main.php');
	
?>