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
			$strSQL = "UPDATE tb_member_detail SET 
						m_firstname = '$_REQUEST[name]',
						m_lastname = '$_REQUEST[lastname]',
						m_tell = '$_REQUEST[tell]',
						m_email = '$_REQUEST[email]',
						m_bank_name = '$_REQUEST[bank_name]',
						m_bank_number = '$_REQUEST[bank_number]',
						m_bank_profile = '$_REQUEST[bank_profilename]',
						m_bank_branch = '$_REQUEST[bank_branch] ' 
						WHERE m_id = $_REQUEST[id]";
			echo $strSQL;
			$mysqli->query($strSQL);
			
			$strSQL = "UPDATE tb_member SET name = '$_REQUEST[name] $_REQUEST[lastname]',tell = '$_REQUEST[tell]',email = '$_REQUEST[email]' WHERE id = $_REQUEST[id]";
			$res = $mysqli->query($strSQL);
		}
		else
		{
			$strSQL = "INSERT INTO tb_member_detail 
							VALUE ($_REQUEST[id],
							'$_REQUEST[name]',
							'$_REQUEST[lastname]',
							'$_REQUEST[tell]',
							'$_REQUEST[email]',
							'$_REQUEST[bank_name]',
							'$_REQUEST[bank_number]',
							'$_REQUEST[bank_profilename]',
							'$_REQUEST[bank_branch]')";
			$res = $mysqli->query($strSQL);
			echo $strSQL;
			$strSQL = "UPDATE tb_member SET name = '$_REQUEST[name] $_REQUEST[lastname]',tell = '$_REQUEST[tell]',email = '$_REQUEST[email]' WHERE id = $_REQUEST[id]";
			$res = $mysqli->query($strSQL);
		}
		echo '1';
	}
	else
	{
		echo '0';
	}
	
?>