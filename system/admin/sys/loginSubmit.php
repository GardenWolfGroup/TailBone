<?PHP
	//Again, make sure it's running on the index file in the root webserver filesystem
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Cody being one of the most paranoid people on earth
	if(!$allowRequest){
		$_SESSION['MSGBanner'] = 'Unknown error.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	require('./data/users.php');
	if($hosted){
		global $serverVars;
		$users[$serverVars['serverAdmin']] = $serverVars['serverAdminPass'];
	}
	
	//Switch the user input to lowercase, since that's how the're stored
	$_POST['user'] = strtolower ( $_POST['user'] );
	
	//Make sure the user exists
	if(isset($users[$_POST['user']])){
		
		//Verify the password and let them in!
		if(password_verify($_POST['pass'], $users[$_POST['user']])){
			session_unset();
			session_destroy();
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['user'] = $_POST['user'];
			header( 'Location: ./index.php?admin' ) ;
			die();
		}
		
		//No, the error isn't Internet Protocol, it's an invalid password!
		else{
			header( 'Location: ./index.php?admin&error=IP&user='.$_POST['user'] ) ;
			die();
		}
	}
	
	//If the user doesn't exist, then tell them about their newfound problem
	else{
		header( 'Location: ./index.php?admin&error=NEU' ) ;
		die();
	}
?>