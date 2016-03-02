<?php
	session_start(); 
	include (dirname(__FILE__)."/../config/config_db.php");
	include (dirname(__FILE__)."/../config/config.inc.php");
	
	$dbconn = new connect_db;
	$mysqli = $dbconn->conn();
	
	$lot_number = explode('-',$_REQUEST['lot_number']);
?>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#lottype1" aria-controls="home" role="tab" data-toggle="tab">6 ตัว</a></li>
<li role="presentation"><a href="#lottype2" aria-controls="profile" role="tab" data-toggle="tab">5 ตัว</a></li>
<li role="presentation"><a href="#lottype3" aria-controls="messages" role="tab" data-toggle="tab">4 ตัวเต็ง</a></li>
<li role="presentation"><a href="#lottype4" aria-controls="settings" role="tab" data-toggle="tab">4 ตัวโต๊ด</a></li>
<li role="presentation"><a href="#lottype5" aria-controls="settings" role="tab" data-toggle="tab">3 ตัวบนหน้าตรง</a></li>
<li role="presentation"><a href="#lottype6" aria-controls="settings" role="tab" data-toggle="tab">3 ตัวบนหน้าโต๊ด</a></li>
<li role="presentation"><a href="#lottype7" aria-controls="settings" role="tab" data-toggle="tab">3 ตัวบนหลังตรง</a></li>
<li role="presentation"><a href="#lottype8" aria-controls="settings" role="tab" data-toggle="tab">3 ตัวบนหลังโต๊ด</a></li>
<li role="presentation"><a href="#lottype9" aria-controls="settings" role="tab" data-toggle="tab">3 ตัวล่าง</a></li>
<li role="presentation"><a href="#lottype10" aria-controls="settings" role="tab" data-toggle="tab">2 ตัวบนตรง</a></li>
<li role="presentation"><a href="#lottype11" aria-controls="settings" role="tab" data-toggle="tab">2 ตัวบนโต๊ด</a></li>
<li role="presentation"><a href="#lottype12" aria-controls="settings" role="tab" data-toggle="tab">2 ตัวล่างตรง</a></li>
<li role="presentation"><a href="#lottype13" aria-controls="settings" role="tab" data-toggle="tab">2 ตัวล่างโต๊ด</a></li>
<li role="presentation"><a href="#lottype14" aria-controls="settings" role="tab" data-toggle="tab">1 ตัววิ่งบน</a></li>
<li role="presentation"><a href="#lottype15" aria-controls="settings" role="tab" data-toggle="tab">1 ตัววิ่งล่าง</a></li>
</ul>
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="lottype1">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 1 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res = $mysqli->query($strSQL);
		//echo $strSQL;	
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			
			$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
						INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
						INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
						WHERE tb_bill.lot_type_id = 1 
						AND bill_number = '$row[lot_result]' 
						AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
						AND bill_status = 0 GROUP BY tb_bill.m_id ";
			$res = $mysqli->query($strSQL);
			//echo $strSQL;
			$numrow = $res->num_rows;	
			$count = 1;
			?>
			<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>เลข</th>
					<th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
				</tr>
			<?php
			while($row = $res->fetch_array(MYSQLI_ASSOC))
			{
			?>
				<tr>
					<td><?php echo $count ?></td>
					<td><?php echo $row['bill_number'] ?></td>
					<td><?php echo $row['pay'] ?></td>
                    <td><?php echo $row['lot_type_pay'] ?></td>
					<td><?php echo $row['username'] ?></td>
					<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
				</tr>
			<?php
				$count++;
			}
			?>
    		</table>
    <?php
		}
	?>
    
    
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype2">
    	<?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 2 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res = $mysqli->query($strSQL);
		//echo $strSQL;	
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			
			$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
						INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
						INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
						WHERE tb_bill.lot_type_id = 2 
						AND bill_number = '$row[lot_result]' 
						AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
						AND bill_status = 0 GROUP BY tb_bill.m_id ";
			$res = $mysqli->query($strSQL);
			//echo $strSQL;
			$numrow = $res->num_rows;	
			$count = 1;
			?>
			<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>เลข</th>
					<th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
				</tr>
			<?php
			while($row = $res->fetch_array(MYSQLI_ASSOC))
			{
			?>
				<tr>
					<td><?php echo $count ?></td>
					<td><?php echo $row['bill_number'] ?></td>
					<td><?php echo $row['pay'] ?></td>
                    <td><?php echo $row['lot_type_pay'] ?></td>
					<td><?php echo $row['username'] ?></td>
					<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
				</tr>
			<?php
				$count++;
			}
			?>
    		</table>
    <?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype3">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 3 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res = $mysqli->query($strSQL);
		//echo $strSQL;	
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			
			$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
						INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
						INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
						WHERE tb_bill.lot_type_id = 3 
						AND bill_number = '$row[lot_result]' 
						AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
						AND bill_status = 0 GROUP BY tb_bill.m_id ";
			$res = $mysqli->query($strSQL);
			//echo $strSQL;
			$numrow = $res->num_rows;	
			$count = 1;
			?>
			<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>เลข</th>
					<th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
				</tr>
			<?php
			while($row = $res->fetch_array(MYSQLI_ASSOC))
			{
			?>
				<tr>
					<td><?php echo $count ?></td>
					<td><?php echo $row['bill_number'] ?></td>
					<td><?php echo $row['pay'] ?></td>
                    <td><?php echo $row['lot_type_pay'] ?></td>
					<td><?php echo $row['username'] ?></td>
					<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
				</tr>
			<?php
				$count++;
			}
			?>
    		</table>
    <?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype4">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 4 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 4 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
				
					
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype5">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 5 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res = $mysqli->query($strSQL);
		//echo $strSQL;	
		$count = 1;
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			
			$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
						INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
						INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
						WHERE tb_bill.lot_type_id = 5 
						AND bill_number = '$row[lot_result]' 
						AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
						AND bill_status = 0 GROUP BY tb_bill.m_id ";
			$res = $mysqli->query($strSQL);
			//echo $strSQL;
			$numrow = $res->num_rows;	
			?>
			<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>เลข</th>
					<th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
				</tr>
			<?php
			while($row = $res->fetch_array(MYSQLI_ASSOC))
			{
			?>
				<tr>
					<td><?php echo $count ?></td>
					<td><?php echo $row['bill_number'] ?></td>
					<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
					<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
				</tr>
			<?php
				$count++;
			}
			?>
    		</table>
    <?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype6">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 6 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 6 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
				
					
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype7">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 7 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res = $mysqli->query($strSQL);
		//echo $strSQL;	
		$count = 1;
		if($res->num_rows > 0)
		{
			$row = $res->fetch_array(MYSQLI_ASSOC);
			
			$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
						INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
						INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
						WHERE tb_bill.lot_type_id = 7 
						AND bill_number = '$row[lot_result]' 
						AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
						AND bill_status = 0 GROUP BY tb_bill.m_id ";
			$res = $mysqli->query($strSQL);
			//echo $strSQL;
			$numrow = $res->num_rows;	
			?>
			<table class="table table-striped">
				<tr>
					<th>#</th>
					<th>เลข</th>
					<th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
				</tr>
			<?php
			while($row = $res->fetch_array(MYSQLI_ASSOC))
			{
			?>
				<tr>
					<td><?php echo $count ?></td>
					<td><?php echo $row['bill_number'] ?></td>
					<td><?php echo $row['pay'] ?></td>
                    <td><?php echo $row['lot_type_pay'] ?></td>
					<td><?php echo $row['username'] ?></td>
					<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
				</tr>
			<?php
				$count++;
			}
			?>
    		</table>
    <?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype8">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 8 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 8 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
				
					
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype9">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 9 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 9 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype10">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 10 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 10 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype11">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 11 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 11 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype12">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 12 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 12 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype13">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 13 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 13 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype14">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 14 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 14 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
    <div role="tabpanel" class="tab-pane" id="lottype15">
    <?php
		$strSQL = "SELECT * FROM tb_lottery_result WHERE lot_type_id = 15 AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."'";
		$res_reuslt = $mysqli->query($strSQL);
		//echo $strSQL.'<br>';	
		$lot_result_number = "";
		if($res_reuslt->num_rows > 0)
		{
			$count = 1;
			?>
            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>เลข</th>
                    <th>ยอดแทง</th>
                    <th>จ่าย</th>
                    <th>รหัสผู้ใช้</th>
					<th>ยอดได้รวม</th>
                </tr>
            <?php
			while($row_reuslt = $res_reuslt->fetch_array(MYSQLI_ASSOC))
			{
				$strSQL = "SELECT *,sum(bill_bet) as pay FROM tb_bill 
							INNER JOIN tb_member ON tb_member.id = tb_bill.m_id 
							INNER JOIN tb_lottery_type ON tb_lottery_type.lot_type_id = tb_bill.lot_type_id 
							WHERE tb_bill.lot_type_id = 15 
							AND bill_number = '$row_reuslt[lot_result]' 
							AND lot_number = '".$lot_number[0].$lot_number[1].$lot_number[2]."' 
							AND bill_status = 0 GROUP BY tb_bill.m_id ";
				$res = $mysqli->query($strSQL);
				//echo $strSQL.'<br>';
				$numrow = $res->num_rows;	
				
				while($row = $res->fetch_array(MYSQLI_ASSOC))
				{
				?>
					<tr>
						<td><?php echo $count ?></td>
						<td><?php echo $row['bill_number'] ?></td>
						<td><?php echo $row['pay'] ?></td>
                        <td><?php echo $row['lot_type_pay'] ?></td>
						<td><?php echo $row['username'] ?></td>
						<td><?php echo number_format(($row['pay']*$row['lot_type_pay']),2,'.',',') ?></td>
					</tr>
				<?php
					$count++;
				}
			}
			?>
				</table>
		<?php
		}
	?>
    </div>
</div>