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
			$pageFile = './data/pages/'.$_GET['page'].'/page.html';
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
			$pageFile = './data/pages/home/page.html';
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
		<?php
			require('./system/universal/headers.php');
		?>
		<title><?php echo(str_replace("_"," ",$siteTitle)); ?></title>
		<?PHP
			echo($settings['analyticsCode']);
		?>
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
		<?PHP
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
					echo('<div id="MSG_Banner" style="background-color:'.$msgColour.'" onclick="closeMsgBanner()"><h1>'.$_SESSION['MSGBanner'].'</h1></div>');
					unset($_SESSION['MSGBanner']);
					unset($_SESSION['MSGType']);
				}
				
				if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin'] == true){
					if(!$four04){
						echo('<a title="Edit page" class="materialCircleButton" href="./?admin&page=pages&intent=edit&select='.$_GET['page'].'&goToPage"></a>');
					}else{
						echo('<a title="Edit error message" class="materialCircleButton" href="./?admin&page=settings"></a>');
					}
					echo('<a title="New page" class="materialCircleButtonPlus" href="./?admin&page=pages&intent=create"></a>');
					echo('<script src="./system/jScripts/keepalive.js?'.$TB['version'].'"></script>');
				}
			?>
			
			<!--Easter egg-->
			<script>
				function itsASecret(){
					document.title = 'Shh, its a secret!';
				}
			</script>
			<span id="barrelRoll"></span>
			<?php
				echo('<script src="./system/jScripts/konami.js?'.$TB['version'].'"></script>');
			?>
			<div id="shh_its_a_secret" onclick='notification("Shh, its a secret...","Congrats, you have found an easter egg in TailBone!",true,"https://tailbone.gardenwolf.com/?shh_its_a_secret","Shh, its a secret...");itsASecret();'></div>
			
			<script src="./system/jScripts/MSGBanner.js?<?php echo($TB['version']) ?>"></script>
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
				<h1><?PHP echo(str_replace("_", " ", $pageName)) ?></h1>
			</div>
			<?PHP
				if($settings['construction'] != true){
					if(!$four04){
						echo("<div id=\"adContent\">".$settings['adContent']."</div>");
						echo(file_get_contents($pageFile));
					}else{
						echo("<div id=\"adContent\">".$settings['adContent']."</div>");
						echo('<h2 style="text-align:center;">'.$settings['four04Message'].'</h2>');
					}
				}else{
					echo('<h1 style="text-align:center;">Sorry, this site is under construction.</h1>');
				}
			?>
			<div id="ender">
				<?PHP
					echo('<p style="padding:3px; text-align:center;">'.$settings['footerContent'].'<p>');
				?>
			</div>
		</div>
		<?php
			if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin'] == true){
				echo('<p style="text-align:center;color:white;">You are logged in as '.ucfirst($_SESSION['user']).'.<br><a class="abtn_blue" style="margin:2px;color:white;" href="./?logout">Log out</a></p>');
			}
		?>
		<p style="text-align:center;color:grey;font-size:12px;margin-bottom:0px;">Powered by<br><a href="http://tailbone.gardenwolf.com/" target="_blank" style="color:grey;text-decoration:none;font-weight:bold;"><img src="./system/main/theme/img/tailbone.png?<?php echo($TB['version']) ?>" style="width:75px;"/></a><br><a style="color:grey;" href="https://github.com/Toshib-htr/Tailbone/blob/master/LICENSE.md" target="0">License</a></a><br><br><a href="?admin" style="color:grey;">Admin panel</a></p><br><br>
	</body>
</html>
