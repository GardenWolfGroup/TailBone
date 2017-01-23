console.log('MSGBANNER');
function closeMsgBanner(){
	document.getElementById("MSG_Banner").style.display = 'none';
	console.log('MSGBANNER CLOSED');
}

window.onload = function(){
	console.log('onload');
	msgBanner = document.getElementById("MSG_Banner");
	if(msgBanner){
		console.log('MSGBANNER TRUE');
		setTimeout(closeMsgBanner,5000);
	}
	
}