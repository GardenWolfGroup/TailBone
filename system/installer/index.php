<?php
	header('HTTP/1.1 403');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="theme-color" content="#429A86">
		<meta name="viewport" content="width=device-width, initial-scale=1.00, maximum-scale=1.00, minimum-scale=1.00, user-scalable=no"/>
		<title>TailBone - 403</title>
		<style>
			html{
				height:100%;
				width:100%;
			}
			body{
				background:#354D5B;
			}
			#content{
				background:#587c8c;
				box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
				width:70%;
				min-height:90px;
				margin-top:20px;
				margin-left:auto;
				margin-right:auto;
				padding:10px;
				color:white;
				font-family:Tahoma,Geneva,sans-serif;
				margin-bottom:40px;
			}
			hr{
				border-color:white;
			}
			#topper{
				background:#429A86;
				background-color:#FF6961;
				width:calc(100%+10px;);
				margin-left:-10px;
				margin-right:-10px;
				margin-top:-10px;
				margin-bottom:10px;
				text-align:center;
			}
			#ender{
				background:#3D62BA;
				height:25px;
				width:calc(100%+10px;);
				margin-left:-10px;
				margin-right:-10px;
				margin-top:15px;
				margin-bottom:-10px;
				text-align:center;
			}
			#icon{
				display:inline-block;
				background:#354D5B;
				border-radius:5px;
				float:left;
				margin-right:-38px;
				margin-top:2px;
				margin-left:2px;
			}
			@media only screen and (max-width: 600px) {
			    #icon {
			        display: none;
			    }
			}
		</style>
	</head>
	
	<body>
		<div id="content">
			<div id="topper">
				<h2 style="display:inline-block;color:#354D5B;padding:0px;margin:0px;">TailBone 403</h2>
			</div>
			<h1 style="text-align:center;">Sorry, you are not allowed to be here.</h1>
			<div id="ender">
				<p>TailBone - The Garden Wolf Group</p>
			</div>
		</div>
	</body>
</html>