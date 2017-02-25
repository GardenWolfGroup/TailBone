<?PHP
	//Cody is bloody paranoid.

	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	if(isset($installing)){
		if(isset($_GET['submitInstall'])){
			require('./system/installer/sys/submit.php');
		}else{
			require('./system/installer/sys/install.php');
		}
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
?>