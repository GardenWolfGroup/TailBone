console.log("AlertJS started.");

document.write('<div id="alertJS" onclick="closeAlertJS()" style="z-index:991; display:none; position:absolute; padding:10px; background:#25282C; border-radius:5px; border:1px solid #101010;"><div id="alertJSInner" style=" padding:5px; border-radius:5px; font-weight:bold;"></div></div>');

function AlertJS(text,top,left,colour,autoClose,startChar){
	left = left + 64;
	document.getElementById("alertJS").style.display = "initial";
	document.getElementById("alertJS").style.top = top+"px";
	document.getElementById("alertJS").style.left = left+"px";
	document.getElementById("alertJSInner").innerHTML = startChar+" "+text;
	switch (colour){
		case 1:
			document.getElementById("alertJSInner").style.background = "#429A86";
			document.getElementById("alertJSInner").style.color = "white";
		break;
		case 2:
			document.getElementById("alertJSInner").style.background = "#FBF174";
			document.getElementById("alertJSInner").style.color = "black";
		break;
		case 3:
			document.getElementById("alertJSInner").style.background = "#FF6961";
			document.getElementById("alertJSInner").style.color = "white";
		break;
	}
	if(autoClose){
		setTimeout(closeAlertJS,5000);
	}
}

function closeAlertJS(){
	document.getElementById("alertJS").style.display = "none";
	document.getElementById("alertJSInner").innerHTML = "";
}
