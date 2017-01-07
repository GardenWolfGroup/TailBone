<?PHP
	//Fuck this I'm getting some tea
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//looks to see if the user desires to set the defaults.
	if(isset($_GET['setDefault'])){
		$bodyBackground = '354D5B';
		$bodyBackgroundImage = '';
		$bodyBackgroundRepeat = 'no-repeat';
		$navHighlightColour = '587C8C';
		$contentBackground = '587C8C';
		$contentText = 'FFFFFF';
		$topperBackground = '429A86';
		$topperText = '283A47';
		$enderBackground = '1B53A1';
		$navBackground = '283A47';
		$navText = 'DBDBDB';
		$fontFamily = 'Tahoma, Geneva, sans-serif';
		$customFont = '';
	}else{
		//if not, well... you get the point...
		require('./data/colours.php');
		$bodyBackground = $themeColours["bodyBackground"];
		$bodyBackgroundImage = $themeColours["bodyBackgroundImage"];
		$bodyBackgroundRepeat = $themeColours["bodyBackgroundRepeat"];
		$navHighlightColour = $themeColours["navHighlightColour"];
		$contentBackground = $themeColours["contentBackground"];
		$contentText = $themeColours["contentText"];
		$topperBackground = $themeColours["topperBackground"];
		$topperText = $themeColours["topperText"];
		$enderBackground = $themeColours["enderBackground"];
		$navBackground = $themeColours["navBackground"];
		$navText = $themeColours["navText"];
		$fontFamily = $themeColours["fontFamily"];
		$customFont = $themeColours["customFont"];
	}
?>
<style>
	.fancy_input{
		border:1px solid #283A47;
	}
