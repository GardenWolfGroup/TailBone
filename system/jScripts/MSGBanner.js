MSGBanner = document.getElementById("MSG_Banner");
console.log('MSGBANNER');
function closeMsgBanner(){
	if(MSGBanner){
	MSGBanner.style.display = 'none';
		console.log('MSGBANNER CLOSED');
	}else{
		console.log('No MSGBanner to close. Sleeping.');
	}
}
setTimeout(closeMsgBanner,5000);