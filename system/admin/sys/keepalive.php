<?php
	//makes SURE the browser wasnt being an ass and caching the TRUE.. -_-
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	session_start();
	//looks to see the last activity time.
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
		session_unset();
		session_destroy();
	}
	
	//makes sure the user still exists in the "database"
	if(!isset($users[$_SESSION['user']])){
		echo('false');
		die();
	}
	
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
		if(isset($_SESSION['keepAlive'])){
			//setting the number of times the session was kept alive.
			$_SESSION['keepAlive'] += 1;
		}else{
			$_SESSION['keepAlive'] = 1;
		}
		$_SESSION['loggedin'] = "true";
		//updates the last activity time.
		$_SESSION['LAST_ACTIVITY'] = time();
		echo('true');
		die();
	}else{
		echo('false');
		die();
	}
?>