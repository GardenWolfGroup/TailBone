<?PHP
	//Validate the running page  (should be index.php in the root of the webserver)
	if(!$runningInIndex){
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
?>
<h2>--Change your password--</h2>
<form action="./?admin&request&action=users&intent=edit" method="post">
	<?php
	
		/*looks to see if TailBone is being hosted on a server meant for TailBone, if so, looks to see if the current user is
		* the system admin. If it is, go ahead and show a picker for users instead of only allowing the user to edit his or her own password.
		*/
		if($hosted && $_SESSION['user'] == $serverVars['serverAdmin']){
			echo('<select id="userName" name="user" class="fancy_input">');
			foreach(getUsers() as $key => $value){
				if($key != $serverVars['serverAdmin']){
					echo('<option value="'.$key.'">'.ucfirst($key).'</option>');
				}
			}
			echo('</select><br>');
		}else{
			echo('<input class="fancy_input" name="oldPass" type="password" placeholder="Old password"><br>');
		}
	?>
	
	<input class="fancy_input" name="newPass" type="password" placeholder="New password" id="nP"><br>
	<input class="fancy_input" name="newPassVerify" type="password" placeholder="Verify" id="vF"><span id="cPT"></span><br>
	<input type="submit" class="fancy_input" value="Update password" id="passSubmit">
</form>
<h2>--Create a user--</h2>
<form action="./?admin&request&action=users&intent=create" method="post">
	<input class="fancy_input" name="name" type="text" placeholder="Username"><br>
	<input class="fancy_input" name="pass" type="password" placeholder="Password"><br>
	<input type="submit" class="fancy_input" value="Create">
</form>
<h2>--Delete a user--</h2>
<p>You cannot delete the current user.</p>
		<?php
			$userNum = 0;
			
			//checking to see if TailBone is on a server for TB. If it is, make sure the server admin is not displayed in the user selector.
			foreach(getUsers() as $key){
				if($key != $_SESSION['user']){
					$userNum += 1;//just counting up.
					//setting the arguments for the delete popup.
					$delPopupPrams = "'Delete','Are you sure you want to delete the user ".$key."?','Yes','./?admin&request&action=users&intent=delete&user=".$key."'";
					//shows the users.
					echo('<div style="background-color:'.$theme['bodyBackground'].';margin-bottom:50px;"><p style="line-height:40px;margin-bottom:-40px;margin-left:5px;">'.$userNum.'. '.$key.'</p><div style="float:right;margin:5px;"><a onclick="popup('.$delPopupPrams.')" class="abtn_blue" style="display:inline-block;" alt="Delete file">Delete</a></div></div>');
				}
			}
		?>
		
<script>
		//sets the elements.
		nP = document.getElementById('nP');
		vF = document.getElementById('vF');
		cPT = document.getElementById('cPT');
		pS = document.getElementById('passSubmit');
		
		//disables the submit button.
		pS.disabled = true;
		
		//making sure the verify box can be used.
		if(vF){
			//if it can be, go ahead and add the key listener.
			vF.addEventListener("keyup", function (evt) {
			    checkPass();
			}, false);
		}
		
		//checks the passwords on every key up. this is to make sure the new password and the verify are the same.
		function checkPass(){
			if(nP.value == vF.value){
				vF.style.background = '#429A86';
				cPT.innerHTML = '';
				pS.disabled = false;
			}else{
				vF.style.background = '#FF6961';
				cPT.style.color = '#FF6961';
				cPT.innerHTML = "Passwords don't match!";
				pS.disabled = true;
			}
		}
</script>