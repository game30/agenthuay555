<?php
	session_start(); 
	include (dirname(__FILE__)."/config/config_db.php");
	include (dirname(__FILE__)."/config/config.inc.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	$json_data;
	if(isset($_SESSION['userid']))
	{
		if($_SESSION['name']!= $site_url)
		{
			header( "location: index.php" );
			exit(0);
		}
	}
	else
	{
		header( "location: login.php" );
		exit(0);
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
<script src="js/listregister.js"></script>
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
            <li><a href="listmember.php">รายชื่อสมาชิก</a></li>
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
        
      </ul>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> ข้อมูลส่วนตัว<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
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
        <div class="panel-heading">รายชื่อผู้สมัครสมาชิก</div>
        <div class="panel-body">
            <div class="row">
            <form id="listregister-form">
            <table class="table table-striped">
            	<tr>
                	<th>#</th>
                    <th>ชื่อ</th>
                    <th>เบอร์โทร</th>
                    <th>เพิ่ม / ลบ</th>
                </tr>
                <?php
					$strSQL = "SELECT* FROM tb_register WHERE r_status = 0";
					$res = $mysqli->query($strSQL);
					$numcount = 1;
					while($row = $res->fetch_array(MYSQLI_ASSOC))
					{
				?>
                		<tr>
                            <td><?php echo $numcount?></td>
                            <td><?php echo $row['r_name']?></td>
                            <td><?php echo $row['r_tel']?></td>
                            <td><button type="button" value="<?php echo $row['r_id'] ?>" id="add">
                                	<span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding:3px;"></span>
                                </button> 
                                / 
                                <button type="button" value="<?php echo $row['r_id'] ?>" id="remove">
                                	<span class="glyphicon glyphicon-trash" aria-hidden="true"style="padding:3px;"></span>
                                    </button></td>
                        </tr>
                <?php
						$numcount++;
					}
				?>
             
            </table>
            </form>
            <!-- modalConfirm -->
            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="modalConfirm">
              <div class="modal-dialog modal-sm">
                <div class="modal-content" style="padding:10px;" align="center">
                    <div id="labelprogressbar" class="bg-warning" align="center">ยืนยันทำรายการ</div><br />
                    <div class="loading-progress"></div>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="confirm" >ตกลง</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancle" >ยกเลิก</button>
                </div>
              </div>
            </div>
            <!-- end modalConfirm -->
            </div>
        </div>
    </div>
</div>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>