<?php
	
	if(!isset($_SESSION)) {
		session_start();
	}
	
	function displayError($errorName) {
		if(!empty($_SESSION[$errorName])) {
			echo '<div class="alert alert-danger">';
			echo $_SESSION[$errorName];
			echo '</div>';
			
			unset($_SESSION[$errorName]);
		}
	}
?>