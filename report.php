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
<div class="col-sm-12">
	<div class="panel panel-info">
        <div class="panel-heading"><h4>รายงาน</h4></div>
        <div class="panel-body">
        	<div class="row">
            	<div class="col-sm-12">
        			<img src="chart/charttype1.php" class="img-responsive img-rounded" width="100%" style="max-height:180px;max-width:800px;"/>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
        			<img src="chart/charttype2.php" class="img-responsive img-rounded" width="100%" style="max-height:180px;max-width:800px;"/>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
        			<img src="chart/charttype3.php" class="img-responsive img-rounded" width="100%" style="max-height:180px;max-width:800px;"/>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
        			<img src="chart/charttype56789.php" class="img-responsive img-rounded" width="100%" style="max-height:180px;max-width:800px;"/>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
        			<img src="chart/charttype10111213.php" class="img-responsive img-rounded" width="100%" style="max-height:180px;max-width:800px;"/>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
        			<img src="chart/charttype1415.php" class="img-responsive img-rounded" width="100%" style="max-height:180px;max-width:800px;"/>
                </div>
            </div>
     	</div>
     </div>
</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>