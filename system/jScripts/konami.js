var allowedKeys = {
  37: 'left',
  38: 'up',
  39: 'right',
  40: 'down',
  65: 'a',
  66: 'b',
};

var konamiCode = ['up', 'up', 'down', 'down', 'left', 'right', 'left', 'right', 'b', 'a'];

var konamiCodePosition = 0;

var seen = false;

window.addEventListener('keydown', function(e) {
  var key = allowedKeys[e.keyCode];
  console.log(key);
  var requiredKey = konamiCode[konamiCodePosition];

  if (key == requiredKey) {

    konamiCodePosition++;
    console.log(konamiCodePosition);

    if (konamiCodePosition == konamiCode.length)
      Konami();

  } else
    konamiCodePosition = 0;
});

function Konami(){
  if(seen == false){
    window.scrollTo(0, 0);
  	document.getElementById('barrelRoll').innerHTML = "<link rel='stylesheet' href='./system/main/theme/barrelRoll.css' type='text/css'>";
  	notification("Konami","You have activated cheats. Watch out, cheats are not permitted on some servers...",true,"https://en.wikipedia.org/wiki/Konami_Code","Konami Code - Wikipedia");
  	seen = true;
  }else{
    console.log('Cheats are already activated.');
  }
}