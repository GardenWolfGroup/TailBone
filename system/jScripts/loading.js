//loading...
function closeMsgBanner(){
	document.getElementById("MSG_Banner").style.display = 'none';
}

window.onload=function(){
	document.getElementById("loadingOver").style.display = "none";
	msgBanner = document.getElementById("MSG_Banner");
	if(msgBanner){
		setTimeout(closeMsgBanner,5000);
	}
}

function showLoader(){
	document.getElementById("loadingOver").style.display = "initial";
}