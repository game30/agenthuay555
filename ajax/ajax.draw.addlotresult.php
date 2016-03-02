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
    	<h4>ตรวจรางวัลงวด<?php echo thai_date_short($row['lot_timeclose']) ?></h4>
    </div>
    <div class="panel-body" id="panal_calculate">   
    	<?php 
			if($row['lot_status'] == 0)
			{
		?>
    	<div class="alert alert-danger" role="alert"><h4 class="glyphicon glyphicon-exclamation-sign"></h4> ไม่สามารถตรวจรางวัลได้เพราะ งวด<?php echo thai_date_short($row['lot_timeclose']) ?> ยังเปิดรับแทงอยู่</div>  
        <?php 
			}
			else if($row['lot_status'] == 2)
			{
		?>
    	<div class="alert alert-danger" role="alert"><h4 class="glyphicon glyphicon-exclamation-sign"></h4> ไม่สามารถตรวจรางวัลได้เพราะ งวด<?php echo thai_date_short($row['lot_timeclose']) ?> ได้ทำการตรวงรางวัลไปแล้ว</div>  
        <?php 
			}
		?>
        <form class="form-horizontal" id="form_calculate" data-toggle="validator" >
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">รางวัลที่ 1</label>
                <div class="col-sm-10">
                    <input type="number" data-minlength="6" class="form-control" id="lot6" name="lot6" placeholder="รางวัลที่ 1" <?php echo $disable ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">เลขหน้า 3 ตัว (ตัวที่ 1)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="lot3font1" name="lot3font1" placeholder="เลขหน้า 3 ตัว (ตัวที่ 1)" <?php echo $disable ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">เลขหน้า 3 ตัว (ตัวที่ 2)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="lot3font2" name="lot3font2"  placeholder="เลขหน้า 3 ตัว (ตัวที่ 2)" <?php echo $disable ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">เลขท้าย 3 ตัว (ตัวที่ 1)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="lot3back1" name="lot3back1" placeholder="เลขท้าย 3 ตัว (ตัวที่ 1)" <?php echo $disable ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">เลขท้าย 3 ตัว (ตัวที่ 2)</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="lot3back2" name="lot3back2" placeholder="เลขท้าย 3 ตัว (ตัวที่ 2)" <?php echo $disable ?>>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">เลขท้าย 2 ตัว</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="lot2" name="lot2" placeholder="เลขท้าย 2 ตัว" <?php echo $disable ?>>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-success" <?php echo $disable ?> id="btn_submit_calculate">บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>