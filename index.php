<?PHP
	// TailBone
	// This software is delivered to you AS IS with NO warranty.
	// Copyright 2016 Cody Paul Brian
	//
	//
	//
	//
	if(isset($_GET['debug'])){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}

	$hosted = false;
	if(file_exists('/var/GWG/webInit.php')){
		require('/var/GWG/webInit.php');
		$hosted = true;
	}
	
	$loggedin = false;
	
	function checkLogin(){
		session_start();
		
		global $loggedin;
		
		if(isset($_GET['logout'])){
			session_unset();
			session_destroy();
		}
		
		global $hosted;
		require('./data/users.php');
		if($hosted){
			global $serverVars;
			$users[$serverVars['serverAdmin']] = $serverVars['serverAdminPass'];
		}
		if(isset($_SESSION['loggedin'])){
			if(isset($_SESSION['user'])){
				if(isset($users[$_SESSION['user']])){
					return true;
					$loggedin = true;
					$_SESSION['keepAlive'] += 1;
				}else{
					session_unset();
					session_destroy();
					session_start();
					return false;
				}
			}else{
				session_unset();
				session_destroy();
				session_start();
				return false;
			}
		}else{
			return false;
		}
	}
	
	function getUsers(){
		global $loggedin;
		if($loggedin){
			require('./data/users.php');
			$return = array();
			foreach($users as $userP1 => $userP2){ //bit of a hack..
				array_push($return, $userP1);
			}
			return $return;
		}
	}
	
	$TB['version'] = 2.3;
	$TB['codeName'] = "Flying Penguin";
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
	
	//A coffee maker was killed in the making of the programme.
	
	if(file_exists('installed')){ //checks to make sure TailBone is in fact installed.
		if(isset($_GET['admin'])){ //has the user requested the admin panel?
			require('./system/admin/run.php'); //Starts the admin file.
		}else{
			require('./system/main/run.php'); //starts the main file.
		}
	}else{ //If TailBone is not installed.
		$installing = true;
		require('./system/installer/run.php'); //Start the installer.
	}
?>