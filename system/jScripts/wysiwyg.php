<?php
	header('Content-Type: text/javascript');
	require('../../data/colours.php');
?>
tinymce.init({
	selector:'.WYSIWYG',
	plugins: [
		'textcolor colorpicker code hr link advlist lists autolink image',
	],
	toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	toolbar2: "forecolor backcolor | font",
	entity_encoding : "named",
	browser_spellcheck: true,
	content_style: "html body {background-color:#<?php echo($themeColours['contentBackground']); ?>;color:#<?php echo($themeColours['contentText']) ?>;}",
});