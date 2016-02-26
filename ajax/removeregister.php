<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	$json_data;
	if(isset($_SESSION['userid']))
	{
		$strSQL = "DELETE FROM tb_register WHERE r_id=$_REQUEST[id]";
		echo $mysqli->query($strSQL);
	}
	else
	{
		echo '0';
	}
	
?>