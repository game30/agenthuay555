<?php 
	session_start();
	include (dirname(__FILE__)."/config/config_db.php");
	include (dirname(__FILE__)."/config/config.inc.php");
	$register_name = "";
	$register_tell = "";
	
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
<script language="javascript" src="js/progresstimer.js"></script>
<script language="javascript">
$(document).ready(function(){
	var progress ="" ;
	var page ="1" ;
	
	function loading_show(){
		$('#modalprogress').modal('show');
			progress = $(".loading-progress").progressTimer({		
			timeLimit: 2,
		});
	}
	
	function loading_hide(){
		$('#modalprogress').modal('hide');
	}                
	
	function loadData(page){
		//alert(page)
		                   
		$.ajax({
			type: "POST",
			url: "ajax/ajax.lisbank.php",
			data: "page="+page,
			}).error(function(){
			
				progress.progressTimer('error', {
					errorText:'ERROR!',
					onFinish:function(){
						alert('There was an error processing your information!');
					}
				});
			}).done(function(msg){
				$("#container").html(msg);
				progress.progressTimer('complete', {
					onFinish: function () {
						
						 loading_hide();
					}
				});
			 	$("#page_num").val(page);
			 
			});
	}
	$(document).on( "click",'#container .pagination li', function() {
		loading_show(); 
		page = $(this).attr('p');
		loadData(page);
	});
	loadData($("#page_num").val());  // For first time page load default results
	
	$("#btn_addbank").click(function(e) {
		
		$("#modal-content").html('');
        $.ajax({
			async : false,
			url: "modal/modal.addbank.php",
			dataType: "html",
			data: "m_id="+$(this).attr('value'),
		}).done(function( html ) {
			$("#modal-content").html(html);
			$("#modal_alert_msg").hide();
			
		});
		$("#modal").modal('show');
		
    });

	
	$(document).on("click","#edit_bank",function(e){
		$("#modal-content").html('');
        $.ajax({
			async : false,
			url: "modal/modal.addbank.php",
			dataType: "html",
			data: "b_id="+$(this).attr('value'),
		}).done(function( html ) {
			$("#modal-content").html(html);
			$("#modal_alert_msg").hide();
		});
		$("#modal").modal('show');
	});
	
	$(document).on("click","#modal_btn_savebank",function(e){
		$('#modal_addbank_progress').show();
			progress = $(".addbank_loading-progress").progressTimer({		
			timeLimit: 2,
		});
		
		var data = "b_id="+$("#b_id").val()+"&b_name="+$("#bank_name").val()+"&b_number="+$("#b_number").val();
		
        $.ajax({
			
			url: "ajax/ajax.addbank.php",
			dataType: "html",
			data: data,
		}).done(function( html ) {
			progress.progressTimer('complete', {
				onFinish: function () {
					$('#modal_addbank_progress').hide();
					$("#modal_alert_msg").show();
					$("#bank_name").val('');
					$("#b_number").val('');		
				}
			});
			loadData(page);
		});
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
<input name="" type="hidden" value="1" id="page_num"/>
<div class="col-sm-12">
	<div class="panel panel-info">
        <div class="panel-heading">
        	<div class="row">
        	<div class="col-sm-6">
            	<h4>บัญชีธนาคาร</h4>
            </div>
            <div class="col-sm-6" align="right">
            	<button id="btn_addbank"><h4 class="glyphicon glyphicon-plus-sign text-success" style="vertical-align:middle ;min-height:10px;line-height:10px;"></h4> เพิ่มบัญชีธนาคาร</button>
            </div>
        	</div>
        </div>
        <div class="panel-body">
        	<div class="row">
                <div class="col-sm-12">
                	<div id="container">
                    	<div class="data"></div>
    					<div class="pagination"></div>
                    </div>
                </div>
            </div>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content">
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>