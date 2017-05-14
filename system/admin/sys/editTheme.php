<?PHP
	//Validate the running 
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
	
	if(!$loggedin){
		$_SESSION['MSGBanner'] = 'You must be logged in to do that!';
		$_SESSION['MSGType'] = 2;
		header('location:./?admin');
		die();
	}
	
	$write='
<?PHP 
	$theme = array(
		\'bodyBackground\' => \'#'.addslashes(htmlspecialchars($_POST['bodyBackground'])).'\',
		\'bodyBackgroundImage\' => \''.addslashes(htmlspecialchars($_POST['bodyBackgroundImage'])).'\',
		\'bodyBackgroundRepeat\' => \''.addslashes(htmlspecialchars($_POST['bodyBackgroundRepeat'])).'\',
		\'navHighlightColour\' => \'#'.addslashes(htmlspecialchars($_POST['navHighlightColour'])).'\',
		\'contentBackground\' => \'#'.addslashes(htmlspecialchars($_POST['contentBackground'])).'\',
		\'contentText\' => \'#'.addslashes(htmlspecialchars($_POST['contentText'])).'\',
		\'topperBackground\' => \'#'.addslashes(htmlspecialchars($_POST['topperBackground'])).'\',
		\'topperText\' => \'#'.addslashes(htmlspecialchars($_POST['topperText'])).'\',
		\'enderBackground\' => \'#'.addslashes(htmlspecialchars($_POST['enderBackground'])).'\',
		\'navBackground\' => \'#'.addslashes(htmlspecialchars($_POST['navBackground'])).'\',
		\'navText\' => \'#'.addslashes(htmlspecialchars($_POST['navText'])).'\',
		\'fontFamily\' => \''.addslashes(htmlspecialchars($_POST['fontFamily'])).'\',
		\'customFont\' => \''.addslashes(htmlspecialchars($_POST['customFont'])).'\',
	);
?>
	';
	
	//Get the config file and write the new stuff to it
	$location = './data/theme.php';
	$content = fopen($location,'w');
	fwrite($content,$write);
	fclose($content);
	
	//Grab the contents of the (hopefully) newly written file
	$check = file_get_contents($location);
	sleep(2); //Avoids a bug in PHP
	
	//Make sure it is what we set it to, otherwise KABOOM!
	if($check != $write){
		$_SESSION['MSGBanner'] = 'Error editing theme. Please check permissions.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin&page=theme');
		die();
	}
	
	//Write to the custom CSS file
	$write=$_POST['customCSS'];
	$file = fopen('./data/custom.css', 'w');
	fwrite($file, $write);
	fclose($file);
	
	//And make sure that the content we sent has been written
	$check = file_get_contents('./data/custom.css');
	if($check != $write){
		$_SESSION['MSGBanner'] = 'Error editing theme. Please check permissions.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin&page=theme');
		die();
	}
	
	//Otherwise everything's fine!
	$_SESSION['MSGBanner'] = 'Successfully edited theme.';
		$_SESSION['MSGType'] = 1;
		header('location:./?admin&page=theme');
	die();
?>