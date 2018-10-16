function adivinaCarta() {
	//var cartas=[['noelia','si','castaño','mujer'],['manolo','si','castaño','hombre'],['elisa','no','moreno','mujer'],
	//['jorge','si','moreno','hombre'],['pablo','no','rubio','hombre'],['tatiana','no','rubio','mujer'],['maria','no','castaño','mujer']];
	
	var cartas=arrayJS.value;
	//for(var i=0;i<arrayJS.length;i++){

      //s  document.write("<br>"+arrayJS[i]);}
	var i=Math.floor((Math.random() * 7));
	document.getElementById('cartaAdivinar').innerHTML=cartas[i];
	
}