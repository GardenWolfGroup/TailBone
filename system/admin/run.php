<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//stops caching, we are on an admin page. *grumble grumble*
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
	if(checkLogin()){
		$loggedin = true;
	}else{
		$loggedin = false;
	}
	
	//looks to see if the user is requesting a run file.
	if(isset($_GET['request'])){
		//if so, we will allow it.
		$allowRequest = true;
		//looks to make sure the action is set.
		if(isset($_GET['action']) && file_exists('./system/admin/sys/'.$_GET['action'].'.php')){
			//if it is, go ahead and require it. OR DIE
			require('./system/admin/sys/'.$_GET['action'].'.php');
		}else{
			//we dont know what you were trying to do.. but here, have a nice error.
			$_SESSION['MSGBanner'] = 'Unknown error.';
			$_SESSION['MSGType'] = 3;
			header('location: ./?admin');
		}
	}
	
	//fetching settings and page registry.
	require('./data/settings.php');

	//just getting the page data. pretty self-explainitory.
	if(isset($_GET['page'])){
		$_GET['page'] = strtolower($_GET['page']);
			$pageName = ucfirst($_GET['page']);
	}else{
		$pageName = 'Home';
	}
	
	//gets the run file for you if you are logged in or logged out.
	
	if($loggedin){
		$pageRequest = 'loggedin';
	}else{
		$pageRequest = 'login';
		$pageName = 'Login';
	}
	
	//the page file.
	$page = './system/admin/sys/pages/'.$pageRequest.'.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			require('./system/universal/headers.php');
		?>
		<title><?PHP echo($settings['siteName'].' | Administration'); ?></title>
		<?PHP
			echo($settings['analyticsCode']);
			if(isset($GardenWolf)){
				if($GardenWolf == true){
					echo('<script>hosted=true;</script>');
				}
			}
		?>
	</head>
	<body>
		<script src="./system/jScripts/popup.js?<?php echo($TB['version']) ?>"></script>
		<a href="./?admin"><img src="./data/logo/favicon-96x96.png?<?php echo($TB['version']) ?>" id="icon" alt="Site Icon"/></a>
		<div id="nav">
			<div id="nav-navigation">
				<?PHP
					if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'true'){
						echo('<a href="./"><div>Visit site</div></a>
			<a href="./?admin"><div class="nav_Home">Home</div></a>
      <a href="./?admin&page=pages"><div class="nav_Pages">Pages</div></a>
			<a href="./?admin&page=settings"><div class="nav_Settings">Settings</div></a>
			<a href="./?admin&page=theme"><div class="nav_Theme">Theme</div></a>
			<a href="./?admin&page=users"><div class="nav_Users">Users</div></a>
			<a href="./?admin&page=file_manager"><div class="nav_File_manager">Files</div></a>
			<a href="./?admin&page=sysinfo"><div class="nav_Sysinfo">System</div></a>
      <a href="./?admin&logout"><div>Logout</div></a>');
      
      			echo('<script src="./system/jScripts/keepalive.js?'.$TB['version'].'"></script>');
					}else{
						echo('<a href="./"><div>Back to site</div></a>
      <a href="./?admin"><div class="nav_Login">Login</div></a>');
					}
				?>
			</div>
		</div>
		<script src="./system/jScripts/moveBackground.js?<?php echo($TB['version']) ?>"></script>
		<script src="./system/jScripts/MSGBanner.js?<?php echo($TB['version']) ?>"></script>
			<?PHP
				//this is the banner for the messages.
				if(isset($_SESSION['MSGBanner'])){
					switch ($_SESSION['MSGType']){
						case 1:
							$msgColour = '#5CD7BB'; //OK
						break;
						case 2:
							$msgColour = '#FBF174'; //General error.
						break;
						case 3:
							$msgColour = '#FF6961'; //Fatal error.
						break;
					}
					echo('<div id="MSG_Banner" style="background-color:'.$msgColour.'" onclick="closeMSGBanner()"><h1>'.$_SESSION['MSGBanner'].'</h1></div>');
					unset($_SESSION['MSGBanner']);
					unset($_SESSION['MSGType']);
				}

			?>
			
			<!--Easter egg-->
			<script>
				function itsASecret(){
					document.title = 'Shh, its a secret!';
				}
			</script>
			<div id="shh_its_a_secret" onclick='notification("Shh, its a secret...","Congrats, you have found an easter egg in TailBone!",true,"https://tailbone.gardenwolf.com/?shh_its_a_secret","Shh, its a secret...")'></div>
			
			<div id="materialNotif">
				<div id="mNIcon"></div>
				<div id="mNContent">
					<h3 id="mNContentTitle">Title</h3>
					<p id="mNContentText">Text goes here.</p>
				</div>
				<div id="mNButton"></div>
				<div id="mNClose" onclick="closeNotification()"><p><span style="font-weight:bold;">X</span> Close</p></div>
			</div>
			<script src="./system/jScripts/notification.js?<?php echo($TB['version']) ?>"></script>
		<div id="content">
			<div id="topper">
				<h1><?PHP echo(str_replace("_", " ",$pageName)) ?></h1>
			</div>
			<?PHP
				require($page);
			?>
			<br>
			<div id="ender">
				<?PHP
					echo($settings['footerContent']);
				?>
			</div>
		</div>
		<p style="text-align:center;color:grey;font-size:12px;margin-bottom:0px;">Powered by<br><a href="http://tailbone.gardenwolf.com/" target="_blank" style="color:grey;text-decoration:none;font-weight:bold;"><img src="./system/main/theme/img/tailbone.png?<?php echo($TB['version']) ?>" style="width:75px;"/></a><br><a style="color:grey;" href="https://github.com/Toshib-htr/Tailbone/blob/master/LICENSE.md" target="0">License</a></a><br><br><a href="?admin" style="color:grey;">Admin panel</a></p><br><br>
	</body>
</html>
