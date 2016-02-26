<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">ประวัติการใช้งาน</h4>
</div>
<div class="modal-body">

<table class="table table-striped">
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
				WHERE re_to_m_id = $_REQUEST[m_id]";
	
	//echo $strSQL;
	$res = $mysqli->query($strSQL);
	$count = 0; 
	while($row = $res->fetch_array(MYSQLI_ASSOC))
	{
		$count++;
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
	}
?>
</table>
</div>