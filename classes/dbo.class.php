<?php 
	
	class dbo {

		// Add Your Host
		private $db_host = "";
		
		// Add Your DataBase UserName
		private $db_user = "";
		
		// Add Your DataBase Password
		private $db_password = "";
		
		// Add Your DataBase
		private $db_name = "";
		
		private $link;

		function __construct() {
			$this->link = mysqli_connect(
				$this->db_host,
				$this->db_user,
				$this->db_password,
				$this->db_name
			) or die(mysqli_connect_error());
		}

		function dml($query) {
			mysqli_query($this->link, $query) or die(mysqli_error($this->link));
		}

		function get($query) {
			$result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			return $result;
		}
		function get_scalar($query,$position = 0) {
			

			$sel_row = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
			$result = mysqli_fetch_row($sel_row);
			
			if(mysqli_num_rows($sel_row) < $position)
				$position = 0;
			return $result[$position];
		}
	}
	$db = new dbo();
 ?>