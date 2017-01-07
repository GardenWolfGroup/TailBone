<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
?>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="./system/jScripts/wysiwyg.php"></script>
<?PHP
	//if the user has selected a page, go ahead and get the editor.
	if(isset($_GET['select'])){
		$selectedFile = './data/pages/'.$_GET['select'].'/page.php';
		//gets the contents of the file in question. (We found drugs in its house, we need to know everything it does.)
		$selectedFileData = file_get_contents($selectedFile);
		//Replaces the _ in the file with a space to make it look pretty.
		$nameOfPage = str_replace("_"," ",$_GET['select']);
		
		//checks to see if the user has come from a page outside of the admin console. If the person has, go ahead and check the box for them ;)
		if(isset($_GET['goToPage'])){
			$checked = 'checked';
		}else{
			$checked = ''; //HACKHACKHACK
		}
		//Why I did this.. I dont know.. But, this is what loads the editor.
		echo("
			<h2 style='margin-left:5px;'>Editing the page '".$nameOfPage."'</h2>
			<form action='./?admin&request&action=editPage' method='post' id='form'>
				Go to this page when done? <input type='checkbox' name='goToPage' ".$checked." class='fancy_input'>
				<input style='display:none;' name='pageName' type='text' value='".$_GET['select']."'>
				<textarea class='WYSIWYG' name='content' form='form'>".$selectedFileData."</textarea>
				<input class='fancy_input' type='submit' value='Edit my page!' style='margin-top:5px;'>
			</form>
		");
	}else{
		//in the case that the user has not yet selected a page to edit, show them a selector.
		echo('<h2>Select a page to edit from the following:</h2>');
		//looks to see if any pages are home, myabe the garden Gnomes scared the away.. We had better git the bash tool if they are locked away somewhere.
		$Pages = scandir('./data/pages/');
		sort($Pages); // this does the sorting
		foreach($Pages as $Pages_FE){
			//checking to make sure that the returned is not the current dir or the previous dir.
			if ($Pages_FE != "." && $Pages_FE != "..") {
				$nameOfPage = str_replace("_", " ", $Pages_FE);
				echo'<a class="abtn_blue" href="./?admin&page=pages_edit&select='.$Pages_FE.'">'.$nameOfPage.'</a><br>';
			}
		}
	}
?>
