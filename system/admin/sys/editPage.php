<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Cody being even more paranoid
	if(!$allowRequest){
		header('location:./?admin&MSGBanner=Unknown error.');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//Make sure that there is a user, not one of those URL copiers....
	if(!$_SESSION['loggedin']){
		header('location:./?admin&MSGBanner=You must be logged in to do that!&MSGType=3');
		die();
	}
	
	//Get the pagename and path for writing purposes
	$_POST['pageName'] = strtolower($_POST['pageName']);
	$location = './data/pages/'.$_POST['pageName'].'/';
	
	//Open da page!  And add the new content
	$content = fopen($location.'page.php','w');
	fwrite($content,$_POST['content']);
	fclose($content);
	
	//Check to make sure that it has the new content
	if(file_get_contents($location.'page.php') == $_POST['content']){
		
		//If you wanted to return to the page, this'll show you the way
		if(isset($_POST['goToPage'])){
			header('location: ./?page='.$_POST['pageName']);
			die();
		}
		
		//Otherwise BACK TO THE ADMIN PANEL YOU GO!
		else{
			header('location:./?admin&MSGBanner=Page edited successfully!&page=pages&MSGType=1');
			die();
		}
	}
	
	//If this triggered something went kaboom
	else{
		header('location:./?admin&MSGBanner=Error! Check perms!&MSGType=3');
		die();
	}
?>