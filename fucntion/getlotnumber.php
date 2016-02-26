<?php
	function getlotnumber()
	{
		$lot_number = '';
		require_once (dirname(__FILE__)."/../config/config_db.php");
		$dbconn = new connect_db;
		$mysqli = $dbconn->conn();
		
		$strSQL = "SELECT lot_number FROM tb_close_bet WHERE lot_close_status = 0";
		$res = $mysqli->query($strSQL);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		$lot_number = $row['lot_number'];
		return $lot_number;
	}

?>