<?php
	session_start();
	if(!isset($dirLock)){
		$dirLock = '../';
	}
	
	$_SESSION['MSGBanner'] = '403, You are not allowed to be there!';
	$_SESSION['MSGType'] = 2;
	
	header('Location: '.$dirLock);
?>