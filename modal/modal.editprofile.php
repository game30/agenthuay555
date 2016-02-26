<?php
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/convertdatethai.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$error_desc ="";
	$profile_add = 0;
	$firstname = '';
	$lastname = '';
	$tell = '';
	$email = '';
	$bank_name = '';
	$bank_number = '';
	$bank_profilename = '';
	$bank_branch = '';
	
	if(isset($_REQUEST['userid']))
	{
		$strSQL = "SELECT * FROM tb_member_detail WHERE m_id = $_REQUEST[userid]";
		$res = $mysqli->query($strSQL);
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$firstname = ($row['m_firstname'] != '')?$row['m_firstname']:'';
			$lastname = ($row['m_lastname'] != '')?$row['m_lastname']: '';
			$tell = ($row['m_tell'] != '')?$row['m_tell']: '';
			$email = ($row['m_email'] != '')?$email=$row['m_email']:$email= '';
			$bank_name = ($row['m_bank_name'] != '')?$row['m_bank_name']: '';
			$bank_number = ($row['m_bank_number'] != '')?$row['m_bank_number']: '';
			$bank_profilename = ($row['m_bank_profile'] != '')?$row['m_bank_profile']: '';
			$bank_branch = ($row['m_bank_branch'] != '')?$row['m_bank_branch']: '';
			$profile_add = 1;
		}
					
	}
	if(isset($_REQUEST['submit']))
	{
		echo "game";
	}
	
?>
<script language="javascript" src="js/validate.js"></script>
<script language="javascript">
$(document).ready(function(e) {
	$("#profileform").validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			lastname: {
				required: true,
				minlength: 2
			},
			tell: {
				required: true,
				//matches: "[0-9]+",  // <-- no such method called "matches"!
				number: true,
				minlength:10,
				maxlength:10
			},
			email: {
				required: true,
				email: true,
				minlength: 2
			},
			bank_name: {
				required: true,
				//minlength: 2
			},
			bank_number: {
				required: true,
				number: true,
				minlength: 2
			},
			bank_profilename: {
				required: true,
				minlength: 2
			},
			bank_branch: {
				required: true,
				minlength: 2
			},
		},
		messages: {
			name: {
			  required: "* กรุณากรอก ชื่อจริง",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร")
			},
			lastname: {
			  required: "* กรุณากรอก นามสกุล",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร")
			},
			tell: {
			  required: "* กรุณากรอก เบอร์มือถือ",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร"),
			  number: jQuery.validator.format("กรุณาใส่ตัวเลข")
			},
			email: {
			  required: "* กรุณากรอก อีเมล์",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร"),
			  email: jQuery.validator.format("กรุณาใส่อีเมล์ที่ถูกต้อง")
			},
			bank_name: {
			  required: "* กรุณาเลือกธนาคาร",
			},
			bank_number: {
			  required: "* กรุณากรอก เลขที่บัญชีนาคาร",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร"),
			  number: jQuery.validator.format("กรุณาใส่ตัวเลข")
			},
			bank_profilename: {
			  required: "* กรุณากรอก ชื่อ-สกุลสมุดบัญชีนาคาร",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร")
			},
			bank_branch: {
			  required: "* กรุณากรอก สาขานาคาร",
			  minlength: jQuery.validator.format("กรุณาใส่ตัวอักษรอย่างน้อย {0} ตัวอักษร")
			}
			
		 }
	});
	
	
    $("#profileform button").click(function(e) {
		if($(this).attr('id') == 'sumiteditprofile')
		{
			//alert($(this).val());return 0;
			if($("#profileform").valid())
			{
				$.ajax({
					url: "ajax/ajax.editprofile.php",
					dataType: "html",
					data: {
						'id' : <?php echo $_REQUEST['userid'] ?>,
						'name' : $("#name").val() ,
						'lastname' :  $("#lastname").val() ,
						'tell' :  $("#tell").val() ,
						'email' :  $("#email").val() ,
						'bank_name' :  $("#bank_name").val() ,
						'bank_number' :  $("#bank_number").val() ,
						'bank_profilename' :  $("#bank_profilename").val() ,
						'bank_branch' :  $("#bank_branch").val() ,
					},
				}).error(function(){
					alert('There was an error processing your information!');
				  
				}).done(function( html ) {
					//alert(html)
					location.reload();
				});
			}
		}
	});
});


</script>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">ข้อมูลส่วนตัวสมาชิก</h4>
</div>
<div class="modal-body">
<form id="profileform" method="post" >
    <h4>ข้อมูลส่วนตัว</h4>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="name">ชื่อ</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="กรุณากรอก ชื่อจริง" value="<?php echo $firstname ?>">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="lastname">นามสกุล</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="กรุณากรอก นามสกุล" value="<?php echo $lastname ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="tell">เบอร์มือถือ</label>
                <input type="text" class="form-control" id="tell" name="tell" placeholder="กรุณากรอก เบอร์มือถือ" maxlength="10" value="<?php echo $tell ?>">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
              <label for="email">อีเมล์</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="กรุณากรอก อีเมล์" value="<?php echo $email ?>">
            </div>
        </div>
    </div>
    <hr />
    <h4>ข้อมูลธนาคาร <span class="text-danger">(ใช้โอนเงินเข้าเมื่อถูกรางวัล)</span></h4>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="bank_name">ธนาคาร</label>
                <select class="form-control" id="bank_name" name="bank_name">
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
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="bank_number">เลขที่บัญชี</label>
                <input type="text" class="form-control" id="bank_number" name="bank_number" placeholder="กรุณากรอก เลขที่บัญชีนาคาร" value="<?php echo $bank_number ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="bank_profilename">ชื่อ-สกุลสมุดบัญชีนาคาร</label>
                <input type="text" class="form-control" id="bank_profilename" name="bank_profilename" placeholder="กรุณากรอก ชื่อ-สกุลสมุดบัญชีนาคาร" value="<?php echo $bank_profilename ?>">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <label for="bank_branch">สาขา</label>
                <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="กรุณากรอก สาขานาคาร" value="<?php echo $bank_branch ?>">
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12" align="center">
            <button class="btn btn-primary btn-lg" type="button" value="บันทึกข้อมูลส่วนตัว" id="sumiteditprofile">บันทึกข้อมูลส่วนตัว</button>
        </div>
    </div>
   
    </form>
</div>