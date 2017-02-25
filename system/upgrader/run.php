<?php
	if(isset($runningInIndex) && $runningInIndex == true && isset($upgrading) && $upgrading == true){
		
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	//////////UPGRADE THINGS GO HERE IF CONFIGS NEED CHANGING///////////////

	require('./data/theme.php');
	
	$write='
<?PHP 
	$theme = array(
		"bodyBackground" => "#'.$theme["bodyBackground"].'",
		"bodyBackgroundImage" => "'.$theme["bodyBackgroundImage"].'",
		"bodyBackgroundRepeat" => "'.$theme["bodyBackgroundRepeat"].'",
		"navHighlightColour" => "#'.$theme["navHighlightColour"].'",
		"contentBackground" => "#'.$theme["contentBackground"].'",
		"contentText" => "#'.$theme["contentText"].'",
		"topperBackground" => "#'.$theme["topperBackground"].'",
		"topperText" => "#'.$theme["topperText"].'",
		"enderBackground" => "#'.$theme["enderBackground"].'",
		"navBackground" => "#'.$theme["navBackground"].'",
		"navText" => "#'.$theme["navText"].'",
		"fontFamily" => "'.$theme["fontFamily"].'",
		"customFont" => "'.$theme['customFont'].'",
	);
?>
	';
	
	//Get the config file and write the new stuff to it
	$location = './data/theme.php';
	$content = fopen($location,'w');
	fwrite($content,$write);
	fclose($content);


	//dont change this. It is required.
	$dataVersionFile = fopen('./data/dataVersion.php', 'w');
	fwrite($dataVersionFile, "<?php\n\$dataVersion=".$TB['version'].";\n?>");
	fclose($dataVersionFile);
	
	sleep(2); //HACKHACKHACK
	
	header('location: ./');
?>