function adivinaCarta() {
	var cartas=[['rafa','si','castaño','hombre'],['manolo','no','moreno','hombre']];
	var i=Math.floor((Math.random() * 2));
	document.getElementById('cartaAdivinar').innerHTML=cartas[i];
	
}