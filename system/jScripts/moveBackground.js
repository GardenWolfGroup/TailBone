var navHeight = document.getElementById('nav').clientHeight;
console.log('%c Background will be moved down '+navHeight+' pixels to account for the size of the navigation div.','background-color:black;color:#429a86;');
document.write('<style>body{background-position:0px '+navHeight+'px!important};</style>');
