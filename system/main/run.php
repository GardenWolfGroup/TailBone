<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//lets get some settings happening here.
	require('./data/settings.php');
	
	if(checkLogin()){
		$settings['construction'] = false;
	}
	
	//start loading stuff, are we in construction mode?
	if($settings['construction'] != true){
		if(isset($_GET['page'])){
			$pageFile = './data/pages/'.$_GET['page'].'/page.php';
			if(file_exists($pageFile)){
				$_GET['page'] = strtolower($_GET['page']);
				$pageName = ucfirst($_GET['page']);
				$four04 = false;
			}else{
				$_GET['page'] = '404';
				$pageName = '404 - Not found!';
				$four04 = true;
				header('HTTP/1.0 404 Not found');
			}
		}else{
			$_GET['page'] = "home";
			$pageName = 'Home';
			$pageFile = './data/pages/home/page.php';
			$four04 = false;
		}
	}else{
		$_GET['page'] = "home";
		$pageName = 'Home';
		$four04 = false;
	}
	
	$siteTitle = $settings['siteName'].' | '.$pageName;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?PHP echo(str_replace("_"," ",$siteTitle)); ?></title>
		<meta name="keywords" content="<?PHP echo($settings['siteKeywords']); ?>">
		<meta name="description" content="<?PHP echo($settings['siteDescription']); ?>" />
		<meta name="author" content="<?PHP echo($settings['siteAuthor']); ?>">
		<link rel="stylesheet" href="./system/main/theme/main.css?<?php echo($TB['version']) ?>" type="text/css">
		<?PHP
			include('./system/main/theme/theme.php'); //because why the fuck not...
			
			if(isset($_SESSION['animationsSeen']) && $_SESSION['animationsSeen'] == 'true'){
				$animate = 'false';
			}else{
				$animate = 'true';
				echo('<link href="./system/main/theme/animations.css?'.$TB['version'].'" rel="stylesheet" type="text/css">');
			}
			$_SESSION['animationsSeen'] = 'true';
		?>
		<meta name="viewport" content="width=device-width, initial-scale=0.75, maximum-scale=0.75, minimum-scale=0.75, user-scalable=no"/>
		<link rel="apple-touch-icon" sizes="57x57" href="./data/logo/apple-icon-57x57.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="60x60" href="./data/logo/apple-icon-60x60.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="./data/logo/apple-icon-72x72.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="76x76" href="./data/logo/apple-icon-76x76.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="./data/logo/apple-icon-114x114.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="120x120" href="./data/logo/apple-icon-120x120.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="144x144" href="./data/logo/apple-icon-144x144.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="152x152" href="./data/logo/apple-icon-152x152.png?<?php echo($TB['version']) ?>">
		<link rel="apple-touch-icon" sizes="180x180" href="./data/logo/apple-icon-180x180.png?<?php echo($TB['version']) ?>">
		<link rel="icon" type="image/png" sizes="192x192"  href="./data/logo/android-icon-192x192.png?<?php echo($TB['version']) ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="./data/logo/favicon-32x32.png?<?php echo($TB['version']) ?>">
		<link rel="icon" type="image/png" sizes="96x96" href="./data/logo/favicon-96x96.png?<?php echo($TB['version']) ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="./data/logo/favicon-16x16.png?<?php echo($TB['version']) ?>">
		<link rel="shortcut icon" href="./data/logo/favicon.ico?<?php echo($TB['version']) ?>" type="image/x-icon">
		<link rel="icon" href="./data/logo/favicon.ico?<?php echo($TB['version']) ?>" type="image/x-icon">
		<meta name="msapplication-TileImage" content="./data/logo/ms-icon-144x144.png?<?php echo($TB['version']) ?>">
		<?PHP
			echo($settings['analyticsCode']);
		?>
		<script src="./system/jScripts/consoleWarning.js?<?php echo($TB['version']) ?>"></script>
	</head>
	<body>
		<a href="./"><img src="./data/logo/favicon-96x96.png?<?php echo($TB['version']) ?>" id="icon" alt="Site Icon"/></a>
		<div id="nav">
			<div id="nav-navigation">
				<a href="./"><div class="nav_Home">Home</div></a>
				<?PHP
					if($settings['construction'] != true){
						$Pages = scandir('./data/pages/');
						sort($Pages); // this does the sorting
						foreach($Pages as $Pages_FE){
							if ($Pages_FE != "." && $Pages_FE != ".." && $Pages_FE != "home" && $Pages_FE != "index.php") {
								$nameOfPage = str_replace("_"," ",$Pages_FE);
								echo'<a href="?page='.$Pages_FE.'"><div class="nav_'.ucfirst($Pages_FE).'">'.ucfirst($nameOfPage).'</div></a>';
							}
						}
					}
				?>
			</div>
		</div>
		<script src="./system/jScripts/moveBackground.js?<?php echo($TB['version']) ?>"></script>
		<script src="./system/jScripts/MSGBanner.js?<?php echo($TB['version']) ?>"></script>
		<?PHP
			if(isset($_SESSION['MSGBanner'])){
					switch ($_SESSION['MSGType']){
						case 1:
							$msgColour = '#429A86'; //OK
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
		<div id="content">
			<div id="topper">
				<?php
					if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin'] == true){
						if(!$four04){
							echo('<a class="abtn_blue" style="float:left;display:inline-block;margin-right:-100%;margin-top:5px;box-shadow:none;" href="./?admin&page=pages&intent=edit&select='.$_GET['page'].'&goToPage">Edit</a>');
						}else{
							echo('<a class="abtn_blue" style="float:left;display:inline-block;margin-right:-100%;margin-top:5px;box-shadow:none;" href="./?admin&page=settings">Edit this message</a>');
						}
						echo('<script src="./system/jScripts/keepalive.js?'.$TB['version'].'"></script>');
					}
					
				?>
				<h1><?PHP echo(str_replace("_", " ", $pageName)) ?></h1>
			</div>
			<div id="adContent">
				<?PHP echo($settings['adContent']);?>
			</div>
			<?PHP
				if($settings['construction'] != true){
					if(!$four04){
						echo(file_get_contents($pageFile));
					}else{
						echo('<h2 style="text-align:center;">'.$settings['four04Message'].'</h2>');
					}
				}else{
					echo('<h1 style="text-align:center;">Sorry, this site is under construction.</h1>');
				}
			?>
			<div id="ender">
				<?PHP
					echo($settings['footerContent']);
				?>
			</div>
		</div>
		<?php
			if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin'] == true){
				echo('<p style="text-align:center;color:white;">You are logged in as '.ucfirst($_SESSION['user']).'.<br><a style="color:white;" href="./?logout">Log out</a></p>');
			}
		?>
		<p style="text-align:center;color:grey;font-size:12px;margin-bottom:0px;">Powered by<br><a href="http://tailbone.gardenwolf.com/" target="_blank" style="color:grey;text-decoration:none;font-weight:bold;"><img src="./system/main/theme/img/tailbone.png?<?php echo($TB['version']) ?>" style="width:75px;"/></a><br><a style="color:grey;" href="https://github.com/Toshib-htr/Tailbone/blob/master/LICENSE.md" target="0">License</a></a><br><br><a href="?admin" style="color:grey;">Admin panel</a></p><br><br>
	</body>
</html>
