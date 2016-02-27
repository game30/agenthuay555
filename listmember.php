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
<script language="javascript" src="js/validate.js"></script>
<script language="javascript" src="js/listmember.js"></script>
<script>
	$(document).ready(function(){
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
		
		function loadData(page){
			loading_show();                    
			$.ajax({
				type: "POST",
				url: "ajax/ajax.listuser.php",
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
				 
				 
				});
		}
		
		loadData(1);  // For first time page load default results
		
		$(document).on( "click",'#container .pagination li', function() {
			var page = $(this).attr('p');
			loadData(page);
		});
		          
		$(document).on('click','#go_btn',function(){
			var page = parseInt($('.goto').val());
			var no_of_pages = parseInt($('.total').attr('a'));
			if(page != 0 && page <= no_of_pages){
				loadData(page);
			}else{
				alert('Enter a PAGE between 1 and '+no_of_pages);
				$('.goto').val("").focus();
				return false;
			}
			
		});
	});
</script>
<style type="text/css">

#loading{
	width: 100%;
	position: absolute;
	top: 100px;
	left: 100px;
	margin-top:200px;
}
.total
{
	float:right;font-family:arial;color:#999;
}

</style>
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
<div id="container">
    <div class="data"></div>
    <div class="pagination"></div>
</div>
</div>
<!-- modalConfirm -->
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modalConfirm">
              <div class="modal-dialog modal-sm">
                <div class="modal-content" style="padding:10px;" align="center">
                    <div id="labelprogressbar" class="bg-warning" align="center">ยืนยันทำรายการ</div><br />
                    <div class="loading-progress"></div>
                    <button type="button" class="btn btn-success" id="confirm" >ตกลง</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancle" >ยกเลิก</button>
                </div>
              </div>
            </div>
            <!-- end modalConfirm -->
            
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modalConfirmcredit">
              <div class="modal-dialog modal-sm">
                <div class="modal-content" style="padding:10px;" align="center">
                    <div id="labelprogressbar" class="bg-warning" align="center">ยืนยันการเติมเครดิต</div><br />
                    <div class="loading-progress"></div>
                    <button type="button" class="btn btn-success" id="confirmcredit" >ตกลง</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="canclecredit" >ยกเลิก</button>
                </div>
              </div>
            </div>
            <!-- end modalConfirmcredit -->
            
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalRefund">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id="modalRefundhtml">
                  
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalchangepassword">
              <div class="modal-dialog modal-sm">
                <div class="modal-content" id="modalchangepasswordhtml">
                  
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
			
            
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

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>