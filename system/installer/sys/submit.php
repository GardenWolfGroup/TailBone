<?PHP
	//The comments with all caps and 3 /'s are due to the angry Cody missing the absent semicolon on line 11 (laugh at him!)
	if(isset($runningInIndex) && isset($installing) && $installing == true){
		//carry on
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	///START WRITING USER.
	$currentFile = fopen('./data/users.php', 'w');
	$user = strtolower($_POST['adminUsername']);
	
	//Make a more complex hashing salt than default
	$options = [
		'cost' => 12,
	];
	//Hash the password so that people can't decrypt it and is more secure
	$pass = password_hash($_POST['adminPassword'],PASSWORD_BCRYPT, $options);
	
	//Make the fields php file compatible
	$pass = "'".$pass."'";
	$user = "'".$user."'";
	
	//Array DUMP
	$write='<?PHP
	$users=array(

		'.$user.' => '.$pass.',
	);
?>
	';
	
	//Write it and leave
	fwrite($currentFile, $write);
	fclose($currentFile);
	
	///START WRITING SETTINGS.
	$currentFile = fopen('./data/settings.php', 'w');
	$write='
<?PHP
	$settings = array(
		"siteName" => "'.$_POST['siteName'].'",
		"siteDescription" => "",
		"siteKeywords" => "",
		"siteAuthor" => "'.$_POST['siteAuthor'].'",
		"loginNotice" => "Notice: This is a private server meant to only be accessed by authorized persons, if you are not authorized to be here, please kindly leave.",
		"analyticsCode" => file_get_contents("./data/analyticsCode.php"),
		"footerContent" => file_get_contents("./data/footerContent.php"),
		"adContent" => file_get_contents("./data/adContent.php"),
		"four04Message" => "Uh oh, looks like that page has gone missing or has been deleted.",
		"construction" => "false",
	);
?>
	';
	fwrite($currentFile, $write);
	fclose($currentFile);
		
	//Clean up the installer
	if(!$hosted){
		cleanDir("./system/installer/");
		rmdir("./system/installer/");
	}
	
	//Recursion is nice for dirs
	function cleanDir($dir){
		
		//Get the files and so on
		$files = scandir($dir);
		
		//Loop through em
		foreach($files as $i){
			
			//Ignore the parent and current directory
			if($i != "." && $i != ".."){
				
				//Build the filepath
				$i = $dir.$i;
				
				//Go back to start if it's a directory
				if(is_dir($i)){
					//Clean it and delete it
					cleanDir($i."/");
					rmdir($i);
				}
				//Otherwise delete the file
				else{
					unlink($i);
				}
			}
		}
	}
	
	///MAKE INSTALLED FILE.
	$currentFile = fopen('./installed', 'w');
	$write = "TailBone is installed.";
	fwrite($currentFile, $write);
	fclose($currentFile);
	
	header('location: ./');
?>