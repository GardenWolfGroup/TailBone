<?PHP
	//Fuck this again, I'm getting a hard drink. Cody! CLEAN UP YOUR SHIT!
	if(isset($runningInIndex) && isset($installing) && $installing == true){
		//carry on
	}else{
		header('HTTP/1.0 403 Forbidden');
		die('403 FORBIDDEN: You are not allowed to access that file outside its normal running location.');
	}
	$pageName = 'installing';
	
	
	if(is_writable('./data/')){
		$permsGood=true;
	}else{
		$permsGood=false;
	}
?>

<!DOCTYPE html>
<html>
	
	<head>
		
		<?php
			require('./system/universal/headers.php');
		?>
		
		<title>TailBone Installer</title>
		
	</head>
	<body>
		<img src="./data/logo/favicon-96x96.png?<?php echo($TB['version']) ?>" id="icon" alt="Site Icon"/>
		
		<div id="nav">
			
			<div id="nav-navigation">
				<a href="#"><div class="nav_installing">Installer</div></a>
			</div>
			
		</div>
		<div id="content">
			
			<div id="topper">
				<h1>Installing TailBone</h1>
			</div>
			
				<div style="text-align:center;">
					
					<p><span style="color:red;">*</span> = required.</p>
					
					<p>
						<!-- Tell the user if they need to fix file permissions -->
						<?php
							if($permsGood){
								echo('<span style="color:#283A47;background-color:#429A86;">Perms are good!</span>');
							}else{
								echo('<span style="color:red;background-color:black;">Please change the permissions of the data so that the HTTP user can write to it.</span>');
							}
						?>
					</p>
					
					<!-- Form for sending install data -->
					<form method="post" action="./?submitInstall">
						<!-- Admin user name -->
						<input type="text" class="fancy_input" name="adminUsername" required placeholder="Admin username"><span style="color:red;">*</span><br>
						
						<!-- admin password -->
						<input type="password" class="fancy_input" name="adminPassword" required placeholder="Admin password" id="Password"><span style="color:red;">*</span><br>
						
						<!-- Re type password to verify it (JS will check this.)-->
						<input type="password" class="fancy_input" required placeholder="Verify password" id="verify"><span style="color:red;">*</span><br>
						
						<!-- If the passwords do not match, JS will tell you here. -->
						<span id="verifyMessage"></span><br>
						
						<!-- Name your site! -->
						<input type="text" class="fancy_input" name="siteName" required placeholder="Site name"><span style="color:red;">*</span><br>
						
						<!-- Site author -->
						<input type="text" class="fancy_input" name="siteAuthor" required placeholder="Site author"><span style="color:red;">*</span></br>
						
						<!-- Go ahead and submit! -->
						<input class="fancy_input" type="submit" disabled value="Install!" id="Submit">
					</form>
				</div>
				
			<!-- Footer -->
			<div id="ender">
				<p style="text-align:center;">TailBone <?php echo($TB['version']); ?></p>
			</div>
			
		</div>
		<p style="text-align:center;color:grey;font-size:12px;margin-bottom:0px;">Powered by<br><a href="http://tailbone.gardenwolf.com/" target="_blank" style="color:grey;text-decoration:none;font-weight:bold;"><img src="./system/main/theme/img/tailbone.png?2" style="width:75px;"/></a><br><a style="color:grey;" href="https://github.com/Toshib-htr/Tailbone/blob/master/LICENSE.md" target="0">License</a></a><br><br><a href="?admin" style="color:grey;">Admin panel</a></p><br><br>
		
		<!-- Password checking script, also does file perms check. -->
		<script>
			//Starts getting elements
			Password = document.getElementById('Password');
			verify = document.getElementById('verify');
			verifyMessage = document.getElementById('verifyMessage');
			formSubmit = document.getElementById('Submit');
			
			//looks to see if PHP has reported that perms are good.
			permsAreGood = <?PHP echo($permsGood); ?>;
			
			//start listening for keys in the verify passowrd box.
			verify.addEventListener("keyup", function (evt) {
			    checkPass(Password, verify, verifyMessage);
			}, false);
			
			//assuming that persm are go, go ahead and do the following.
			if(permsAreGood){
				
				//watches to see if the paswords match and changes HTML acordingly.
				function checkPass(password, verification, message){
				
					//Matching passwords
					if(password.value == verification.value){
						verification.style.background = '#429A86';
						message.innerHTML = '';
						formSubmit.disabled = false;
					}
					
					//Non-matching passwords
					else{
						verification.style.background = '#FF6961';
						message.style.color = '#FF6961';
						message.innerHTML = "Passwords don't match!";
						formSubmit.disabled = true;
					}
				}
			}else{
				formSubmit.disabled = true;
			}
		</script>
	</body>
</html>