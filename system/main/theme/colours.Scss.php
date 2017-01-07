<?PHP
	require('./data/colours.php');
	if($themeColours['customFont'] != ""){
		$themeFont = '"'.$themeColours['customFont'].'",'.$themeColours['fontFamily'];
	}else{
		$themeFont = $themeColours['fontFamily'];
	}
	echo('
	<meta name="theme-color" content="#'.$themeColours['navBackground'].'">
<style>
	*{
		font-family:'.$themeFont.';
	}
	body{
		background:#'.$themeColours["bodyBackground"].'!important;
		background-image:url('.$themeColours["bodyBackgroundImage"].')!important;
		background-repeat:'.$themeColours["bodyBackgroundRepeat"].';
	}
	#content{
		background:#'.$themeColours["contentBackground"].'!important;
		color:#'.$themeColours["contentText"].'!important;
	}
	hr{
		border-color:white!important;
	}
	#topper{
		background:#'.$themeColours["topperBackground"].'!important;
		color:#'.$themeColours["topperText"].'!important;
	}
	#ender{
		background:#'.$themeColours["enderBackground"].'!important;
	}
	#nav{
		background:#'.$themeColours["navBackground"].'!important;
	}
	#nav a div{
		color:#'.$themeColours["navText"].'!important;
	}
	.nav_'.$pageName.'{
		background-color:#'.$themeColours["navHighlightColour"].';
	}
	#nav-navigation div:hover{
		background-color:#'.$themeColours["navHighlightColour"].';	
	}
	#nav-navigation div:active{
		background-color:#'.$themeColours["navHighlightColour"].';
	}
	'.file_get_contents('./data/custom.css').'
</style>
	');
?>