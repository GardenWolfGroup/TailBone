<?PHP
	//Make sure it's running off index.php in the root webserver filesystem
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Cody being the most paranoid person on the planet
	if(!$allowRequest){
		$_SESSION['MSGBanner'] = 'Unknown error.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//Make sure the user is logged in
	if(!$loggedin){
		$_SESSION['MSGBanner'] = 'You must be logged in to do that!';
		$_SESSION['MSGType'] = 2;
		header('location:./?admin');
		die();
	}
	
	
	//Clean up the input
	$_POST['pageName'] = strtolower($_POST['pageName']);
	$_POST['pageName'] = str_replace(" ", "_", $_POST['pageName']);
	
	//Build the location var
	$location = './data/pages/'.$_POST['pageName'].'/';
	
	//If it exists, yell at them
	if(file_exists($location)){
		$_SESSION['MSGBanner'] = 'Page already exists!';
		$_SESSION['MSGType'] = 2;
		header('location:./?admin&page=pages');
		die();
	}
	
	//Otherwise make it!
	else{
		mkdir($location);
		$content = fopen($location.'page.php','w');
		fwrite($content,$_POST['content']);
		fclose($content);
		
		//Check to make sure that it wrote to the filesystem
		if(file_exists($location)){
			$_SESSION['MSGBanner'] = 'Created page!';
			$_SESSION['MSGType'] = 1;
			header('location:./?admin&page=pages');
			die();
		}
		
		//Otherwise, CHECK YOUR PERMS!
		else{
			$_SESSION['MSGBanner'] = 'Error, please check your permissions.';
			$_SESSION['MSGType'] = 2;
			header('location:./?admin&page=pages');
			die();
		}
	}
?>
