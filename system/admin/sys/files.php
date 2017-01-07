<?PHP

//Make sure it's running off index.php in the root webserver filesystem
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Paranoid Cody
	if(!$allowRequest){
		header('location:./?admin&MSGBanner=Unknown error.');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//No URL copying pains allowed here!
	if(!$_SESSION['loggedin']){
		header('location:./?admin&MSGBanner=You must be logged in to do that!&MSGType=3');
		die();
	}
	
	
	//Figure out what operation we're performing
	switch ($_GET['type']){
		//Uploading a file
		case 'upload':
			//Get the max size of an upload and make it an int for conversion uses
			$tmpSize = 	ini_get("post_max_size");
			$size = (int) $tmpSize;
			$dir = str_replace("../","", $_POST['directory']);
			
			//Limits the files to images only, seeing how getimagesize returns 0 if it isn't a image
			$valid = getimagesize($_FILES['fileUp']['tmp_name']) > 0;
			
			//Make the target file string for later use
			$target = "./data/upload/" . $dir . $_FILES['fileUp']['name'];
			
			//Check the suffix of the max size
			switch(substr($tmpSize, sizeof($tmpSize) - 2)){
				case 'K': //Kilobytes
					$size *= pow(10, 3);
				break;
				
				case 'M': //Megabytes
					$size *= pow(10, 6);
				break;
				
				case 'G': //Gigabytes
					$size *= pow(10, 9);
				break;
			}
			
			//Check to see if the max post size is larger than the uploaded size
			if($_SERVER['CONTENT_LENGTH'] > $size){
					header("location:./?admin&page=file_manager&MSGBanner=ERROR! File too large!&MSGType=2");
					die();
			}
			
			//Make sure the file has a name
			if(sizeof($_FILES['fileUp']['name']) == 0){
				header("location:./?admin&page=file_manager&MSGBanner=ERROR!  The file isn't valid! Check the name and size of the file!&MSGType=2");
				die();
			}
			
			if(!$valid){
				header("location:./?admin&page=file_manager&MSGBanner=The file you uploaded isn't valid, upload images only!&MSGType=2");
				die();
			}
			
			//Make sure that the file doesn't exist already
			if(file_exists($target)){
				header("location:./?admin&page=file_manager&MSGBanner=ERROR! ".$_FILES['fileUp']['name']." already exists!&MSGType=2");
				die();
			}
			
			//Move the file
			move_uploaded_file($_FILES['fileUp']['tmp_name'], $target);
			
			//Check to make sure it moved, otherwise the perms must be messed up
			if(!file_exists($target)){
				header("location:./?admin&page=file_manager&MSGBanner=ERROR! Something weird happened to your upload! Check your perms!&MSGType=3");
				die();
			}
			
			//Leave
			header("location:./?admin&page=file_manager&MSGBanner=Upload Successful!&MSGType=1");
			die();
		break;
		
		//Deleting files
		case 'delete':
			
			//Get the filename and filepath of the file to be deleted
			$delete = $_GET['file'];
			$fileToDelete = './data/upload/'.$delete;
			
			//Remove the file and flee!
			unlink($fileToDelete);
			header("location:./?admin&page=file_manager&MSGBanner=File Deleted!&MSGType=1");
			die();
		break;
		
		//Create a directory
		case 'createDir':
		
			$dirName = $_GET['name'];
			
			//Check for the folder
			if(file_exists("./data/upload/".$dirName)){
				header("location:./?admin&page=file_manager&MSGBanner=The Folder ".$dirName." Exists!&MSGType=2");
				die();
			}
			
			mkdir("./data/upload/".$dirName);
			header("location:./?admin&page=file_manager&MSGBanner=Folder Created!&MSGType=1");
			die();
		break;
		
		//Folder delete
		case 'fdelete':
			$folder = "./data/upload/".$_GET['file'];
			
			/*Make sure that the folder is empty in the case that someone decided to force the issue 
			 * Even though the file_manager.php should tell the user to clear the folder out before deleting it!
			 */
			if(count(scandir($folder)) > 2){
				header("location:./?admin&page=file_manager&MSGBanner=The Folder ". $_GET['file']." still has files! Remove them in order to delete this folder!&MSGType=2");
				die();
			}
			
			//If once it's removed, check it and leave
			rmdir($folder);
			
			if(!file_exists($folder)){
				header("location:./?admin&page=file_manager&MSGBanner=Folder Deleted!&MSGType=1");
				die();
			}
			
			//Otherwise the perms are probably messed up
			else{
				header("location:./?admin&page=file_manager&MSGBanner=Folder wasn't deleted, check your perms!&MSGType=3");
				die();
			}
	}
?>