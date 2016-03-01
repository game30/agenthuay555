<?php
session_start();
include (dirname(__FILE__)."/../class/moneytransfer.php");
$bankTransfer = new moneyTransfer(); 
$bankTransferData = $bankTransfer->transfer_bank_by_id($_POST['bankID'], $_POST['cs_transfer_id']);
if ( count($bankTransferData) > 0 ){
	echo '<p>'.$bankTransferData[0]['bankname'].' '.$bankTransferData[0]['bankaccount'].'</p>';
	foreach ( $bankTransferData as $bankValue ){
	echo '<div class="radio"><label>
	  <input type="radio" name="bankoptions" class="bank_transfer" data-bank="'.$bankValue['bank_id'].'" data-uid="'.$bankValue['m_id'].'" data-bank_amount="'.$bankValue['bk_transfer_amount'].'" data-transferid="'.$bankValue['bk_transfer_id'].'" id="bankRadio'.$bankValue['bk_transfer_id'].'" value="'.$bankValue['bk_transfer_id'].'">  จำนวน '.number_format($bankValue['bk_transfer_amount'],2,'.',',').' บาท '.$bankValue['bk_transfer_date'].'
	</label></div>';
	}
} else { echo "ไม่มีรายการ"; }

?>