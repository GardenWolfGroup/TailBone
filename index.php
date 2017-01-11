<?PHP
	//TailBone Version C
	// This software is delievered to you AS IS with NO warrenty.
	// Copyright 2016 Cody Paul Brian
	//
	//
	//
	//
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	ini_set('default_socket_timeout', 20);
	
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
		session_unset();     // unset $_SESSION variable for the run-time
		session_destroy();   // destroy session data in storage
	}
	
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	
	$hosted = false;
	if(file_exists('/var/GWG/webInit.php')){
		require('/var/GWG/webInit.php');
		$hosted = true;
	}
	
	$TB['version'] = 1.02;
	$TB['codeName'] = "Intent Corgi";
	$runningInIndex = true; //Tells scripts that they are running in the index as they should be.
	
	if(file_exists('./data/dataVersion.php')){
		require('./data/dataVersion.php');
		if($dataVersion < $TB['version']){
			$upgrading = true;
			require('./system/upgrader/run.php');
		}
	}else{
		$upgrading = true;
		require('./system/upgrader/run.php');
	}
	
	if(file_exists('installed')){ //checks to make sure TailBone is in fact installed.
		if(isset($_GET['admin'])){ //has the user requested the admin pannel?
			require('./system/admin/run.php'); //Starts the admin file.
		}else{
			require('./system/main/run.php'); //starts the main file.
		}
	}else{ //If TailBone is not installed.
		$installing = true;
		require('./system/installer/run.php'); //Start the installer.
	}
?>
