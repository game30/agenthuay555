<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../config/config.inc.php");
	include (dirname(__FILE__)."/../fucntion/convertdatethai.php");
	$disable = "";
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$strSQL = "SELECT * FROM tb_lottery ORDER BY lot_timeclose DESC LIMIT 0,1";
	$res = $mysqli->query($strSQL);
	$row = $res->fetch_array(MYSQLI_ASSOC);
	if($row['lot_status'] != 1 )
		$disable = "disabled='disabled'";
?>
<div class="panel panel-info">
    <div class="panel-heading">
    	<h4>คำนวณรางวัล</h4>
    </div>
    <div class="panel-body" id="panal_calculate">   
    	<form class="form-inline">
          <div class="form-group">
            	<label for="exampleInputName2">งวดวันที่</label>
          </div>
          <div class="form-group">
                <input type="text" class="input-sm form-control" id="datepicker" name="datepicker" readonly="readonly" value="16-02-2016"/>
          </div>
          <button type="button" class="btn btn-success" id="btn_display_callot">แสดง</button>
        </form><br />
        <div id="content_callot_result"></div>
        
    	
    </div>
</div>