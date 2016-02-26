<?php
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/convertdatethai.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$b_id ='';
	$bank_name ='';
	$b_number ='';
	$b_amount ='';
	
	if(isset($_REQUEST['b_id']))
	{
		$strSQL = "SELECT * FROM tb_bank WHERE b_id = $_REQUEST[b_id]";
		$res = $mysqli->query($strSQL);
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$b_id = ($row['b_id'] != '')?$row['b_id']:'';
			$bank_name = ($row['b_name'] != '')?$row['b_name']:'';
			$b_number = ($row['b_number'] != '')?$row['b_number']: '';
			$b_amount = ($row['b_amount'] != '')?$row['b_amount']: '';
			
		}
					
	}
?>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	
	
	
	
	
	
	
});
</script>
<form>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?php echo isset($_REQUEST['b_id'])?"แก้ไขบัญชีธนาคาร":"เพิ่มบัญชีธนาคาร"?></h4>
</div>
<div class="modal-body">
	<div id="modal_addbank_progress">
    	<div class="addbank_loading-progress"></div>
    </div>
    <div id="modal_alert_msg" class="alert alert-success" style="padding:10px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        บันทึกเรียบร้อยแล้ว
    </div>
    <div class="form-group">
    <input name="b_id" id="b_id" type="hidden"  value="<?php echo $b_id; ?>" />
    <label for="bank_name">ธนาคาร</label>
    <select class="form-control" id="bank_name" name="bank_name" >
        <option value="" >กรุณาเลือกธนาคาร</option>
        <option value="ธนาคารกรุงเทพ" <?php echo ($bank_name == "ธนาคารกรุงเทพ")?'selected="selected"':''; ?>>ธนาคารกรุงเทพ</option>
        <option value="ธนาคารกรุงศรีอยุธยา" <?php echo ($bank_name == "ธนาคารกรุงศรีอยุธยา")?'selected="selected"':''; ?>>ธนาคารกรุงศรีอยุธยา</option>
        <option value="ธนาคารกสิกรไทย" <?php echo ($bank_name == "ธนาคารกสิกรไทย")?'selected="selected"':''; ?>>ธนาคารกสิกรไทย</option>
        <option value="ธนาคารเกียรตินาคิน" <?php echo ($bank_name == "ธนาคารเกียรตินาคิน")?'selected="selected"':''; ?>>ธนาคารเกียรตินาคิน</option>
        <option value="ธนาคารซีไอเอ็มบีไทย"<?php echo ($bank_name == "ธนาคารซีไอเอ็มบีไทย")?'selected="selected"':''; ?>>ธนาคารซีไอเอ็มบีไทย</option>
        <option value="ธนาคารทหารไทย" <?php echo ($bank_name == "ธนาคารทหารไทย")?'selected="selected"':''; ?>>ธนาคารทหารไทย</option>
        <option value="ธนาคารทิสโก้" <?php echo ($bank_name == "ธนาคารทิสโก้")?'selected="selected"':''; ?>>ธนาคารทิสโก้</option>
        <option value="ธนาคารไทยพาณิชย์" <?php echo ($bank_name == "ธนาคารไทยพาณิชย์")?'selected="selected"':''; ?>>ธนาคารไทยพาณิชย์</option>
        <option value="ธนาคารธนชาต" <?php echo ($bank_name == "ธนาคารธนชาต")?'selected="selected"':''; ?>>ธนาคารธนชาต</option>
        <option value="ธนาคารยูโอบี" <?php echo ($bank_name == "ธนาคารยูโอบี")?'selected="selected"':''; ?>>ธนาคารยูโอบี</option>
        <option value="ธนาคารกรุงไทย" <?php echo ($bank_name == "ธนาคารกรุงไทย")?'selected="selected"':''; ?>>ธนาคารกรุงไทย</option>
        <option value="ธนาคารออมสิน" <?php echo ($bank_name == "ธนาคารออมสิน")?'selected="selected"':''; ?>>ธนาคารออมสิน</option>
        <option value="ธนาคารไอซีบีซี (ไทย)" <?php echo ($bank_name == "ธนาคารไอซีบีซี (ไทย)")?'selected="selected"':''; ?>>ธนาคารไอซีบีซี (ไทย)</option>
    </select>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">เลขบัญชี</label>
    <input type="text" class="form-control" id="b_number" placeholder="เลขบัญชี"  value="<?php echo $b_number; ?>">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
    <?php
		if(isset($_REQUEST['b_id']))
		{
	?>
    		<button type="button" class="btn btn-primary" id="modal_btn_savebank">แก้ไข</button>
    <?php
		}
		else
		{
	?>
    		<button type="button" class="btn btn-primary" id="modal_btn_savebank">บันทึก</button>
    <?php
		}
	?>
    
</div>
</form>