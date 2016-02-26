<?php
	session_start(); 
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/getipaddr.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	if(isset($_SESSION['userid']))
	{
		//$strSQL = "UPDATE tb_credit SET credit_init = (credit_init+$_REQUEST[credit]),credit = (credit+$_REQUEST[credit]) WHERE m_id = $_REQUEST[m_id]";
		$strSQL = "SELECT credit FROM tb_credit WHERE m_id = $_REQUEST[m_id] LIMIT 0,1";
		$res = $mysqli->query($strSQL);
		$row = $res->fetch_array(MYSQLI_ASSOC);
		
		$refund_credit = floatval($_REQUEST['credit']) - floatval($row['credit']);
		
		
		
		$strSQL = "UPDATE tb_credit SET credit_init = $_REQUEST[credit],credit = $_REQUEST[credit] WHERE m_id = $_REQUEST[m_id]";
		$mysqli->query($strSQL);
		
		if($refund_credit>0)
		{
			$strSQL = "INSERT INTO tb_refund VALUES (
													null,
													$_SESSION[userid],
													$_REQUEST[m_id],
													$refund_credit,
													'',
													".strtotime('now').",
													1,
													'รายชื่อสมาชิก',
													'".get_client_ip()."')";
			$mysqli->query($strSQL);										
		}
		else if($refund_credit<0)
		{
			$strSQL = "INSERT INTO tb_refund VALUES (
													null,
													$_SESSION[userid],
													$_REQUEST[m_id],
													$refund_credit,
													'',
													".strtotime('now').",
													2,
													'รายชื่อสมาชิก',
													'".get_client_ip()."')";
			$mysqli->query($strSQL);
		}
		
		echo $strSQL;
		
		
	}
	else
	{
		echo '0';
	}
	
?>