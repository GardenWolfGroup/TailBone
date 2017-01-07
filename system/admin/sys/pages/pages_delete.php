<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
?>
<h2>Select a page to delete</h2>
<?PHP
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
?>
