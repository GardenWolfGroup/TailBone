<?PHP
	
	//Make sure everything is running in the proper place at the proper time and in the proper way
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//See previous comment, a piece of code just in case (paranoid Cody)
	if(!$allowRequest){
		header('location:./?admin&MSGBanner=Unknown error.');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//Makes sure that the user wasn't a URL copying pain in the butt and actually is logged into the system
	if(!$_SESSION['loggedin']){
		header('location:./?admin&MSGBanner=You must be logged in to do that!&MSGType=3');
		die();
	}
	
	$_POST['siteDescription'] = str_replace('"', "'", $_POST['siteDescription']);
	
	if(isset($_POST['construction'])){
		$construction = "true";
	}else{
		$construction = "false";
	}
	
	$data = '
<?PHP
	$settings = array(
		"siteName" => "'.$_POST['siteName'].'",
		"siteDescription" => "'.$_POST['siteDescription'].'",
		"siteKeywords" => "'.$_POST['siteKeywords'].'",
		"siteAuthor" => "'.$_POST['siteAuthor'].'",
		"loginNotice" => "'.$_POST['loginNotice'].'",
		"analyticsCode" => file_get_contents("./data/analyticsCode.php"),
		"footerContent" => file_get_contents("./data/footerContent.php"),
		"adContent" => file_get_contents("./data/adContent.php"),
		"construction" => '.$construction.',
		"four04Message" => "'.$_POST['four04Message'].'",
	);
?>
	';
	
	//Write to the settings file
	$location = './data/settings.php';
	$content = fopen($location, 'w');
	fwrite($content,$data);
	fclose($content);
	
	//Update the footer content
	$location = './data/footerContent.php';
	$content= fopen($location, 'w');
	fwrite($content,$_POST['footerContent']);
	fclose($content);
	
	//The advertisements that everyone loves!
	$location = './data/adContent.php';
	$content= fopen($location, 'w');
	fwrite($content,$_POST['adContent']);
	fclose($content);
	
	//And the analytics update so that Google can get into another part of your life
	$location = './data/analyticsCode.php';
	$content= fopen($location, 'w');
	fwrite($content,$_POST['analyticsCode']);
	fclose($content);
	
	header('location:./?admin&MSGBanner=Successfully edited settings.&page=settings&MSGType=1');
	die();
?>