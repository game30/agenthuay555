<?php
  session_start();
  error_reporting(E_ALL);

  include("class/moneytransfer.php");
  if ( !isset($site_url) ){
   include (dirname(__FILE__)."/config/config.inc.php");
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

<style>
  .h-container{
    width:960px;
  }
  .h-row{
    margin-top: 10px;
  }

  .table>tbody>tr>td{
    vertical-align: middle;
  }
</style>
<script src="js/transfermatch.js"></script>
</head>

<body>
<div class="container-fluid h-container">
  <div class="panel panel-default">
    <div class="panel-heading">ดำเนินการโอนเงิน</div>
    <div class="panel-body">

      <form name="transfer_process" id="transfer_process" action="#" method="post">
        <div class="row h-row">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">รายการลูกค้าโอนเงิน</div>
              <div class="panel-body">
                <table class="table table-condensed table-hover">
                <?php 

                 $customerTransfer = new moneyTransfer(); 
                 $customerTransferData = $customerTransfer->transfer_customer_list();
                  foreach ( $customerTransferData as $customerValue ){
                    echo '<tr>';
                    echo '<td>';
                    echo '<div class="radio"><label>';
                    echo '
                      <input type="radio" name="customeroptions" class="cs_transfer" data-bank="'.$customerValue['bank_id'].'" data-uid="'.$customerValue['m_id'].'" data-transferid="'.$customerValue['cs_transfer_id'].'" id="customerRadio'.$customerValue['cs_transfer_id'].'" value="'.$customerValue['cs_transfer_id'].'"> ';
                    echo $customerValue['username'].' - '.number_format($customerValue['cs_transfer_amount'],2,'.',',').' บาท<br /> '.$customerValue['b_name'].' - '.$customerValue['b_number'].'<br />'.$customerValue['cs_transfer_date']; 
                    echo '</label>
                    </div>';
                    echo '</td>';
                    echo '<td>';
                    echo '<a data-toggle="modal" data-target="#myModal" role="button" title="รายละเอียด" data-content="รหัสสมาชิก : '.$customerValue['username'].' <br>จำนวน : '.number_format($customerValue['cs_transfer_amount'],2,'.',',').' บาท<br /> 
                     ธนาคาร: '.$customerValue['b_name'].'<br />เลขที่บัญชี: '.$customerValue['b_number'].' <br />เมื่อวันที่ : '.$customerValue['cs_transfer_date'].'" data-picture="'.$slipPictureURL.$customerValue['cs_tranfer_file'].'"><span class="glyphicon glyphicon-list-alt"></span></a>';
                    echo ' <a data-toggle="modal" data-target="#myConfirm" role="button" title="ยืนยันการลบ" data-id="'.$customerValue['cs_transfer_id'].'" data-content="รหัสสมาชิก : '.$customerValue['username'].' <br>จำนวน : '.number_format($customerValue['cs_transfer_amount'],2,'.',',').' บาท<br /> 
                     ธนาคาร: '.$customerValue['b_name'].'<br />เลขที่บัญชี: '.$customerValue['b_number'].' <br />เมื่อวันที่ : '.$customerValue['cs_transfer_date'].'"><span class="glyphicon glyphicon-trash"></span></a>';
                    echo '</td>';
                    echo '</tr>';
                  }
                ?>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">รายการธนาคาร</div>
              <div class="panel-body" id="banktransfer">
                
              </div>
            </div>
          </div>
        </div>
        <div style="text-align: center;"><button type="button" id="submitForm" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-danger">Reset</button></div>
      </div>
    </form>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">รายละเอียด</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myConfirm" tabindex="-2" role="dialog" aria-labelledby="myConfirmLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myConfirmLabel">ยืนยันการลบข้อมูล</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary confirm">ลบ</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>