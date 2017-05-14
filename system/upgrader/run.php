<?php
	if(isset($runningInIndex) && $runningInIndex == true && isset($upgrading) && $upgrading == true){
		
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	//////////UPGRADE THINGS GO HERE IF CONFIGS NEED CHANGING///////////////

		$pages = scandir("./data/pages");
		
		foreach($pages as $page){
			$page = "./data/pages/$page";
			rename($page."/page.php", $page."/page.html");
		}
		
		$footerContent = file_get_contents("./data/footerContent.php");
		$footerContent = htmlspecialchars($footerContent);
		
		require("./data/settings.php");
		
		copy("./data/settings.php", "./data/settings.php.old");
		
		$data = '
	<?PHP
		$settings = array(
			"siteName" => "'.$settings['siteName'].'",
			"siteDescription" => "'.$settings['siteDescription'].'",
			"siteKeywords" => "'.$settings['siteKeywords'].'",
			"siteAuthor" => "'.$settings['siteAuthor'].'",
			"loginNotice" => "'.$settings['loginNotice'].'",
			"analyticsCode" => file_get_contents("./data/analyticsCode.php"),
			"footerContent" => "'.$footerContent.'",
			"adContent" => file_get_contents("./data/adContent.php"),
			"construction" => '.$settings['construction'].',
			"four04Message" => "'.$settings['four04Message'].'",
		);
	?>
		';
		
		unlink("./data/footerContent.php");
	
	//Write to the settings file
	$location = './data/settings.php';
	$content = fopen($location, 'w');
	fwrite($content,$data);
	fclose($content);

	//dont change this. It is required.
	$dataVersionFile = fopen('./data/dataVersion.php', 'w');
	fwrite($dataVersionFile, "<?php\n\$dataVersion=".$TB['version'].";\n?>");
	fclose($dataVersionFile);
	
	sleep(2); //HACKHACKHACK
	
	header('location: ./');
?>