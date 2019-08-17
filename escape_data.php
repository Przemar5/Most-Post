<?php
	
	function escape_data($conn, $data) {
		$data = mysqli_real_escape_string($conn, trim($data));
		$data = strip_tags($data);
		
		return $data;
	}
	
?>