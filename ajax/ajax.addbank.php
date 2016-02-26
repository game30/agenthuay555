<?php
	session_start(); 
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/getipaddr.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	if($_REQUEST['b_id'] == "")
		$strSQL = "INSERT INTO tb_bank VALUES (null,'$_REQUEST[b_name]','$_REQUEST[b_number]',0.00)";
	else
		$strSQL = "UPDATE tb_bank SET b_name='$_REQUEST[b_name]',b_number='$_REQUEST[b_number]' WHERE b_id = $_REQUEST[b_id]";
	$mysqli->query($strSQL);										
		
	echo $strSQL;
?>