</style>
<script src="./system/jscolour/jscolor.js" type="text/javascript"></script>
<form action="./?admin&request&action=editTheme" method="post">
	<h2>--Background--</h2>
	Site Background: <input class="jscolor fancy_input" type="text" name="bodyBackground" value="<?PHP echo($bodyBackground); ?>"><br>
	Site Background Image: <input placeholder="URL (None for no image)" class="fancy_input" type="text" name="bodyBackgroundImage" value="<?PHP echo($bodyBackgroundImage); ?>"><br>
	Site background Repeat: <select name="bodyBackgroundRepeat" class="fancy_input">
		<option value="no-repeat" <?PHP if($bodyBackgroundRepeat == 'no-repeat'){echo('selected');} ?>>No Repeat</option>
		<option value="repeat" <?PHP if($bodyBackgroundRepeat == 'repeat'){echo('selected');} ?>>Repeat</option>

	</select><br>
	<h2>--Text--</h2>
	Site font: <select name="fontFamily" class="fancy_input">
		<option disabled>--Serif fonts--</option>
		<option <?PHP if($fontFamily == "Georgia, serif"){echo('selected');} ?> value="Georgia, serif" style="font-family:Georgia, serif;">Georgia, serif</option>
		<option <?PHP if($fontFamily == "'Palatino Linotype', 'Book Antiqua', Palatino, serif"){echo('selected');} ?> value="'Palatino Linotype', 'Book Antiqua', Palatino, serif" style="font-family:'Palatino Linotype', 'Book Antiqua', Palatino, serif;">Palatino Linotype, Book Antiqua, Palatino, serif</option>
		<option <?PHP if($fontFamily == "'Times New Roman', Times, serif"){echo('selected');} ?> value="'Times New Roman', Times, serif" style="font-family:'Times New Roman', Times, serif;">Times New Roman, Times, serif</option>
		<option disabled>--Sans-Serif fonts--</option>
		<option <?PHP if($fontFamily == "Arial, Helvetica, sans-serif"){echo('selected');} ?> value="Arial, Helvetica, sans-serif" style="font-family:Arial, Helvetica, sans-serif;">Arial, Helvetica, sans-serif</option>
		<option <?PHP if($fontFamily == "'Arial Black', Gadget, sans-serif"){echo('selected');} ?> value="'Arial Black', Gadget, sans-serif" style="font-family:'Arial Black', Gadget, sans-serif;">Arial Black, Gadget, sans-serif</option>
		<option <?PHP if($fontFamily == "'Comic Sans MS', cursive, sans-serif"){echo('selected');} ?> value="'Comic Sans MS', cursive, sans-serif" style="font-family:'Comic Sans MS', cursive, sans-serif;">Comic Sans MS, cursive, sans-serif</option>
		<option <?PHP if($fontFamily == "Impact, Charcoal, sans-serif"){echo('selected');} ?> value="Impact, Charcoal, sans-serif" style="font-family:Impact, Charcoal, sans-serif;">Impact, Charcoal, sans-serif</option>
		<option <?PHP if($fontFamily == "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"){echo('selected');} ?> value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">Lucida Sans Unicode, Lucida Grande, sans-serif</option>
		<option <?PHP if($fontFamily == "Tahoma, Geneva, sans-serif"){echo('selected');} ?> value="Tahoma, Geneva, sans-serif" style="font-family:Tahoma, Geneva, sans-serif;">Tahoma, Geneva, sans-serif</option>
		<option <?PHP if($fontFamily == "'Trebuchet MS', Helvetica, sans-serif"){echo('selected');} ?> value="'Trebuchet MS', Helvetica, sans-serif" style="font-family:'Trebuchet MS', Helvetica, sans-serif;">Trebuchet MS, Helvetica, sans-serif</option>
		<option <?PHP if($fontFamily == "Verdana, Geneva, sans-serif"){echo('selected');} ?> value="Verdana, Geneva, sans-serif" style="font-family:Verdana, Geneva, sans-serif;">Verdana, Geneva, sans-serif</option>
		<option disabled>--Monospace fonts--</option>
		<option <?PHP if($fontFamily == "'Courier New', Courier, monospace"){echo('selected');} ?> value="'Courier New', Courier, monospace" style="font-family:'Courier New', Courier, monospace;">Courier New, Courier, monospace</option>
		<option <?PHP if($fontFamily == "'Lucida Console', Monaco, monospace"){echo('selected');} ?> value="'Lucida Console', Monaco, monospace" style="font-family:'Lucida Console', Monaco, monospace;">Lucida Console, Monaco, monospace</option>
	</select>
	or a custom font: <input class="fancy_input" type="text" name="customFont" value="<?php echo($customFont); ?>" placeholder="Do not use quotes here."><br>
	Text Colour: <input class="jscolor fancy_input" type="text" name="contentText" value="<?PHP echo($contentText); ?>"><br>
	<h2>--Colours--</h2>
	<p>(In order of appearance.)<br>Click boxes for colour picker!</p>
	Nav Background: <input class="jscolor fancy_input" type="text" name="navBackground" value="<?PHP echo($navBackground); ?>"><br>
	Nav Text Colour: <input class="jscolor fancy_input" type="text" name="navText" value="<?PHP echo($navText); ?>"><br>
	Nav highlight colour: <input class="jscolor fancy_input" type="text" name="navHighlightColour" value="<?PHP echo($navHighlightColour); ?>"><br>
	Topper Background: <input class="jscolor fancy_input" type="text" name="topperBackground" value="<?PHP echo($topperBackground); ?>"><br>
	Topper Text Colour: <input class="jscolor fancy_input" type="text" name="topperText" value="<?PHP echo($topperText); ?>"><br>
	Content Background: <input class="jscolor fancy_input" type="text" name="contentBackground" value="<?PHP echo($contentBackground); ?>"><br>
	Footer Background: <input class="jscolor fancy_input" type="text" name="enderBackground" value="<?PHP echo($enderBackground); ?>"><br>
	<h2>--Custom--<h2></h2>
	Custom CSS:<br>
	<textarea class="fancy_input" name="customCSS"><?PHP echo(file_get_contents('./data/custom.css')) ?></textarea><br>
	<?PHP
		if(isset($_GET['setDefault'])){
			echo('<p>Click save to set defaults!</p>');
		}else{
			//nothing. carry on.
		}
	?>
	<input class="fancy_input abtn_blue" type="submit" value="Save"><a class="fancy_input abtn_blue" href="?admin&page=theme&setDefault">Set defaults</a>
</form>
