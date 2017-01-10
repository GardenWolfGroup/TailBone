consoleVars = 'background-color:black;color:#429a86;';
function checkLoggedin(data){
	console.log("%c Checking keepalive.",consoleVars);
	if(data != "true"){
		location.href="./";
	}else{
		console.log("%c Session is still alive.",consoleVars);
	}
}
document.write('<iframe src="./index.php?admin&request&action=keepalive" onload="checkLoggedin(this.contentDocument.body.innerHTML);" id="keepSessionAlive" style="display:none;"></iframe>');
window.setInterval(function(){
  keepAlive();
}, 30000);
							
function keepAlive() {
	console.log("%c Keeping session alive.",consoleVars);
	document.getElementById("keepSessionAlive").src = "./index.php?admin&request&action=keepalive";
}
