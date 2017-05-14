notified = false;

function notification(title,text,button,action,btnText){
	if(!notified){
		document.getElementById("mNContentTitle").innerHTML = title;
		document.getElementById("mNContentText").innerHTML = text;
		notified = true;
		document.getElementById("materialNotif").style.display = 'initial';
		if(button){
			document.getElementById("mNButton").style.display = 'block';
			document.getElementById("mNButton").innerHTML = btnText;
			document.getElementById("mNButton").onclick = function(){closeNotification(); window.open(action);};
		}else{
			document.getElementById("mNButton").style.display = 'none';
			document.getElementById("mNButton").innerHTML = "undefined";
			document.getElementById("mNButton").onclick = "";
		}
	}else{
		document.getElementById("mNContentTitle").innerHTML += " || "+title;
		document.getElementById("mNContentText").innerHTML += " || "+text;
	}
}
function closeNotification(){
	document.getElementById("mNContentTitle").innerHTML = 'Undefined';
	document.getElementById("mNContentText").innerHTML = 'Undefined';
	notified = false;
	document.getElementById("materialNotif").style.display = 'none';
}

function AlertJS(text){
	notification('Alert', text)
}