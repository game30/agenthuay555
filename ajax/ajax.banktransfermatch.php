<?php
	session_start();
	include (dirname(__FILE__)."/../class/moneytransfer.php");
	$bankTransfer = new moneyTransfer();

	header("Content-type: application/json");
	echo json_encode($bankTransfer->transfer_match($_POST['bk_transfer_id'], $_POST['cs_transfer_id'], $_POST['bank_amount'], $_POST['customer_id']));
?>