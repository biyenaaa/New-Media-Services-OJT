<?php
if (!class_exists('Db')) {
	class Db{
		public function connect() {
			global $dbconfig;

			$connection = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['db']);

			if(mysqli_connect_errno()) {
				printf("Database connection error.");
				exit();
			} else {
				return $connection;
			}
		}

		public function query($query){
			$db = $this->connect();

			$result = $db->query($query);

			return $result;
		}

	}
}
?>