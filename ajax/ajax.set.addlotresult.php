<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../config/config.inc.php");
function tood4($number)
{
	$a = substr("$number", -4, 1);   
	$b = substr("$number", -3, 1);   
	$c = substr("$number", -2, 1);  
	$d = substr("$number", -1);
	$n = array();
	
	$count = 0;
	if(!array_search($a.$b.$c.$d, $n)){
		$n[$count] = $a.$b.$c.$d;
		$count++;
	}
	
	if(!array_search($a.$b.$d.$c, $n)){
		$n[$count] = $a.$b.$d.$c;
		$count++;
	}
	
	if(!array_search($a.$c.$b.$d, $n)){
		$n[$count] = $a.$c.$b.$d;
		$count++;
	}
	
	if(!array_search($a.$c.$d.$b, $n)){
		$n[$count] = $a.$c.$d.$b;
		$count++;
	}
	
	if(!array_search($a.$d.$b.$c, $n)){
		$n[$count] = $a.$d.$b.$c;
		$count++;
	}
	
	if(!array_search($a.$d.$c.$b, $n)){
		$n[$count] = $a.$d.$c.$b;
		$count++;
	}
	
	/***************************/
	if(!array_search($b.$a.$c.$d, $n)){
		$n[$count] = $b.$a.$c.$d;
		$count++;
	}
	
	if(!array_search($b.$a.$d.$c, $n)){
		$n[$count] = $b.$a.$d.$c;
		$count++;
	}
	
	if(!array_search($b.$c.$a.$d, $n)){
		$n[$count] = $b.$c.$a.$d;
		$count++;
	}
	
	if(!array_search($b.$c.$d.$a, $n)){
		$n[$count] = $b.$c.$d.$a;
		$count++;
	}
	
	if(!array_search($b.$d.$a.$b, $n)){
		$n[$count] = $b.$d.$a.$b;
		$count++;
	}
	
	if(!array_search($b.$d.$b.$a, $n)){
		$n[$count] = $b.$d.$b.$a;
		$count++;
	}
	
	/***************************/
	if(!array_search($c.$a.$b.$d, $n)){
		$n[$count] = $c.$a.$b.$d;
		$count++;
	}
	
	if(!array_search($c.$a.$d.$b, $n)){
		$n[$count] = $c.$a.$d.$b;
		$count++;
	}
	
	if(!array_search($c.$b.$a.$d, $n)){
		$n[$count] = $c.$b.$a.$d;
		$count++;
	}
	
	if(!array_search($c.$b.$d.$a, $n)){
		$n[$count] = $c.$b.$d.$a;
		$count++;
	}
	
	if(!array_search($c.$d.$a.$b, $n)){
		$n[$count] = $c.$d.$a.$b;
		$count++;
	}
	
	if(!array_search($c.$d.$b.$a, $n)){
		$n[$count] = $c.$d.$b.$a;
		$count++;
	}
	
	/***************************/
	if(!array_search($d.$a.$b.$c, $n)){
		$n[$count] = $d.$a.$b.$c;
		$count++;
	}
	
	if(!array_search($d.$a.$c.$b, $n)){
		$n[$count] = $d.$a.$c.$b;
		$count++;
	}
	
	if(!array_search($d.$b.$a.$c, $n)){
		$n[$count] = $d.$b.$a.$c;
		$count++;
	}
	
	if(!array_search($d.$b.$c.$a, $n)){
		$n[$count] = $d.$b.$c.$a;
		$count++;
	}
	
	if(!array_search($d.$c.$a.$b, $n)){
		$n[$count] = $d.$c.$a.$b;
		$count++;
	}
	
	if(!array_search($d.$c.$b.$a, $n)){
		$n[$count] = $d.$c.$b.$a;
		$count++;
	}
	return $n;
}

