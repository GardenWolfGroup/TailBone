<?PHP
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
?>
<!-- Fetches the TinyMCE editor and puts it at your door step. -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<!-- Fetches the global config file for TinyMCE -->
<script src="./system/jScripts/wysiwyg.php"></script>


<h2 style="margin-left:5px;">Make a page</h2>
<form action="./?admin&request&action=makePage" method="post" id="form">
	<input class="fancy_input" type="text" name="pageName" placeholder="Page Name">
	<textarea class="WYSIWYG" name="content" form="form"></textarea>
	<input class="fancy_input" type="submit" value="Make my page!" style="margin-top:5px;">
</form>