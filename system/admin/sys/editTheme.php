<?PHP
	//Validate the running 
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	if(!$allowRequest){
		header('location:./?admin&MSGBanner=Unknown error.');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	if(!$_SESSION['loggedin']){
		header('location:./?admin&MSGBanner=You must be logged in to do that!&MSGType=3');
		die();
	}
	
	$write='
<?PHP 
	$themeColours = array(
		"bodyBackground" => "'.$_POST["bodyBackground"].'",
		"bodyBackgroundImage" => "'.$_POST["bodyBackgroundImage"].'",
		"bodyBackgroundRepeat" => "'.$_POST["bodyBackgroundRepeat"].'",
		"navHighlightColour" => "'.$_POST["navHighlightColour"].'",
		"contentBackground" => "'.$_POST["contentBackground"].'",
		"contentText" => "'.$_POST["contentText"].'",
		"topperBackground" => "'.$_POST["topperBackground"].'",
		"topperText" => "'.$_POST["topperText"].'",
		"enderBackground" => "'.$_POST["enderBackground"].'",
		"navBackground" => "'.$_POST["navBackground"].'",
		"navText" => "'.$_POST["navText"].'",
		"fontFamily" => "'.$_POST["fontFamily"].'",
		"customFont" => "'.$_POST['customFont'].'",
	);
?>
	';
	
	//Get the config file and write the new stuff to it
	$location = './data/colours.php';
	$content = fopen($location,'w');
	fwrite($content,$write);
	fclose($content);
	
	//Grab the contents of the (hopefully) newly written file
	$check = file_get_contents($location);
	sleep(2); //Avoids a bug in PHP
	
	//Make sure it is what we set it to, otherwise KABOOM!
	if($check != $write){
		header('location:./?admin&page=theme&MSGBanner=Error editing theme.&MSGType=3');
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
		header('location:./?admin&page=theme&MSGBanner=Error editing theme.&MSGType=3');
		die();
	}
	
	//Otherwise everything's fine!
	header('location:./?admin&page=theme&MSGBanner=Successfully edited theme.&MSGType=1');
	die();
?>