document.write('<span id="JsStyle"></span>');
function adjustToScreen(){
	var navHeight = document.getElementById('nav').clientHeight + 2;
	var contentMove = navHeight + 20;
	console.log('%c Background will be moved down '+navHeight+' pixels to account for the size of the navigation div.','background-color:black;color:#429a86;');
	document.getElementById('JsStyle').innerHTML = '<style>body{background-position:0px '+navHeight+'px!important} #content{margin-top:'+contentMove+'px!important;} #MSG_Banner{margin-top:'+navHeight+'px!important;}</style>';
}
document.onload = adjustToScreen();
window.onresize = function(){adjustToScreen();};