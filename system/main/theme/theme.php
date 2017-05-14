<?PHP
	require('./data/theme.php');
	if($theme['customFont'] != ""){
		$themeFont = '"'.$theme['customFont'].'",'.$theme['fontFamily'];
	}else{
		$themeFont = $theme['fontFamily'];
	}
	echo('
	<meta name="theme-color" content="'.$theme['navBackground'].'">
<style>
	'.file_get_contents('./data/custom.css').'
	*{
		font-family:'.$themeFont.';
	}
	body{
		background:'.$theme["bodyBackground"].'!important;
		background-image:url('.$theme["bodyBackgroundImage"].')!important;
		background-repeat:'.$theme["bodyBackgroundRepeat"].'!important;
	}
	#content{
		background:'.$theme["contentBackground"].'!important;
		color:'.$theme["contentText"].'!important;
	}
	hr{
		border-color:white!important;
	}
	#topper{
		background:'.$theme["topperBackground"].'!important;
		color:'.$theme["topperText"].'!important;
	}
	#ender{
		background:'.$theme["enderBackground"].'!important;
	}
	#nav{
		background:'.$theme["navBackground"].'!important;
		border-bottom:2px solid '.$theme["navBackground"].';
	}
	#nav a div{
		color:'.$theme["navText"].'!important;
	}
	.nav_'.$pageName.'{
		background-color:'.$theme["navHighlightColour"].'!important;
	}
	#nav-navigation div:hover{
		background-color:'.$theme["navHighlightColour"].';	
	}
	#nav-navigation div:active{
		background-color:'.$theme["navHighlightColour"].';
	}
	.materialCircleButton{
		background-color:'.$theme['topperBackground'].';
	}
	.materialCircleError{
		background-color:'.$theme['topperBackground'].';
	}
	.materialCircleButtonPlus{
		background-color:'.$theme['topperBackground'].';
	}
	.fancy_input, .abtn_blue{
		background-color:'.$theme['bodyBackground'].';
	}
</style>
	');
?>