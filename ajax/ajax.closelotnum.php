<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../config/config.inc.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$strSQL = "UPDATE  tb_lottery SET lot_status = 1";
	$mysqli->query($strSQL);

?>