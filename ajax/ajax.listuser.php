<?php
session_start(); 
?>
<script language="javascript" src="js/validate.js"></script>
<script language="javascript" src="js/listmember.js"></script>
<?php
include (dirname(__FILE__)."/../config/config_db.php");
include (dirname(__FILE__)."/../config/config.inc.php");
$dbconn = new connect_db;
$mysqli = $dbconn->conn();
	
if($_POST['page'])
{
	$page = $_POST['page'];
	$cur_page = $page;
	$page -= 1;
	$per_page = 10;
	$previous_btn = false;
	$next_btn = false;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;
	$numcount = ($page*$per_page)+1;
	
	
	?>
   
	<div class="panel panel-info">
        <div class="panel-heading"><h4>รายชื่อสมาชิก</h4></div>
        <div class="panel-body">
            <div class="row">
            <form id="listregister-form">
            <table class="table table-striped input-sm">
            	<tr>
                	<th>#</th>
                    <th>รหัสผู้ใช้ (ชื่อ-นามสกุล)</th>
                    <th>เครดิต</th>
                    <th>เบอร์โทร</th>
                    <th>อีเมล์</th>
                    <th><div align="center">ประวิตการใช้งาน</div></th>
                    <th>แก้ไข</th>
                    <th><div align="center">เปลี่ยนรหัสผ่าน</div></th>
                </tr>
                <?php
					$strSQL = "SELECT* FROM tb_member 
								INNER JOIN tb_credit ON tb_member.id = tb_credit.m_id 
								WHERE parent = $_SESSION[userid] LIMIT $start, $per_page";
					$res = $mysqli->query($strSQL);
					
					while($row = $res->fetch_array(MYSQLI_ASSOC))
					{
						
				?>
                		<tr>
                            <td><?php echo $numcount?><div id="nameError"></div></td>
                            <td><?php echo "<strong>".$row['username'].'</strong> ('.$row['name'].')'?></td>
                            <td>
                            	<div class="form-inline">
                            		<div class="form-group">
                                    	<input name="credit_<?php echo $row['id']?>" id="credit_<?php echo $row['id']?>" type="text" class="credit form-control" value="<?php echo $row['credit']?>" maxlength="9" size="12" disabled="disabled"/>
                                        <div id="credit_<?php  echo $row['id'] ?>_error" class="small"></div>
                                 	</div>
                                  	<button type="button" value="<?php echo $row['id'] ?>" class="addcredit btn btn-info btn-xs glyphicon glyphicon-transfer" id="addcredit"></button>
                                    <button type="button" value="<?php echo $row['id'] ?>" class="savecredit btn btn-success btn-xs glyphicon glyphicon-floppy-save" name="savecredit_<?php echo $row['id'] ?>" id="savecredit"></button>
                            	</div>
                            </td>
                            <td><?php echo $row['tell']?></td>
                            <td><?php echo $row['email']?></td>
                            <td align="center"><a data-toggle="modal" href="modal/modal.creditrefund.php" data-target="#terms" class="refund" value="<?php echo $row['id'] ?>">รายละเอียด</a></td>
                            <td><button type="button" value="<?php echo $row['id'] ?>" id="editprofile" class="btn btn-primary btn-xs glyphicon glyphicon-edit" ></button></td>
                            <td align="center"><button type="button" value="<?php echo $row['id'] ?>" id="resetpassword" class="btn btn-danger btn-xs glyphicon glyphicon-lock"></button></td>
                        </tr>
                <?php
						$numcount++;
					}
				?>
             
            </table>
            </form>
            

        </div>
    </div>
</div>
    
    <?php

	/* --------------------------------------------- */
	$query_pag_num = "SELECT COUNT(*) AS count FROM tb_member WHERE parent = $_SESSION[userid] ";
	$result_pag_num = $mysqli->query($query_pag_num);
	
	$row = $result_pag_num->fetch_array(MYSQLI_ASSOC);
	$count = $row['count'];
	$no_of_paginations = ceil($count / $per_page);

	/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	/* ----------------------------------------------------------------------------------------------------------- */
	$msg = "<nav><ul class='pagination'>";
	
	// FOR ENABLING THE FIRST BUTTON
	if ($first_btn && $cur_page > 1) {
		//$msg .= "<li p='1' class='active'>First</li>";
		$msg .= "<li p='1'><a href='#' aria-label='Previous'><span aria-hidden='false'>&laquo;</span></a></li>";
	} else if ($first_btn) {
		//$msg .= "<li p='1' class='inactive'>First</li>";
		$msg .= "<li p='1' class='active'><a href='#' aria-label='Previous'><span aria-hidden='false'>&laquo;</span></a></li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		//$msg .= "<li p='$pre' class='active'>Previous</li>";
		$msg .= "<li p='$pre'><a href='#' aria-label='Previous'><span aria-hidden='false'>&laquo;</span></a></li>";
	} else if ($previous_btn) {
		$msg .= "<li class='active'><a href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
		//$msg .= "<li class='inactive'>Previous</li>";
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
	
		if ($cur_page == $i)
		{
			//$msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
			$msg .= "<li p='$i' class='active'><a href='#'>{$i}</a></li>";
		}
		else
		{
			//$msg .= "<li p='$i' class='active'>{$i}</li>";
			$msg .= "<li p='$i'><a href='#'>{$i}</a></li>";
		}
	}
	
	// TO ENABLE THE NEXT BUTTON
	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		//$msg .= "<li p='$nex' class='active'>Next</li>";
		$msg .= "<li p='$nex'><a href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
	} else if ($next_btn) {
		$msg .= "<li class='inactive'>Next</li>";
	}
	
	// TO ENABLE THE END BUTTON
	if ($last_btn && $cur_page < $no_of_paginations) {
		//$msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
		$msg .= "<li p='$no_of_paginations'><a href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span> </a></li>";
	} else if ($last_btn) {
		//$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
		$msg .= "<li p='$no_of_paginations' class='active'><a href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
	}
	//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
	$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
	$msg = $msg . "</ul>"  . $total_string . "</nav>";  // Content for pagination
	echo $msg;
}
?>
