<?php
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/convertdatethai.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
?>
<script language="javascript" src="js/validate.js"></script>
<script language="javascript">
$(document).ready(function(e) {
	$("#changepasswordform").validate({
		rules: {
			password: {
				required: true,
				minlength: 6
			},
			password2: {
				required: true,
				minlength: 6,
				equalTo : "#password",
			},
		},
		messages: {
			password: {
			  required: "กรุณากรอกรหัสผ่าน",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร")
			},
			password2: {
			  required: "กรุณายืนยันรหัสผ่าน",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร"),
			  equalTo: jQuery.validator.format("กรุณาใส่รหัสผ่านให้ตรงกัน"),
			},
		 }
	});
	
	
    $("#btnchangepassword").click(function(e) {
		
		if($("#changepasswordform").valid())
		{
			$.ajax({
				url: "ajax/ajax.resetpassword.php",
				dataType: "html",
				data: {
					'id' : <?php echo $_REQUEST['userid'] ?>,
					'password' : $("#password").val() ,
					'password2' :  $("#password2").val() ,
				},
			}).error(function(){
				alert('There was an error processing your information!');
			  
			}).done(function( html ) {
				//alert(html)
				location.reload();
			});
		}
		
	});
});


</script>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title text-success">เปลี่ยนรหัสผ่าน</h4>
</div>
<div class="modal-body">
<form class="form-horizontal" id="changepasswordform">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">รหัสผ่าน</label>
    <div class="col-sm-7">
      <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-5 control-label">ยืนยันรหัสผ่าน</label>
    <div class="col-sm-7">
      <input type="password" class="form-control" id="password2" name="password2" placeholder="ยืนยันรหัสผ่าน">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-5 col-sm-7">
      <button type="button" class="btn btn-success" id="btnchangepassword">เปลี่ยนรหัสผ่าน</button>
    </div>
  </div>
</form>
</div>