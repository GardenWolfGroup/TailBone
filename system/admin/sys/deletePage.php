<?PHP
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	if(!$allowRequest){
		header('location:./?admin&MSGBanner=Unknown error.');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	session_start();
	
	//Make sure that the user has been logged in
	if(!$_SESSION['loggedin']){
		header('location:./?admin&MSGBanner=You must be logged in to do that!&MSGType=3');
		die();
	}
	
	//Build the location variable
	$location = './data/pages/'.$_GET['delete'].'/';
	
	//Delete the file and remove the directory
	unlink($location.'page.php');
	rmdir($location);
	
	//If the page doesn't exist anymore, display the success message
	if(!file_exists($location)){
		header('location:./?admin&MSGBanner=Page deleted.&page=pages&MSGType=1');
		die();
	}
	
	//Otherwise something went kaboom
	else{
		header('location:./?admin&MSGBanner=Error! Check perms!&page=pages&MSGType=3');
		die();
	}
?>