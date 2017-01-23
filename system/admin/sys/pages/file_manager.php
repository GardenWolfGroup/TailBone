<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	$pageName = 'Files';
	
	//Get the max file upload size
	$maxFileSize = str_replace("M"," Megabytes",ini_get("upload_max_filesize"));
	
	//Display the information
	echo('<h2>--Upload--</h2>');
	echo('<p>The max file upload size is '.$maxFileSize.'.</p>');
?>

<!-- File Upload Form -->
<form id="uploader" action="./?admin&request&action=files&type=upload" method="POST" enctype="multipart/form-data">
	
	<!-- Directory Chooser (Doesn't display subdirectories of subdirectories) <-- Really?  Nobody caught the unclosed parens? GAH -->
	<select class="fancy_input" id="dirUploadChooser" name="directory">
		Upload to folder:<option value="">Home</option>
		
		<!-- Get all the folders in the Upload Folder -->
	<?PHP
		$parser = scandir("./data/upload/");
		
		foreach($parser as $item){
			
			//Make sure the current item is a directory and not the parent or current directories
			if(is_dir("./data/upload/".$item) && !($item == "." || $item == "..")){
				echo('<option value="'.$item.'/">'.$item.'</option>');
			}
		}
	?>
	</select>
	<br>
	
	<!-- Input for uploading files -->
	<input name="fileUp" id="fileIn" type="file" class="fancy_input"/> 
	<button type="submit" id="uploadButton" class="fancy_input">Upload</button>
</form>
<?php
	$spacePercent = round(disk_free_space('/')/disk_total_space('/'),2)*100;
	echo('<p>Space left:</p><div style="background:#'.$theme['bodyBackground'].';width:600px; max-width:90%; padding:6px;"><div style="background:#'.$theme['contentBackground'].'; width:'.$spacePercent.'%;text-align:center; overflow:hidden;">'.$spacePercent.'%</div></div>');
?>

<h2>--Make a folder--</h2>
<input id="newDirName" class="fancy_input" type="text" placeholder="Folder name"><button onclick="CreateFolder()" type="button" id="folderCreate" class="fancy_input">Make folder</button>
<h2>--Your files--</h2>

<!-- Buttons for the files and folder lister-->
<?PHP

	//Placed in a function for recursive folder reading, however the divs echoed from the function aren't built for more than 1 subdirectory as of the current time
	function parseDir($uploadedFiles, $subFilePath = "", $current = "./data/upload/", $subDirPath = ""){
		
		global $theme;
		
		//Boolean value that's useful for ifs and tetriary operators
		$inSubDir = ($subFilePath != "");
		$fileNum = 0;
		
		//Makes sure that the array passed isn't empty
		if(!empty($uploadedFiles)){
			
			//Loop throgh the uploaded files
			foreach($uploadedFiles as $uF){
				
				//Make sure parent and current directories don't show up
				if($uF != '..' && $uF != '.'){
						
						//Values for the file buttons and labels
						$fileNum++;
						$delPopupPrams = "'Delete','Are you sure you want to delete that file?<br>".$uF."','Yes','./?admin&request&action=files&type=delete&file=".$subDirPath.$uF."'";
						$copyLinkPrams = "'".$subDirPath.$uF."'";
						
						$currentFile = ($inSubDir ? $subFilePath.".".$fileNum : $fileNum);
						
						//Checks to the current working file is a directory
						if(is_dir($current.$uF)){
							
							if(count(scandir($current.$uF."/")) > 2){
								$delPopupPrams = "'Delete', 'You cannot delete the ".$uF." directory, seeing how there are files within it!  If you clear it, then you can delete it!','OK','./?admin&page=file_manager'";
							}
							else{
							//Change the delete params
								$delPopupPrams = "'Delete','Are you sure you want to delete that folder?<br>".$uF."','Yes','./?admin&request&action=files&type=fdelete&file=".$subFilePath.$uF."'";
							}
							echo('<div style="background-color:#'.$theme['bodyBackground'].';margin-bottom:50px;"><p style="line-height:40px;margin-bottom:-40px;">'.$currentFile.'. '.$uF.' (Folder)</p><div style="float:right;margin:5px;"><a onclick="popup('.$delPopupPrams.')" class="abtn_blue" style="display:inline-block;" alt="Delete file">Delete</a><a onclick="CopyLink('.$copyLinkPrams.')" class="abtn_blue" alt="Copy link">Copy link</a><a onclick="viewFile('.$copyLinkPrams.')" class="abtn_blue" alt="view">View</a></div></div>');
							
							//Go into the directory
							parseDir(scandir($current.$uF."/"), $currentFile, $current.$uF."/", $subDirPath.$uF.'/');
						}
						
						else if(!$inSubDir){
							echo('<div style="background-color:#'.$theme['bodyBackground'].';margin-bottom:50px;"><p style="line-height:40px;margin-bottom:-40px;">'.$currentFile.'. '.$uF.'</p><div style="float:right;margin:5px;"><a onclick="popup('.$delPopupPrams.')" class="abtn_blue" style="display:inline-block;" alt="Delete file">Delete</a><a onclick="CopyLink('.$copyLinkPrams.')" class="abtn_blue" alt="Copy link">Copy link</a><a onclick="viewFile('.$copyLinkPrams.')" class="abtn_blue" alt="view">View</a></div></div>');
						}
						
						else{
							//Give the subdirectory files a special class for indentation, which makes them easier to identify
							echo('<div class="subDir" style="background-color:#'.$theme['bodyBackground'].';margin-bottom:50px;width: 97%;position: relative;right: 0;left: 3%;"><p style="line-height:40px;margin-bottom:-40px;">'.$currentFile.'. '.$uF.'</p><div style="float:right;margin:5px;"><a onclick="popup('.$delPopupPrams.')" class="abtn_blue" style="display:inline-block;" alt="Delete file">Delete</a><a onclick="CopyLink('.$copyLinkPrams.')" class="abtn_blue" alt="Copy link">Copy link</a><a onclick="viewFile('.$copyLinkPrams.')" class="abtn_blue" alt="view">View</a></div></div>');
						}
				}
			}
		}
		else{
			echo('<h3>You have not uploaded anything.</h3>');
		}
	}
	
	//Run the function through the upload directory
	parseDir(scandir('./data/upload/'));
	
?>

<!-- Popups for files -->
<script>
	//Inital popup setup
	document.write ('<div id="viewer" style="display:none;position:fixed;top:5%;height:75%;left:5%;width:90%;margin:auto;text-align:center;background-color:#587C8C;padding:0px;z-index:9999;color:white;box-shadow: 11px 13px 47px -1px rgba(0,0,0,0.57);"><div style="height:40px;width;100%;background-color:#429A86;padding:0px;margin-top:-22px;"><div id="closePopup" onclick="closeViewer()">X</div><h1 id="viewerTitle" style="max-width:calc(100% - 40px); overflow:hidden;"></h1></div><div style="width:100%; height:calc(100% - 40px); overflow-y:scroll;"><img id="frameView" style="max-width:98%; padding-left:1%; padding-right:1%;" src=""/></div></div>');
	
	function CopyLink(file){
		popup('Copy','Highlight and copy the following to use on your site:<br><input class="fancy_input" onClick="this.select();" value="./data/upload/'+file+'">','Thanks',window.location.href);
	}
	
	//File viewer for images
	function viewFile(file){
		document.getElementById('viewer').style.display = "initial";
		document.getElementById('frameView').src = "./data/upload/"+file;
		viewerHeight = document.getElementById('viewer').clientHeight;
		viewerHeight = viewerHeight-(viewerHeight*0.05);
		frameHeight = viewerHeight - 40;
		document.getElementById('frameView').style.height = frameHeight+"px";
		document.getElementById('viewerTitle').innerHTML = file;
	}
	
	//Make a folder
	function CreateFolder(){
		dirName = document.getElementById('newDirName').value;
		if(dirName != ""){
			popup('Create a folder','Are your sure you want to create the folder "'+dirName+'"<br><input class="fancy_input" type="text" name="newDirName>', 'Yes', './?admin&request&action=files&type=createDir&name=' + dirName);
		}else{
			popup('Create a folder','Please give the folder a name first.','OK',window.location);
		}
	}
	
	//Exiting the popup
	function closeViewer(){
		document.getElementById('viewer').style.display = 'none';
	}
</script>