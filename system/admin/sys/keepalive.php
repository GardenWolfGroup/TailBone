<?php
	//makes SURE the browser wasnt being an ass and caching the TRUE.. -_-
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	if($loggedin){
		echo('true');
		die();
	}else{
		echo('false');
		die();
	}
?>