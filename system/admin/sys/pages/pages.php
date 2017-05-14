<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}

if(!isset($_GET['intent'])){ //The user has not asked to do one of the following.
	
	echo('
		<h2>What would you like to do?</h2>
		<a class="abtn_blue" href="./?admin&page=pages&intent=create">Create a page</a>
		<a class="abtn_blue" href="./?admin&page=pages&intent=edit">Edit a page</a>
		<a class="abtn_blue" href="./?admin&page=pages&intent=rename">Rename a page</a>
		<a class="abtn_blue" href="./?admin&page=pages&intent=delete">Delete a page</a>
	');
	
}elseif($_GET['intent'] == 'create'){ //The user wishes to create a page.
	echo('
		<!-- Fetches the TinyMCE editor and puts it at your door step. -->
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<!-- Fetches the global config file for TinyMCE -->
		<script src="./system/jScripts/wysiwyg.php"></script>
		
		
		<h2 style="margin-left:5px;">Make a page</h2>
		<form action="./?admin&request&action=makePage" method="post" id="form">
			<input class="fancy_input" type="text" name="pageName" placeholder="Page Name">
			<textarea class="WYSIWYG" name="content" form="form"></textarea>
			<input onclick="setSaved()" class="fancy_input" type="submit" value="Make my page!" style="margin-top:5px;">
		</form>
	');
}elseif($_GET['intent'] == 'delete'){ //the user wishes to delete a page.
	
	echo('<h2>Select a page to delete</h2>');
	//Scans the pages directory. It set of the metal detector, we need to check it.
	$Pages = scandir('./data/pages/');
	sort($Pages); // this does the sorting
	
	//for each of the pages in the pages directory.
	foreach($Pages as $Pages_FE){
		//as long as the returnd is not a sub or current dir mark, or home.. go ahead and echo it.
		if ($Pages_FE != "." && $Pages_FE != ".." && $Pages_FE != "home") {
			//sets the arguments for the popup.
			$popupArgs = "'Delete Page','Are you sure you want to delete that page? I am giving you fair warning that this action cannot be undone!','Yes','./?admin&request&action=deletePage&delete=".$Pages_FE."'";
			$Pages_FE = str_replace("_"," ",$Pages_FE);
			echo'<a class="abtn_blue" onclick="popup('.$popupArgs.')">'.ucfirst($Pages_FE).'</a><br>';
		}
	}
	
}elseif($_GET['intent'] == 'edit'){ //The user wishes to edit a page.
	
	//if the user has selected a page, go ahead and get the editor.
	if(isset($_GET['select'])){
		$selectedFile = './data/pages/'.$_GET['select'].'/page.html';
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
		echo('
			<!-- Fetches the TinyMCE editor and puts it at your door step. -->
			<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
			<!-- Fetches the global config file for TinyMCE -->
			<script src="./system/jScripts/wysiwyg.php"></script>
		');
		echo("
			<h2 style='margin-left:5px;'>Editing the page '".$nameOfPage."'</h2>
			<form action='./?admin&request&action=editPage' method='post' id='form'>
				<input style='display:none;' name='pageName' type='text' value='".$_GET['select']."'>
				<textarea class='WYSIWYG' name='content' form='form'>".$selectedFileData."</textarea>
				Go to this page when done? <input type='checkbox' name='goToPage' ".$checked." class='fancy_input'><br>
				<input onclick='setSaved()' class='fancy_input' type='submit' value='Edit my page!' style='margin-top:5px;'>
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
				echo'<a class="abtn_blue" href="./?admin&page=pages&intent=edit&select='.$Pages_FE.'">'.$nameOfPage.'</a><br>';
			}
			
		}
		
	}
}elseif($_GET['intent'] == 'rename'){
	echo('<h2>Select the page to rename:</h2>');
	echo('<form action="./?admin&request&action=renamePage" method="post">');
	//looks to see if any pages are home, myabe the garden Gnomes scared the away.. We had better git the bash tool if they are locked away somewhere.
	$Pages = scandir('./data/pages/');
	sort($Pages); // this does the sorting
	echo('<select required class="fancy_input" name="original">');
	foreach($Pages as $Pages_FE){
		//checking to make sure that the returned is not the current dir or the previous dir.
		if ($Pages_FE != "." && $Pages_FE != ".." && $Pages_FE != "home") {
			echo'<option value="'.$Pages_FE.'">'.str_replace("_", " ",$Pages_FE).'</option>';
		}
	}
	echo('</select> To ');
	echo('<input required name="new" placeholder="New name" type="text" class="fancy_input"><br>');
	echo('<input type="submit" value="Change name!" class="fancy_input">');
	echo('</form>');
}