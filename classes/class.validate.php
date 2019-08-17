<?php
	
	class Validate
	{
		private $error;		//	Which error has occured

		//	Check input
		public function check($var, $min = 0, $max = NULL, $regex = NULL) {
			$var = trim($var);
			
			if(empty($var)) {
				$this -> error = 'empty';
				return false;
			}
			
			$length = strlen($var);
			
			if(($length < $min) || (!empty($max) && ($length > $max))) {
				$this -> error = 'length';
				return false;
			
			} else if((!empty($regex)) && (!preg_match($regex, $var))) {
				$this -> error = 'match';
				return false;
			}
			
			return true;
		}
		
		//	Function to set an error
		public function makeError($errorName, $varName = NULL, $errEmpty = NULL, $errLength = NULL, $errMatch = NULL, $min = NULL, $max = NULL) {
			
			if(isset($this -> error)) {
				switch($this -> error) {
					
					case 'empty':	$_SESSION[$errorName] = $this -> makeErrorEmpty($errEmpty);
									break;
					
					case 'length':	$_SESSION[$errorName] = $this -> makeErrorLength($errLength, $varName, $min, $max);
									break;
									
					case 'match':	$_SESSION[$errorName] = $this -> makeErrorMatch($errMatch, $varName);
									break;
									
				}
				unset($this -> error);
			}
		}
		
		
		public function makeErrorEmpty($errEmpty = NULL) {
			if(!empty($errEmpty)) {
				return $errEmpty;
			
			} else {
				return 'This field is required';
			}
		}
		
		
		public function makeErrorLength($errLength = NULL, $varName = NULL, $min = NULL, $max = NULL) {
			if(isset($errLength)) {
				return $errLength;
			
			} else {
				if(!empty($varName)) {
					$varName = ucfirst($varName);
				
				} else {
					$varName = 'This field';
				}
				
				if(!empty($min)) {
					if(!empty($max)) {
						return $varName . ' must be ' . $min . ' to ' . $max . ' characters long';
					
					} else {
						return $varName . ' must be at least ' . $min . ' characters long';
					}
					
				} else if(!empty($max)) {
					return $varName . ' must be less than ' . $max . ' characters long';
				
				} else {
					return '';
				}
			}
		}
		
		
		public function makeErrorMatch($errMatch = NULL, $varName = NULL) {
			if(!empty($errMatch)) {
				return $errMatch;
			
			} else {
				if(!empty($varName)) {
					$varName = ucfirst($varName);
				
				} else {
					$varName = 'This field ';
				}
				
				return $varName . ' contains illegal characters';
			}
		}
		
		
		public function getStatement($conn, $query, $params) {
			$stmt = $conn -> prepare($query);
			$stmt -> execute($params);
			
			return $stmt;
		}
		
		
		public function getRowCount($conn, $query, $params) {
			$stmt = $this -> getStatement($conn, $query, $params);
			$rows = $stmt -> rowCount();
			
			return $rows;
		}
	}
	
?>