<?PHP
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	if(!$allowRequest){
		$_SESSION['MSGBanner'] = 'Unknown error.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	session_start();
	
	//Make sure that the user has been logged in
	if(!$loggedin){
		$_SESSION['MSGBanner'] = 'You must be logged in to do that!';
		$_SESSION['MSGType'] = 2;
		header('location:./?admin');
		die();
	}
	
	//Build the location variable
	$location = './data/pages/'.$_GET['delete'].'/';
	
	//Delete the file and remove the directory
	unlink($location.'page.php');
	rmdir($location);
	
	//If the page doesn't exist anymore, display the success message
	if(!file_exists($location)){
		$_SESSION['MSGBanner'] = 'Successfully deleted the page.';
		$_SESSION['MSGType'] = 1;
		header('location:./?admin&page=pages');
		die();
	}
	
	//Otherwise something went kaboom
	else{
		$_SESSION['MSGBanner'] = 'Error, please check permissions.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin&page=pages');
		die();
	}
?>