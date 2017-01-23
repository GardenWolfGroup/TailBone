<?PHP
	require('./data/theme.php');
	if($theme['customFont'] != ""){
		$themeFont = '"'.$theme['customFont'].'",'.$theme['fontFamily'];
	}else{
		$themeFont = $theme['fontFamily'];
	}
	echo('
	<meta name="theme-color" content="#'.$theme['navBackground'].'">
<style>
	*{
		font-family:'.$themeFont.';
	}
	body{
		background:#'.$theme["bodyBackground"].'!important;
		background-image:url('.$theme["bodyBackgroundImage"].')!important;
		background-repeat:'.$theme["bodyBackgroundRepeat"].';
	}
	#content{
		background:#'.$theme["contentBackground"].'!important;
		color:#'.$theme["contentText"].'!important;
	}
	hr{
		border-color:white!important;
	}
	#topper{
		background:#'.$theme["topperBackground"].'!important;
		color:#'.$theme["topperText"].'!important;
	}
	#ender{
		background:#'.$theme["enderBackground"].'!important;
	}
	#nav{
		background:#'.$theme["navBackground"].'!important;
	}
	#nav a div{
		color:#'.$theme["navText"].'!important;
	}
	.nav_'.$pageName.'{
		background-color:#'.$theme["navHighlightColour"].';
	}
	#nav-navigation div:hover{
		background-color:#'.$theme["navHighlightColour"].';	
	}
	#nav-navigation div:active{
		background-color:#'.$theme["navHighlightColour"].';
	}
	'.file_get_contents('./data/custom.css').'
</style>
	');
?>