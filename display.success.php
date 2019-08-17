<?php
	
	if(!isset($_SESSION)) {
		session_start();
	}
	
	function displaySuccess($successName) {
		if(!empty($_SESSION[$successName])) {
			echo '<div class="alert alert-success">';
			echo $_SESSION[$successName];
			echo '</div>';
			
			unset($_SESSION[$successName]);
		}
	}
?>