function tood3($number)
{
	$a = substr("$number", -3, 1);   
	$b = substr("$number", -2, 1);   
	$c = substr("$number", -1); 

	$n = array();
	if(($a == $b)&&($a == $c)&&($b == $c)){
		$n[0] = $a.$a.$c;
	}
	else if(($a == $b)||($a == $c)||($b == $c)){
		if($a == $b){
			$n[0] = $a.$a.$c;
			$n[1] = $a.$c.$a;
			$n[3] = $c.$a.$a;
		}elseif($a == $c){
			$n[0] = $a.$b.$a;
			$n[1] = $a.$a.$b;
			$n[2] = $b.$a.$a;
		}else{
			$n[0] = $a.$b.$b;
			$n[1] = $b.$b.$a;
			$n[2] = $b.$a.$b;
		}
	}else{
	 $n[0] = $a.$b.$c;
	 $n[1] = $a.$c.$b;
	 $n[2] = $b.$a.$c; 
	 $n[3] = $b.$c.$a; 
	 $n[4] = $c.$a.$b; 
	 $n[5] = $c.$b.$a; 
	}
	return $n;
}
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	$strSQL = "SELECT lot_number,lot_timeclose FROM tb_lottery WHERE lot_status = 1 ORDER BY lot_timeclose DESC LIMIT 0,1";
	$res = $mysqli->query($strSQL);
	$row = $res->fetch_array(MYSQLI_ASSOC);
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'1','$_REQUEST[lot6]','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	
	$result_type2 = substr($_REQUEST['lot6'],1,6);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'2','$result_type2','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	
	$result_type3 = substr($_REQUEST['lot6'],2,6);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'3','$result_type3','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	
	$result_type4 = tood4(substr($_REQUEST['lot6'],2,6));
	$result = array_unique($result_type4);
	foreach ($result as &$value) {
		
		$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'4','".$value."','$row[lot_number]','$row[lot_timeclose]',null)";
		//echo $strSQL.'<br>';
		$mysqli->query($strSQL);
	}
	
	$result_type5 = substr($_REQUEST['lot6'],0,-3);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'5','".$result_type5."','$row[lot_number]','$row[lot_timeclose]',null)";
	//echo $strSQL.'<br>';
	$mysqli->query($strSQL);
	
	$result_type6  = tood3(substr($_REQUEST['lot6'],0,-3));
	$result = array_unique($result_type6);
	foreach ($result as &$value) {
		$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'6','".$value."','$row[lot_number]','$row[lot_timeclose]',null)";
		//echo $strSQL.'<br>';
		$mysqli->query($strSQL);
	}
	
	
	$result_type5 = substr($_REQUEST['lot6'],3,6);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'7','".$result_type5."','$row[lot_number]','$row[lot_timeclose]',null)";
	//echo $strSQL.'<br>';
	$mysqli->query($strSQL);
	
	$result_type6  = tood3(substr($_REQUEST['lot6'],3,6));
	$result = array_unique($result_type6);
	foreach ($result as &$value) {
		$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'8','".$value."','$row[lot_number]','$row[lot_timeclose]',null)";
		//echo $strSQL.'<br>';
		$mysqli->query($strSQL);
	}
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'9','$_REQUEST[lot3font1]','$row[lot_number]','$row[lot_timeclose]',1)";
	$mysqli->query($strSQL);
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'9','$_REQUEST[lot3font2]','$row[lot_number]','$row[lot_timeclose]',2)";
	$mysqli->query($strSQL);
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'9','$_REQUEST[lot3back1]','$row[lot_number]','$row[lot_timeclose]',3)";
	$mysqli->query($strSQL);
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'9','$_REQUEST[lot3back2]','$row[lot_number]','$row[lot_timeclose]',4)";
	$mysqli->query($strSQL);

	$result_type10 = substr($_REQUEST['lot6'],4,6);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'10','".$result_type10."','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	
	
	$result_type11 = substr($_REQUEST['lot6'],4,6);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'11','".$result_type11[0].$result_type11[1]."','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	$result_type11 = substr($_REQUEST['lot6'],4,6);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'11','".$result_type11[1].$result_type11[0]."','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'12','$_REQUEST[lot2]','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	//echo $strSQL.'<br>';
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'13','".$_REQUEST['lot2'][0].$_REQUEST['lot2'][1]."','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'13','".$_REQUEST['lot2'][1].$_REQUEST['lot2'][0]."','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	//echo $strSQL.'<br>';
	
	
	$result_type14 = array($_REQUEST['lot6'][3],$_REQUEST['lot6'][4],$_REQUEST['lot6'][5]);
	$result = array_unique($result_type14);
	foreach ($result as &$value) {
		$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'14','".$value."','$row[lot_number]','$row[lot_timeclose]',null)";
		$mysqli->query($strSQL);
		//echo $strSQL.'<br>';
	}
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'15','".$_REQUEST['lot2'][0]."','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	
	$strSQL = "INSERT INTO tb_lottery_result VALUES(null,'15','".$_REQUEST['lot2'][1]."','$row[lot_number]','$row[lot_timeclose]',null)";
	$mysqli->query($strSQL);
	
	$strSQL = "UPDATE `tb_lottery` SET lot_status = 2 WHERE lot_number = '$row[lot_number]'";
	$mysqli->query($strSQL);




?>