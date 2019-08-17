<?php
	
	require_once 'if_not_logged.php';
	
	if((!isset($_SESSION['admin'])) || ($_SESSION['admin'] === "n")) {
		header('Location: main.php');
		exit();
	}
	
?>