<?php
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/convertdatethai.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo isset($_REQUEST['b_id'])?"แก้ไขบัญชีธนาคาร":"เพิ่มรายการโอนเงิน"?></h4>
</div>
<div class="modal-body">
    <div class="addbank_loading-progress"></div>
    <form class="form-horizontal">
      <div class="form-group">
        <label for="b_name" class="col-sm-2 control-label">ธนาคาร</label>
        <div class="col-sm-10">
          <select class="form-control" id="b_name" name="b_name" >
          <?php
          	$strSQL = "SELECT * FROM tb_bank";
            $res = $mysqli->query($strSQL);
            while($row = $res->fetch_array(MYSQLI_ASSOC))
            {
		  ?>
            <option value="<?php echo $row['b_id'] ?>" ><?php echo $row['b_name']."(". $row['b_number'].")" ?></option>
           <?php
			}
		   ?>
        </select>
        </div>
      </div>
      <div class="form-group">
        <label for="bk_transfer_amount" class="col-sm-2 control-label">จำนวนเงิน</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="bk_transfer_amount" placeholder="จำนวนเงิน">
        </div>
      </div>
      <div class="form-group">
        <label for="bk_transfer_date" class="col-sm-2 control-label">วัน เวลา</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="bk_transfer_date" placeholder="วัน เวลา" readonly>
        </div>
      </div>
      
    </form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" id="btn_save_bk_transfer">บันทึก</button>
</div>