<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//checks if the server is hosting VIA https
	if(isset($_SERVER['HTTPS'])){
		if(!$_SERVER['HTTPS'] == 'on'){
			echo('<script>notification("Security alert","You are not using https! It is recommended that you do for your own security.",false);</script>');
		}
	}else{
		echo('<script>notification("Security alert","You are not using https! It is recommended that you do for your own security.",false);</script>');
	}
	
	//checks to see if the server is on a server whose purpose is to host TailBone sites.
	if($hosted){
		//shows the server name and ID at the bottom of the page.
		$extraContnet = '<p>Server name: '.$serverVars['serverName'].'.<br>Server ID: '.$serverVars['serverID'].'.<br>Server admin: '.$serverVars['serverAdminEmail'].'</p>';
	}else{
		//Just here to avoid some errors. HACK HACK HACK
		$extraContnet = '';
	}
	
	/* Sets the data of the page that will be echoed in HTML later. Sets the version for the
	 * TailBone Board via JS and shows the user his or her name. No, I am not including Tumblr genders here.
	 */
  $homeContent = '
	<script>
		var myVersion = '.$TB['version'].';
	</script>
  <div style="text-align:center;">
    <h2>Welcome back, '.ucfirst($_SESSION['user']).'.</h2>
		<script src="//tb-s.gardenwolf.com/version.php"></script>
		<p>You are using TailBone '.$TB['version'].'.<br>Code Name: '.$TB['codeName'].'</p>
		'.$extraContnet.'
		<a href="https://github.com/GardenWolfGroup/TailBone"><div id="github" style="text-align:center;" align="center"></div></a>
  </div>
  ';
  
  //checks to see if the ?page init is set in the URL
  if(isset($_GET['page'])){
  		//checking to see if the page has not run away.
      if(file_exists('./system/admin/sys/pages/'.$_GET['page'].'.php')){
    		//if it is still home, call it downstairs and tell have it echo its mind.
        require('./system/admin/sys/pages/'.$_GET['page'].'.php');
      }else{
    		//if the page is not home. Call its little brother.
        echo($homeContent);
				$pageName = 'Home';
      }
  }else{
		//again, we are calling its little bro
    echo($homeContent);
		$pageName = 'Home';
  }
?>
