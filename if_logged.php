<?php
	
	if(!isset($_SESSION)) {
		session_start();
	}
	
	if(isset($_SESSION['login'])) {
		header('Location: main.php');
		exit();
	}
	
?>