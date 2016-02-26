<?php
	session_start(); 
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/getipaddr.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	
	if(isset($_REQUEST['id']))
	{
		$strSQL = "SELECT * FROM tb_member_detail WHERE m_id = $_REQUEST[id]";
		$res = $mysqli->query($strSQL);
		if($res->num_rows > 0)
		{
			$strSQL = "UPDATE tb_member SET password = '".md5($_REQUEST['password'])."' WHERE id = $_REQUEST[id]";
			$res = $mysqli->query($strSQL);
		}
		else
		{
			$strSQL = "UPDATE tb_member SET password = '".md5($_REQUEST['password'])."' WHERE id = $_REQUEST[id]";
			$res = $mysqli->query($strSQL);
		}
		echo '1';
	}
	else
	{
		echo '0';
	}
	
?>