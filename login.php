<?PHP
	session_start();
	include (dirname(__FILE__)."/config/config_db.php");
	//include (dirname(__FILE__)."/fucntion/convertdatethai.php");
	include (dirname(__FILE__)."/config/config.inc.php");
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$error_desc = "";
	if(isset($_REQUEST['login']))
	{
		$strSQL = "SELECT * FROM tb_member WHERE username LIKE '$_REQUEST[username]' AND password LIKE '".md5($_REQUEST['password'])."' AND status < 2";
	
		$res = $mysqli->query($strSQL);
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			$_SESSION['ssid'] = generateRandomString(30);
			$_SESSION['ssidcheck'] = $_SESSION['ssid'];
			$_SESSION['name'] = $site_url;
			$_SESSION['userid'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['status'] = $row['status'];
			header( "location: index.php" );
			exit(0);
		}
		else
		{
			$error_desc = "<strong>Username</strong> และ <strong>Password</strong> ไม่ถูกต้อง กรุณาลองใหม่";
			session_destroy();	
		}
	}
	function generateRandomString($length) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<script src="jquery/jquery-2.2.0.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script src="js/validate.js"></script>
<script language="javascript">
$(document).ready(function(e) {
    $( "#form-signin" ).validate({
		rules: {
			username: {
				required: true,
			},
			password: {
				required: true,
			},
			
		},
		messages: {
			username:  {
			  required: "* กรุณากรอก ชื่อผู้ใช้",
			},	
			password: {
			  required: "* กรุณากรอก รหัสผ่าน",
			},
		}
	});
});
</script>
<style>
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
#form-signin label.error,#editpasswordform label.error{
color:red;
}
#form-signin input.error,#editpasswordform input.error {
border:1px solid red;
}
</style>
</head>

<body>
<div class="container">

      <form class="form-signin" id="form-signin">
        <div align="center"><img src="images/logo.png" width="200"/>
        <h2 class="form-signin-heading" style="line-height:30px"><kbd style="background-color:#096">กรุณาเข้าสู่ระบบ</kbd></h2></div>
        <?php
			if($error_desc != "")
			{
				echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>ผิดผลาด!</strong> '.$error_desc.'</div>';	
			}
		?>
        <label for="username" class="sr-only">Email address</label>
        <input type="text" id="username" name="username"  class="form-control" placeholder="ชื่อผู้ใช้" required autofocus>
        <label for="Password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">เข้าสู่ระบบ</button>
  </form>

</div> <!-- /container -->
</body>
</html>