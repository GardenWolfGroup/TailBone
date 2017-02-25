<?PHP

//Make sure it's running off index.php in the root webserver filesystem
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//Paranoid Cody
	if(!$allowRequest){
		$_SESSION['MSGBanner'] = 'Unknown error.';
		$_SESSION['MSGType'] = 3;
		header('location:./?admin');
		die('403 FORBIDDEN: TailBone did not allow the requested action to be preformed.');
	}
	
	session_start();
	
	//No URL copying pains allowed here!
	if(!$loggedin){
		$_SESSION['MSGBanner'] = 'You must be logged in to do that!';
		$_SESSION['MSGType'] = 2;
		header('location:./?admin');
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
				$_SESSION['MSGBanner'] = 'Error, file too large.';
				$_SESSION['MSGType'] = 2;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			//Make sure the file has a name
			if(sizeof($_FILES['fileUp']['name']) == 0){
				$_SESSION['MSGBanner'] = 'Error, the file is not valid.';
				$_SESSION['MSGType'] = 2;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			if(!$valid){
				$_SESSION['MSGBanner'] = 'Error, the file is not valid. Upload images only.';
				$_SESSION['MSGType'] = 2;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			//Make sure that the file doesn't exist already
			if(file_exists($target)){
				$_SESSION['MSGBanner'] = 'Error, the file "'.$_FILES['fileUp']['name'].'" already exists.';
				$_SESSION['MSGType'] = 2;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			//Move the file
			move_uploaded_file($_FILES['fileUp']['tmp_name'], $target);
			
			//Check to make sure it moved, otherwise the perms must be messed up
			if(!file_exists($target)){
				$_SESSION['MSGBanner'] = 'Error, please check your permisions.';
				$_SESSION['MSGType'] = 3;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			//Leave
			$_SESSION['MSGBanner'] = 'Uploaded successfully!';
			$_SESSION['MSGType'] = 1;
			header("location:./?admin&page=file_manager");
			die();
		break;
		
		//Deleting files
		case 'delete':
			
			//Get the filename and filepath of the file to be deleted
			$delete = $_GET['file'];
			$fileToDelete = './data/upload/'.$delete;
			
			//Remove the file and flee!
			unlink($fileToDelete);
			$_SESSION['MSGBanner'] = 'File deleted.';
			$_SESSION['MSGType'] = 1;
			header("location:./?admin&page=file_manager");
			die();
		break;
		
		//Create a directory
		case 'createDir':
		
			$dirName = $_GET['name'];
			
			//Check for the folder
			if(file_exists("./data/upload/".$dirName)){
				$_SESSION['MSGBanner'] = 'The folder "'.$dir.'" already exists.';
				$_SESSION['MSGType'] = 2;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			mkdir("./data/upload/".$dirName);
			$_SESSION['MSGBanner'] = 'Folder created!';
			$_SESSION['MSGType'] = 1;
			header("location:./?admin&page=file_manager");
			die();
		break;
		
		//Folder delete
		case 'fdelete':
			$folder = "./data/upload/".$_GET['file'];
			
			/*Make sure that the folder is empty in the case that someone decided to force the issue 
			 * Even though the file_manager.php should tell the user to clear the folder out before deleting it!
			 */
			if(count(scandir($folder)) > 2){
				$_SESSION['MSGBanner'] = 'The folder "'.$_GET['file'].'" still has files in it. Please remove them first!';
				$_SESSION['MSGType'] = 2;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			//If once it's removed, check it and leave
			rmdir($folder);
			
			if(!file_exists($folder)){
				$_SESSION['MSGBanner'] = 'Folder deleted!';
				$_SESSION['MSGType'] = 1;
				header("location:./?admin&page=file_manager");
				die();
			}
			
			//Otherwise the perms are probably messed up
			else{
				$_SESSION['MSGBanner'] = 'Could not delete folder. Please check permissions.';
				$_SESSION['MSGType'] = 3;
				header("location:./?admin&page=file_manager");
				die();
			}
	}
?>