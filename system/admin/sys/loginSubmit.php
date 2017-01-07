<?PHP
	
	//Again, make sure it's running on the index file in the root webserver filesystem
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Cody being one of the most paranoid people on earth
	if(!$allowRequest){
		header('location:./?admin&MSGBanner=Unknown error.');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//Switch the user input to lowercase, since that's how the're stored
	$_POST['user'] = strtolower ( $_POST['user'] );
	
	//Make sure the user exists
	if(isset($users[$_POST['user']])){
		
		//Verify the password and let them in!
		if(password_verify($_POST['pass'], $users[$_POST['user']])){
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