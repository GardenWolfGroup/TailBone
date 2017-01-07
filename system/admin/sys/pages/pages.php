<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
?>

<h2>What would you like to do?</h2>
<a class="abtn_blue" href="./?admin&page=pages_create">Create a page</a>
<br>
<a class="abtn_blue" href="./?admin&page=pages_edit">Edit a page</a>
<br>
<a class="abtn_blue" href="./?admin&page=pages_delete">Delete a page</a>