<?php
	if(isset($runningInIndex) && $runningInIndex == true && isset($upgrading) && $upgrading == true){
		
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	//////////UPGRADE THINGS GO HERE IF CONFIGS NEED CHANGING///////////////

	//dont change this. It is required.
	$dataVersionFile = fopen('./data/dataVersion.php', 'w');
	fwrite($dataVersionFile, "<?php\n\$dataVersion=".$TB['version'].";\n?>");
	fclose($dataVersionFile);
	
	sleep(2); //HACKHACKHACK
	
	header('location: ./');
?>
