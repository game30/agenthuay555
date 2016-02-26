<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	if(isset($_SESSION['userid']))
	{
		$strSQL = "INSERT INTO tb_member VALUES(null,
												'$_REQUEST[username]',
												'".md5($_REQUEST['password'])."',
												'$_REQUEST[name]',
												'$_REQUEST[tell]',
												'',
												2,
												$_SESSION[userid])";
		$mysqli->query($strSQL);
		
		$strSQL = "INSERT INTO tb_credit VALUES(".$mysqli->insert_id.",0,0,0)";
		$mysqli->query($strSQL);
		
		if($_REQUEST['r_id'])
		{
			$strSQL = "DELETE FROM tb_register WHERE r_id = $_REQUEST[r_id]";
			$mysqli->query($strSQL);
			//echo $strSQL;
		}
	}
	else
	{
		echo '0';
	}
	
?>