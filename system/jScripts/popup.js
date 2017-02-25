console.log("POPMKR: popup maker initiated. ver 0.0103");
console.log("POPMKR: Copyright 2016 Cody Paul Brian");

//create the HTML needed to run the popup.
document.write ('<div id="greyOut" onclick="closePopup(2)" style="position:fixed;display:none;width:100%;height:100%;top:0px;right:0px;background-color:white;opacity:0.6;z-index:9998;"></div>');
document.write ('<div id="popup" style="display:none;position:fixed;top:30%;max-height:50%;left:15%;width:70%;margin:auto;text-align:center;background-color:#587C8C;padding:0px;z-index:9999;color:white;box-shadow: 11px 13px 47px -1px rgba(0,0,0,0.57);"><div style="height:40px;width;100%;background-color:#429A86;padding:0px;margin-top:-22px;"><div id="closePopup" onclick="closePopup(1)">X</div><h1 id="popupTitle"></h1></div><p id="popupText"></p><div id="popupButtons"></div></div>');

//CSS for the buttons and everything else.
var h = document.getElementsByTagName('head').item(0);
var s = document.createElement("style");
s.type = "text/css"; 
s.appendChild(document.createTextNode(".popupButton {background-color: #354D5B;padding: 5px;border-radius: 5px;margin-bottom: 10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.29);display: inline-block;text-decoration: none;width: initial;color: white;margin-left: 10px;margin-left:10px;}.popupButton:hover {background-color: #587c8c;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4), 0 6px 20px 0 rgba(0, 0, 0, 0.39);} #closePopup{background-color:#e05d60; height:40px;width:40px;float:right; margin-left:-40px;line-height:40px;cursor:pointer; font-weight:bold; font-size:20px;} #closePopup:hover{background-color:#f95c60;}"));
h.appendChild(s);

//builds a button.
function buttonMake(text,href,color){
	console.log('POPMKR: Button created.');
	return("<a class='popupButton' style='color:"+color+";' href='"+href+"'>"+text+"</a>");
}

//Builds and shows the popup.
function popup(title,text,btn,btnAction,titleColour,textColour,btnColour){
	document.getElementById("popup").style.display = "initial";
	document.getElementById("greyOut").style.display = "initial";
	document.getElementById("popupTitle").style.color = titleColour;
	document.getElementById("popupTitle").innerHTML = title;
	document.getElementById("popupText").style.color = textColour;
	document.getElementById("popupText").innerHTML = text;
	
	buttons = "<a onclick='closePopup(3)' class='popupButton'>Cancel</a>" + buttonMake(btn, btnAction,btnColour);
	
	document.getElementById("popupButtons").innerHTML = buttons;
	console.log("POPMKR: Made a popup.");
	console.log("POPMKR: Popup title = "+title);
	console.log("POPMKR: Popup title colour = "+titleColour);
	console.log("POPMKR: Popup text = "+text);
	console.log("POPMKR: Popup text colour = "+textColour);
	console.log("POPMKR: Button text = "+btn);
	console.log("POPMKR: Button href = "+btnAction);
	console.log("POPMKR: Button colour = "+btnColour);
}

//closes the popup.
function closePopup(reason){
	switch(reason){
		case 1:
			console.log('POPMKR: Closed popup because X button was clicked.');
		break;
		case 2:
			console.log('POPMKR: Closed popup because grey area was clicked.');
		break;
		case 3:
			console.log('POPMRK: Closed popup because cancel button was clicked.');
		break;
		default:
			console.log('POPMKR: Closed the popup for an unknown reason.');
		break;
	}
	document.getElementById("popup").style.display = "none";
	document.getElementById("greyOut").style.display = "none";
	document.getElementById("popupText").style.color = 'white';
	document.getElementById("popupTitle").style.color = 'white';
}

function closeMSGBanner(){
	document.getElementById("MSG_Banner").style.display = "none";
}