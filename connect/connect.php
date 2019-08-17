<?php
	
	require_once 'config.php';
	
	try {
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
		$conn = new PDO($dsn, DB_USER, DB_PASS, [
			PDO::ATTR_EMULATE_PREPARES => false,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => true, 
			PDO::FETCH_OBJ => true
		]);
		
	} catch(PDOException $error) {
		//echo $error -> getMessage();
		exit('Database error');
	}
	
?>