<?php
	
	if(!isset($_SESSION)) {
		session_start();
	}
	
	function checkGet($conn, $get, $crit, $sql, $params) {
		if(!empty($get)) {
			if(preg_match($crit, $get)) {
				$stmt = $conn -> prepare($sql);
				$stmt -> execute($params);
				
				return $stmt;
			}
		}
		
		return NULL;
	}
	
?>