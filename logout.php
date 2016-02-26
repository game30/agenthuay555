<?php 
	session_start();
	session_destroy();
	$arrVersion = explode('.', phpversion());
	$version = $arrVersion[0].'.'.$arrVersion[1];
	header( 'Location: login.php' ) ;
?>