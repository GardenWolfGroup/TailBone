<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//fetches the user file.
	require('./data/users.php');
	//if TailBone is on a TB host, add the server admin user.
	if($hosted){
		$users[$serverVars['serverAdmin']] = $serverVars['serverAdminPass'];
	}
	
	//stops caching, we are on an admin page. *grumble grumble*
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
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
			header('location: ./?admin&MSGBanner=Unknown Error.&MSGType=3');
		}
	}
	
	session_start();
	
	//HACKHACKHACKHACK
	if(!isset($_SESSION['user'])){
		$_SESSION['user'] = null;
	}
	
	//If the user wants to logout. Log them out.
	if(isset($_GET['logout']) || !isset($users[$_SESSION['user']])){
		// remove all session variables
		session_unset();

		// destroy the session
		session_destroy();
		$_SESSION['loggedin'] = false;
	}
	
	//fetching settings and page registry.
	require('./data/settings.php');
	require('./system/admin/sys/sys.pagereg.php');
	
	
	//just getting the page data. pretty self-explainitory.
	if(isset($_GET['page'])){
		$_GET['page'] = strtolower($_GET['page']);
		if(isset($pageReg[$_GET['page']])){
			$pageName = ucfirst($pageReg[$_GET['page']]);
		}else{
			$pageName = ucfirst($_GET['page']);
		}
	}else{
		$pageName = 'Home';
	}
	
	//gets the run file for you if you are logged in or logged out.
	
	if($_SESSION['loggedin']){
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
		<meta charset="UTF-8">
		<title><?PHP echo($settings['siteName'].' | Administration'); ?></title>
		<meta name="keywords" content="<?PHP echo($settings['siteKeywords']); ?>">
		<meta name="description" content="<?PHP echo($settings['siteDescription']); ?>" />
		<meta name="author" content="<?PHP echo($settings['siteAuthor']); ?>">
		<link rel="stylesheet" href="./system/main/theme/loading.css" type="text/css">
		<link rel="stylesheet" href="./system/main/theme/main.css" type="text/css">
		<?PHP
			include('./system/main/theme/colours.Scss.php');
		?>
		<meta name="viewport" content="width=device-width, initial-scale=0.75, maximum-scale=0.75, minimum-scale=0.75, user-scalable=no"/>
		<link rel="apple-touch-icon" sizes="57x57" href="./data/logo/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="./data/logo/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="./data/logo/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="./data/logo/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="./data/logo/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="./data/logo/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="./data/logo/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="./data/logo/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="./data/logo/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="./data/logo/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="./data/logo/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="./data/logo/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="./data/logo/favicon-16x16.png">
		<link rel="shortcut icon" href="./data/logo/favicon.ico" type="image/x-icon">
		<link rel="icon" href="./data/logo/favicon.ico" type="image/x-icon">
		<meta name="msapplication-TileImage" content="./data/logo/ms-icon-144x144.png">
		<?PHP
			echo($settings['analyticsCode']);
			if(isset($GardenWolf)){
				if($GardenWolf == true){
					echo('<script>hosted=true;</script>');
				}
			}
		?>
		<script src="./system/jScripts/consoleWarning.js"></script>
	</head>
	<body>
		<div id="loadingOver" style="height:100%;width:100%;background:#354d5b;position:fixed;top:0px;left:0px;z-index:9999999999;"><div style="position:fixed;top:50%;left:50%;margin-left:-100px;margin-top:-100px;"><div class='uil-squares-css' style='transform:scale(0.4);'><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div></div></div>
		<script src="./system/jScripts/popup.js"></script>
		<a href="./?admin"><img src="./data/logo/favicon-96x96.png" id="icon" alt="Site Icon"/></a>
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
			<a href="./?admin&page=file_manager"><div class="nav_Files">Files</div></a>
      <a href="./?admin&logout"><div>Logout</div></a>');
      
      			echo('<script src="./system/jScripts/keepalive.js"></script>');
					}else{
						echo('<a href="./"><div>Back to site</div></a>
      <a href="./?admin"><div class="nav_Login">Login</div></a>');
					}
				?>
			</div>
		</div>
		<script src="./system/jScripts/alert.js"></script>
		<script src="./system/jScripts/moveBackground.js"></script>
			<?PHP
				//this is the banner for the messages.
				if(isset($_GET['MSGBanner'])){
					switch ($_GET['MSGType']){
						case 1:
							$msgColour = '#429A86';
						break;
						case 2:
							$msgColour = '#FBF174';
						break;
						case 3:
							$msgColour = '#FF6961';
						break;
					}
					echo('<div id="MSG_Banner" style="background-color:'.$msgColour.'" onclick="closeMSGBanner()"><h1>'.$_GET['MSGBanner'].'</h1></div>');
				}

			?>
		<div id="content">
			<div id="topper">
				<h1><?PHP echo($pageName) ?></h1>
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
		<p style="text-align:center;color:grey;font-size:12px;margin-bottom:0px;">Powered by<br><a href="http://tailbone.gardenwolf.com/" target="_blank" style="color:grey;text-decoration:none;font-weight:bold;"><img src="./system/main/theme/img/tailbone.png?2" style="width:75px;"/></a><br><a style="color:grey;" href="https://github.com/Toshib-htr/Tailbone/blob/master/LICENSE.md" target="0">License</a></a><br><br><a href="?admin" style="color:grey;">Admin panel</a></p><br><br>
		<script src="./system/jScripts/loading.js"></script>
	</body>
</html>
