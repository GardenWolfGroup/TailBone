<meta charset="UTF-8">
<meta name="keywords" content="<?PHP echo($settings['siteKeywords']); ?>">
<meta name="description" content="<?PHP echo($settings['siteDescription']); ?>" />
<meta name="author" content="<?PHP echo($settings['siteAuthor']); ?>">
<link rel="stylesheet" href="./system/main/theme/main.css?<?php echo($TB['version']) ?>" type="text/css">
<?PHP
	//gets the theme file and builds it.
	include('./system/main/theme/theme.php'); //because why the fuck not...
	
	//animations
	if(isset($_SESSION['animationsSeen']) && $_SESSION['animationsSeen'] == 'true'){
		$animate = 'false';
	}else{
		$animate = 'true';
		echo('<link href="./system/main/theme/animations.css?'.$TB['version'].'" rel="stylesheet" type="text/css">');
	}
	$_SESSION['animationsSeen'] = 'true';
?>

<!-- Scales TailBone for your device -->
<meta name="viewport" content="width=device-width, initial-scale=0.75, maximum-scale=0.75, minimum-scale=0.75, user-scalable=no"/>

<!-- Icons... because devices are shit sometimes... -->
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

<!-- Just warns you that you shouldnt use the console if you dont know what you are doing -->
<script src="./system/jScripts/consoleWarning.js?<?php echo($TB['version']) ?>"></script>