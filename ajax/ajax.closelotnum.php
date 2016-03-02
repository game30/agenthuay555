<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../config/config.inc.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$strSQL = "SELECT * FROM tb_lottery ORDER BY lot_timeclose DESC LIMIT 0,1";
	$res = $mysqli->query($strSQL);
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	$strSQL = "UPDATE `tb_lottery` SET lot_status = 1 WHERE lot_number = '$row[lot_number]'";
	$mysqli->query($strSQL);

?>