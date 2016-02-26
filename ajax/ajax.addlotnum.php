<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../config/config.inc.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$strSQL = "INSERT INTO tb_lottery VALUES('$_REQUEST[lot_num]','".strtotime($_REQUEST["lot_datetime"])."',0)";
	$mysqli->query($strSQL);

?>