<?php
	if(isset($runningInIndex) && $runningInIndex == true && isset($upgrading) && $upgrading == true){
		
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	//////////UPGRADE THINGS GO HERE IF CONFIGS NEED CHANGING///////////////
	// Starts here{
	
	require('./data/colours.php');
	$data="<?php\n\$theme = array(";
	
	foreach($themeColours as $item => $value){
		$data = $data."'".$item."' => '".$value."',\n";
	}
	
	$data = $data.");";
	
	$file = fopen('./data/theme.php','w');
	fwrite($file,$data);
	fclose($file);
	
	unlink("./data/colours.php");
	
	// end}
	//dont change this. It is required.
	$dataVersionFile = fopen('./data/dataVersion.php', 'w');
	fwrite($dataVersionFile, "<?php\n\$dataVersion=".$TB['version'].";\n?>");
	fclose($dataVersionFile);
	
	sleep(2); //HACKHACKHACK
	
	header('location: ./');
?>