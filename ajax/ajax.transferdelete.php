<?php
	session_start();
	include (dirname(__FILE__)."/../class/moneytransfer.php");

	$bankTransfer = new moneyTransfer();

	header("Content-type: application/json");
	echo json_encode($bankTransfer->transfer_delete($_POST['cs_transfer_id']));
?>