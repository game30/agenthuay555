<?php
class connect_db{
	public $db_host = "localhost";
	public $db_user = "root";
	public $db_passwd = "root";
	public $db_name = "huay";
	public $mysqli;
	
	public function conn(){
		$this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_passwd, $this->db_name);

		/* check connection */
		if ($this->mysqli->connect_errno) {
			printf("Connect failed: %s\n", $this->mysqli->connect_error);
			exit();
		}
		
		$this->mysqli->query("SET time_zone = '+07:00'");
		$this->mysqli->query("SET names utf8");
		
		
		return $this->mysqli;
	}
}
?>