<?php
	session_start();
	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/config/config_db.php");
	include (dirname(__FILE__)."/config/config.inc.php");
	
	if(!isset($_SESSION['userid'])){
		header( "location: login.php" );
		exit(0);
	}else{
		if($_SESSION['name'] != $site_url){
			header( "location: login.php" );
			exit(0);
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link href="css/style.css" rel="stylesheet"/>
<script src="jquery/jquery-2.2.0.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<!-- InstanceBeginEditable name="head" -->
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
<link href="css/bootstrap-switch.min.css" rel="stylesheet" />
<script src="js/bootstrap-switch.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="js/progresstimer.js"></script>

<script>
	
	$.fn.datetimepicker.dates['th'] = {
		days: ["อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์", "อาทิตย์"],
		daysShort: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
		daysMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา"],
		months: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"],
		monthsShort: ["ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
		today: "วันนี้",
		weekStart: 0,
		meridiem: '',
	};
	
	$(document).ready(function(e) {
		
		
		
		$('.switch').bootstrapSwitch({
			onText : 'เปิด',
			offText : 'ปิด',
			onColor : 'success',
			offColor : 'danger'
		}).on('switchChange.bootstrapSwitch', function(event, state) {
			if(state == false)
			{
			  $("#statusbet").val("1");
			  $('#modalalert').modal('show');	
			}
		});
		
        $(".form_datetime").datetimepicker({
			format: 'dd-mm-yyyy hh:ii',
			autoclose : true,
			todayBtn : true,
			todayHighlight : true,
			startDate : new Date(),
			language: 'th',
		}).on('changeDate', function(ev){
			var str = ev.currentTarget.value;
			var res = str.split(" ")[0].replace(/-/g ,'');
			$("#lot_num").val(res);
			$("#lot_timestamp").val(ev.timeStamp);
		});
		
		var progress ="" ;
		
		function loading_show(){
			$('#modalprogress').modal('show');
				progress = $(".loading-progress").progressTimer({		
				timeLimit: 2,
			});
		}
		
		function loading_hide(){
			$('#modalprogress').modal('hide');
		}   
		
		function addlotnumber(){
			loading_show();                    
			$.ajax({
				type: "POST",
				url: "ajax/ajax.addlotnum.php",
				data: "lot_num="+$("#lot_num").val()+"&lot_datetime="+$("#lot_datetime").val(),
			}).error(function(){
			  	progress.progressTimer('error', {
			  		errorText:'ERROR!',
			  		onFinish:function(){
						alert('There was an error processing your information!');
			 	 	}
				});
			}).done(function(msg){
					//$("#container").html(msg);
				progress.progressTimer('complete', {
					onFinish: function () {
							loading_hide();
					}
				});
				loading_hide();
				location.reload();
			});
		}
		
		$("#btn_addlotnum").click(function(e) {
            addlotnumber();
        });    
		
		$("#modalalert_btn_closebet").click(function(e) {
			$('#modalalert').modal('hide');
			loading_show(); 
            $.ajax({
				type: "POST",
				url: "ajax/ajax.closelotnum.php",
				data: "lot_num="+$("#lot_num").val()+"&lot_datetime="+$("#lot_datetime").val(),
			}).error(function(){
			  	progress.progressTimer('error', {
			  		errorText:'ERROR!',
			  		onFinish:function(){
						alert('There was an error processing your information!');
			 	 	}
				});
			}).done(function(msg){
					//$("#container").html(msg);
				progress.progressTimer('complete', {
					onFinish: function () {
							loading_hide();
					}
				});
				loading_hide();
				location.reload();
			});
        });
		
		$('#modalalert').on('hidden.bs.modal', function (e) {
			  $('.switch').bootstrapSwitch('state', true); // true || false
		});
    });
</script>
<!-- InstanceEndEditable -->
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img alt="Brand" src="images/logo.png" width="100">
      </a>
      <ul class="nav navbar-nav">
      	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ตั้งค่า<span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="configstatus.php">ตั้งค่าสถานะเว็บ</a></li>
            <li><a href="configlot.php">ตั้งค่างวดต่อไป</a></li>
            <li><a href="configaddbank.php">เพิ่มบัญชีธนาคาร</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">สมาชิก <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="listregister.php">รายชื่อผู้สมัครสมาชิก</a></li>
            <li><a href="addmember.php">เพิ่มสมาชิก</a></li>
            <li><a href="listmember.php">รายชื่อสมาชิก</a></li>
          </ul>
        </li>
        <li><a href="report.php">รายงาน</a></li>
        <li><a href="customertransfer.php">รายการโอนเงิน</a></li>
        <li><a href="banktransfer.php">รายการโอนเงิน</a></li>
      </ul>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> ข้อมูลส่วนตัว<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> ออกจากระบบ</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- InstanceBeginEditable name="content" -->
<div class="col-sm-12">
	<div class="panel panel-info">
        <div class="panel-heading"><h4>ตั้งค่างวดต่อไป</h4></div>
        <div class="panel-body">
        	<form class="form-horizontal">
           <?php
		    $dbconn = new connect_db;
			$mysqli = $dbconn->conn();
			$strSQL = "SELECT * FROM tb_lottery ORDER BY lot_timeclose DESC LIMIT 0,1";
			$res = $mysqli->query($strSQL);
			$num_row = $res->num_rows;
			$row = $res->fetch_array(MYSQLI_ASSOC);
			if($row['lot_status'] != 0 || $num_row == 0)
			{
			?>
              <div class="form-group">
                <label for="statusweb" class="col-sm-2 control-label">วัน เวลาปิดงวดต่อไป</label>
                <div class="col-sm-10">
                  <input style="width:200px;" type="text" class="form_datetime form-control" readonly="readonly" id="lot_datetime"/>
                  <input type="hidden" value="" id="lot_timestamp" name="timehide"/>
                  <input type="hidden" value="" id="lot_num" name="timehide"/>
                </div>
              </div>
              <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" id="btn_addlotnum">บันทึก</button>
               </div>
              </div>
           
			<?php 
			}
			else
			{
			?>
            	<div class="alert alert-danger" role="alert"><p class="glyphicon glyphicon-exclamation-sign"></p> งวดปัจจุบันยังไม่ปิดรับแทง</div>
                <div class="form-group">
                    <label for="statusweb" class="col-sm-2 control-label">วัน เวลาปิดงวดต่อไป</label>
                    <div class="col-sm-10">
                    	<input style="width:200px;" type="text" value="<?php echo date('d-m-Y H:i', $row['lot_timeclose']); ?>" class="form-control" readonly="readonly" />
                    </div>
                </div>
                <div class="form-group">
                	<label for="statusbet" class="col-sm-2 control-label">สถานะรับแทง</label>
                	<div class="col-sm-10">
                		<input name="statusbet" class="switch" type="checkbox" <?php echo  $row['lot_status'] == 0? 'checked="checked"':''; ?>  id="statusbet" />
                	</div>
                </div>
            <?php
			}
			?>
            </form>
		</div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modalprogress">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="padding:10px;" align="center">
        <div id="labelprogressbar" class="bg-warning" align="center">โปรดรอ.</div><br />
        <div class="loading-progress"></div>
        <!--button type="button" class="btn btn-success" data-dismiss="modal" id="confirm" >ตกลง</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancle" >ยกเลิก</button-->
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modalalert">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="padding:10px;">
      <div class="modal-header alert alert-warning">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title glyphicon glyphicon-exclamation-sign"> คำเตือน</h4>
      </div>
      <div class="modal-body">
    	<div>
        	ถ้าทำการปิดแล้วจะไม่สามรถเปิดได้อีก
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" id="modalalert_btn_closebet">ปิดรับ</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" id="modalalert_btn_closemodal">ยกเลิก</button>
      </div>
    </div>
    
  </div>
</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>