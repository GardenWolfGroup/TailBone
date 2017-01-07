<?PHP
	//Make sure it's running off index.php in the root webserver filesystem
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Cody being the most paranoid person on the planet
	if(!$allowRequest){
		header('location:./?admin&MSGBanner=Unknown error.');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//Make sure the user is logged in
	if(!$_SESSION['loggedin']){
		header('location:./?admin&MSGBanner=You must be logged in to do that!&MSGType=3');
		die();
	}
	
	
	//Clean up the input
	$_POST['pageName'] = strtolower($_POST['pageName']);
	$_POST['pageName'] = str_replace(" ", "_", $_POST['pageName']);
	
	//Build the location var
	$location = './data/pages/'.$_POST['pageName'].'/';
	
	//If it exists, yell at them
	if(file_exists($location)){
		header('location:./?admin&page=pages&MSGBanner=Page already exists!&MSGType=2');
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
			header('location:./?admin&page=pages&MSGBanner=Success!&MSGType=1');
			die();
		}
		
		//Otherwise, CHECK YOUR PERMS!
		else{
			header('location:./?admin&page=pages&MSGBanner=Error! Check perms!&MSGType=3');
			die();
		}
	}
?>
