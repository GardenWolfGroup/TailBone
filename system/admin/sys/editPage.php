<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Cody being even more paranoid
	if(!$allowRequest){
		$_SESSION['MSGBanner'] = 'Unknown error.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//Make sure that there is a user, not one of those URL copiers....
	if(!$loggedin){
		$_SESSION['MSGBanner'] = 'You must be logged in to do that!';
		$_SESSION['MSGType'] = 2;
		header('location:./?admin');
		die();
	}
	
	//Get the pagename and path for writing purposes
	$_POST['pageName'] = strtolower($_POST['pageName']);
	$location = './data/pages/'.$_POST['pageName'].'/';
	
	//Open da page!  And add the new content
	$content = fopen($location.'page.html','w');
	fwrite($content,$_POST['content']);
	fclose($content);
	
	//Check to make sure that it has the new content
	if(file_get_contents($location.'page.html') == $_POST['content']){
		
		//If you wanted to return to the page, this'll show you the way
		if(isset($_POST['goToPage'])){
			header('location: ./?page='.$_POST['pageName']);
			die();
		}
		
		//Otherwise BACK TO THE ADMIN PANEL YOU GO!
		else{
			$_SESSION['MSGBanner'] = 'Successfully edited the page.';
			$_SESSION['MSGType'] = 1;
			header('location:./?admin&page=pages');
			die();
		}
	}
	
	//If this triggered something went kaboom
	else{
		$_SESSION['MSGBanner'] = 'Error, please check permissions.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin&page=pages');
		die();
	}
?>