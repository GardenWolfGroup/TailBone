<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
?>
<form action="./?admin&request&action=editSettings" method="post" id="form">
	Is this site under construction? <input type="checkbox" name="construction" <?php if($settings['construction'] == true){echo('checked');}; ?> class="fancy_input"><br>
	<h2>--General--</h2>
	Site name: <input class="fancy_input" type="text" name="siteName" value="<?PHP echo($settings['siteName']); ?>"><br>
	Site description: <input class="fancy_input" type="text" name="siteDescription" value="<?PHP echo($settings['siteDescription']); ?>"><br>
	Site keywords: <input class="fancy_input" type="text" name="siteKeywords" placeholder ="ex: TailBone, CMS, Flat-File" value="<?PHP echo($settings['siteKeywords']); ?>" ><br>
	Site Author: <input class="fancy_input" type="text" name="siteAuthor" placeholder ="ex: Cody Paul Brian" value="<?PHP echo($settings['siteAuthor']); ?>"><br>
	Footer content:<br><input class="fancy_input" name="footerContent" form="form" value="<?PHP echo($settings['footerContent']); ?>"><br>
	<h2>--Advanced--</h2>
	Page not found message: <input type="text" value="<?PHP echo($settings['four04Message']); ?>" name="four04Message" class="fancy_input"><br>
	Analytics code and other scripts: <br><textarea class="fancy_input" form="form" name="analyticsCode"><?PHP echo($settings['analyticsCode']) ?></textarea><br>
	Login notice: <br><textarea class="fancy_input" form="form" name="loginNotice"><?PHP echo($settings['loginNotice']); ?></textarea><br>
	Ad content: <br><textarea class="fancy_input" name="adContent" form="form"><?PHP echo($settings['adContent']); ?></textarea><br>
	<input class="fancy_input" type="submit" value="Save">
</form>