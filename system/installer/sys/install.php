<?PHP
	//Fuck this again, I'm getting a hard drink. Cody! CLEAN UP YOUR SHIT!
	if(isset($runningInIndex) && isset($installing) && $installing == true){
		//carry on
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	$perms = substr(sprintf('%o', fileperms('./data')), -4);
	$pageName = 'installing';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>TailBone Installer</title>
		<link rel="stylesheet" href="./system/main/theme/main.css?<?php echo($TB['version']) ?>" type="text/css">
		<link rel="stylesheet" href="./system/main/theme/animations.css?<?php echo($TB['version']) ?>" type="text/css">
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
		<?php include('./system/main/theme/theme.php'); ?>
	</head>
	<body>
		<img src="./data/logo/favicon-96x96.png?<?php echo($TB['version']) ?>" id="icon" alt="Site Icon"/>
		<div id="nav">
			<div id="nav-navigation">
				<a href="#"><div class="nav_installing">Installer</div></a>
			</div>
		</div>
		<div id="content">
			<div id="topper">
				<h1>Installing TailBone</h1>
			</div>
				<div style="text-align:center;">
					<p><span style="color:red;">*</span> = required.</p>
					<P><?PHP if($perms == '0777'){$permsGood=true;echo('<span style="color:#283A47;background-color:#429A86;">Perms are good!</span>');}else{$permsGood=false;echo('<span style="color:red;background-color:black;">Please change the permissions of the data directory to 0777.</span>');}?></P>
					<form method="post" action="./?submitInstall">
						<input <?php if(!$permsGood){echo('disabled');} ?> type="text" class="fancy_input" name="adminUsername" required placeholder="Admin username"><span style="color:red;">*</span><br>
						<input <?php if(!$permsGood){echo('disabled');} ?> type="password" class="fancy_input" name="adminPassword" required placeholder="Admin password" id="nP"><span style="color:red;">*</span><br>
						<input <?php if(!$permsGood){echo('disabled');} ?> type="password" class="fancy_input" required placeholder="Verify password" id="vF"><span style="color:red;">*</span><br><span id="cPT"></span><br>
						<input <?php if(!$permsGood){echo('disabled');} ?> type="text" class="fancy_input" name="siteName" required placeholder="Site name"><span style="color:red;">*</span><br>
						<input <?php if(!$permsGood){echo('disabled');} ?> type="text" class="fancy_input" name="siteAuthor" required placeholder="Site author"><span style="color:red;">*</span></br>
						
						<input class="fancy_input" type="submit" value="Install!" id="Submit">
					</form>
				</div>
			<div id="ender">
				<p style="text-align:center;">TailBone <?php echo($TB['version']); ?></p>
			</div>
		</div>
		<p style="text-align:center;color:grey;font-size:12px;margin-bottom:0px;">Powered by<br><a href="http://tailbone.gardenwolf.com/" target="_blank" style="color:grey;text-decoration:none;font-weight:bold;"><img src="./system/main/theme/img/tailbone.png?2" style="width:75px;"/></a><br><a style="color:grey;" href="https://github.com/Toshib-htr/Tailbone/blob/master/LICENSE.md" target="0">License</a></a><br><br><a href="?admin" style="color:grey;">Admin panel</a></p><br><br>
		<script>
			nP = document.getElementById('nP');
			vF = document.getElementById('vF');
			cPT = document.getElementById('cPT');
			fS = document.getElementById('Submit');
			
			fS.disabled = true;
			
			if(vF){
				vF.addEventListener("keyup", function (evt) {
				    checkPass();
				}, false);
			}
			
			function checkPass(){
				if(nP.value == vF.value){
					vF.style.background = '#429A86';
					cPT.innerHTML = '';
					fS.disabled = false;
				}else{
					vF.style.background = '#FF6961';
					cPT.style.color = '#FF6961';
					cPT.innerHTML = "Passwords don't match!";
					fS.disabled = true;
				}
			}
		</script>
	</body>
</html>