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
	content_style: "html body {background-color:<?php echo($theme['contentBackground']); ?>;color:<?php echo($theme['contentText']) ?>;font-family:<?php echo($themeFont) ?>;font-size:12pt;} html body *{max-width:100%;} html body img{height:initial!important}",
	height: "500px",
	extended_valid_elements:'script[language|type|src]',
	image_list: [
		<?php
			$images = scandir('../../data/upload/'); //scans the upload directory.
			
			$counter = 0; //initiates the counter
			
			foreach($images as $for){ //for each of the images or direcotry do....
				
				if($for != "." && $for != ".."){ //checks to make sure we arent leaving or staying in the dir.
					
					if(!is_dir('../../data/upload/'.$for)){ // if it isnt a dir...
						
						$counter++; //add to the counter
						
						echo("{title: '$counter. $for', value: './data/upload/$for'},\n"); //echo the data.
						
					}else{ //if it is a dir...
						
						$images2 = scandir('../../data/upload/'.$for); //okay, it is a dir, lets scan it.
						
						foreach($images2 as $for2){ //for each of the sub dir do...
							
							if($for2 != "." && $for2 != ".."){ //make sure we are staying here.
							
								$counter++; // add again.
								
								echo("{title: '$counter. $for/$for2', value: './data/upload/$for/$for2'},\n");// aaannnnndddd echo the data.
								
							}
						}
					}
				}
			}
		?>
	],
});

saved = false;

function setSaved(){
	saved = true;
}

// Warning before leaving the page (back button, or outgoinglink)
window.onbeforeunload = function() {
	if(!saved){
  	return "Changes may not be saved if you do...."; //NOT SAVED!!! HOLD UP!!!
  }else{
  	return; //saved, continue on.
  }
};

//full edit.