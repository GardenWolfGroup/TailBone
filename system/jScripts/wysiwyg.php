<?php
	header('Content-Type: text/javascript');
	require('../../data/theme.php');
?>
tinymce.init({
	selector:'.WYSIWYG',
	plugins: [
		'textcolor colorpicker code hr link advlist lists autolink image',
	],
	fontsize_formats: "8pt 9pt 10pt 11pt 12pt 26pt 36pt",
	toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	toolbar2: "forecolor backcolor | fontselect | fontsizeselect",
	entity_encoding : "named",
	browser_spellcheck: true,
	content_style: "html body {background-color:#<?php echo($theme['contentBackground']); ?>;color:#<?php echo($theme['contentText']) ?>;font-family:<?php echo($themeFont) ?>;font-size:12pt;} html body *{max-width:100%;} html body img{height:initial!important}",
	height: "500px",
});