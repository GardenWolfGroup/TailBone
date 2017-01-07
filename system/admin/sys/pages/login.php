<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	
	//begin the HTML!!
?>
<center>
	<?PHP
		//Checks to see if the server is running https, if not, let the user know.
		if(isset($_SERVER['HTTPS'])){
			if(!$_SERVER['HTTPS'] == 'on'){
				echo('<script>AlertJS("You are not using https!",10,10,2,true,"&#64;");</script>');
			}
		}else{
			echo('<script>AlertJS("You are not using https!",10,10,2,true,"&#64;");</script>');
		}

		//check and see if an error was produced from a previous login attempt.
		if(isset($_GET['error'])){
			if($_GET['error'] == 'NEU'){ //non-existant user.
				echo('<h2 style="color:red;">User does not exist.</h2>');
			}elseif($_GET['error'] == 'IP'){ //invalid password.
				echo('<h2 style="color:red;">Invalid password.</h2>');
			}elseif($_GET['error'] == 'disabled'){ //user is disabled.
				echo('<h2 style="color:red;">Sorry, your account is disabled.</h2>');
			}elseif($_GET['error'] == 'unknown'){ //We have no f* clue what happened.
				echo('<h2 style="color:red;">An unknown system error occoured.</h2>');
			}
		}
	?>
	
	<h3>Please enter your credentials to login.</h3>
	<br>
	<form action="./?admin&request&action=loginSubmit" method="post">
		<input class="fancy_input" type="text" name="user" placeholder="User" value="<?PHP if(isset($_GET['user'])){echo($_GET['user']);} ?>"><br>
		<input class="fancy_input" type="password" name="pass" placeholder="Password"><br>
		<br>
		<input class="fancy_input" type="submit" value="Login">
	</form>
	<br>
	<div style="width:90%;margin;auto;text-align:center;">
		<p><?PHP echo($settings["loginNotice"]); ?></p>
	</div>
</center>