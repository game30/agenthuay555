<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	$json_data;
	if(isset($_SESSION['userid']))
	{
		$strSQL = "SELECT * FROM tb_member WHERE parent = $_SESSION[userid] ORDER BY id DESC LIMIT 0,1";
		$res = $mysqli->query($strSQL);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		
		$pr_id = sprintf("$_SESSION[username]%03d", (substr($row['username'], -3)+1));
		
		echo $pr_id;
	}
	else
	{
		echo '0';
	}
	
?>