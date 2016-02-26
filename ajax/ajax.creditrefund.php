<?php
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
		$count = ($page*$per_page)+1;
?>

<table class="table table-striped input-sm">
	<tr>
    	<th>#</th>
        <th>เอเยนต์</th>
        <th>ประเภท</th>
        <th>จำนวนเงิน</th>
        <th>วันเวลา</th>
        <th>Ip</th>
        <th>จากหน้า</th>
    </tr>
 <?php
 	date_default_timezone_set("Asia/Bangkok");
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../fucntion/convertdatethai.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	$strSQL = "SELECT tb_member.username, tb_refund.* FROM tb_refund 
				INNER JOIN tb_member ON tb_refund.re_from_m_id = tb_member.id 
				WHERE re_to_m_id = $_REQUEST[m_id] LIMIT $start, $per_page";
	
	//echo $strSQL;
	$res = $mysqli->query($strSQL);
	while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		
?>
	<tr>
    	<td><?php echo $count ?></td>
        <td><?php echo $row['username'] ?></td>
        <td><?php echo $row['re_type'] == 1?"ฝาก":"ถอน" ?></td>
        <td><?php echo number_format($row['re_credit'],2,'.',',') ?></td>
        <td><?php echo thai_date_time_short($row['re_datetime']) ?></td>
        <td><?php echo $row['re_IP'] ?></td>
        <td><?php echo $row['re_from_page'] ?></td>
    </tr>
<?php
			$count++;
		}
?>
</table>
<?php

	/* --------------------------------------------- */
	$query_pag_num = "SELECT COUNT(*) AS count FROM tb_refund 
				INNER JOIN tb_member ON tb_refund.re_from_m_id = tb_member.id 
				WHERE re_to_m_id = $_REQUEST[m_id]";
	$result_pag_num = $mysqli->query($query_pag_num);
	
	$row = $result_pag_num->fetch_array(MYSQLI_ASSOC);
	$count = $row['count'];
	if($count > 0)
	{
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
	$msg = "<nav><ul class='pagination pagination-sm'>";
	
	// FOR ENABLING THE FIRST BUTTON
	if ($first_btn && $cur_page > 1) {
		//$msg .= "<li p='1' class='active'>First</li>";
		$msg .= "<li p='1' valueid='$_REQUEST[m_id]' ><a href='#' aria-label='Previous'><span aria-hidden='false'>&laquo;</span></a></li>";
	} else if ($first_btn) {
		//$msg .= "<li p='1' class='inactive'>First</li>";
		$msg .= "<li p='1' valueid='$_REQUEST[m_id]' class='active'><a href='#' aria-label='Previous'><span aria-hidden='false'>&laquo;</span></a></li>";
	}

	// FOR ENABLING THE PREVIOUS BUTTON
	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		//$msg .= "<li p='$pre' class='active'>Previous</li>";
		$msg .= "<li p='$pre' ><a href='#' aria-label='Previous'><span aria-hidden='false'>&laquo;</span></a></li>";
	} else if ($previous_btn) {
		$msg .= "<li class='active'><a href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
		//$msg .= "<li class='inactive'>Previous</li>";
	}
	for ($i = $start_loop; $i <= $end_loop; $i++) {
	
		if ($cur_page == $i)
		{
			//$msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
			$msg .= "<li p='$i' valueid='$_REQUEST[m_id]' class='active'><a href='#'>{$i}</a></li>";
		}
		else
		{
			//$msg .= "<li p='$i' class='active'>{$i}</li>";
			$msg .= "<li p='$i' valueid='$_REQUEST[m_id]'><a href='#'>{$i}</a></li>";
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
		$msg .= "<li p='$no_of_paginations' valueid='$_REQUEST[m_id]' ><a href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span> </a></li>";
	} else if ($last_btn) {
		//$msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
		$msg .= "<li p='$no_of_paginations' class='active' valueid='$_REQUEST[m_id]'><a href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
	}
	//$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
	$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
	$msg = $msg . "</ul>"  . $total_string . "</nav>";  // Content for pagination
	echo $msg;
	}
}
?>