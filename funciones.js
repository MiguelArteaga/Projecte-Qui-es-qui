arrayNombreCartas=[];

var sonidocarta= new Audio('sonido/mariosalto.mp3');
var gameover= new Audio('sonido/gameover.mp3');
var gamewin= new Audio('sonido/gamewin.mp3');
var easteregg= new Audio('sonido/aplausos.mp3');
var CartaGirada=0;
var arrayclasses=[];
var contadorfinal=0;
var arraycartas2=[];
var arraycartas3=[];
var arraycartas4=[];
var arraycartasnombre2=[];
var arraycarac=[];
var arraycarac2=[];
var contadoreaster=0;
var variablemodoeasy=0;


function girar(id){
	document.getElementById(id).addEventListener('click',girarcarta);
	girarcarta(id);
	
	if (arrayclasses.includes(id)==false){
		arrayclasses.push(id);
		contadorfinal=contadorfinal+1;
	}
	if(contadorfinal==11){
		finalJuego();
	}
	if(id=="rafa.jpg"){
		contadoreaster=contadoreaster+1;
	}
	if(contadoreaster==10){
		easteregg.play();
		document.getElementById('oculto').innerText="Creadores Del Juego: Cristian Salinas, Marcos Arteaga y Miguel Arteaga";
	}
}


function girarcarta(id2){
	CartaGirada+=1;
	document.getElementById(id2).classList.add('flipped');
	sonidocarta.play();
}

function nombreCartas(id){
	arrayNombreCartas.push(id);
	
}

function finalJuego(){
	for (i=0;i<=arrayNombreCartas.length;i++){
		for (u=0; u<=arrayNombresCartas2.length;u++){
			if (arrayNombresCartas2[u]==arrayNombreCartas[i]){
				delete arrayNombresCartas2[u];

			}

		}

	}


	var UltimaCarta=arrayNombresCartas2.filter(Boolean);
	girarcarta('id13');
	if(UltimaCarta[0]==CartaOculta){
		document.getElementById('p1prova').innerHTML="HAS GANADO!";
		fartificiales();
		gamewin.play();
		preguntar();
		

	}
	else if(UltimaCarta!=CartaOculta) {
		document.getElementById('p1prova').innerHTML="HAS PERDIDO!";
		gameover.play();

	}

}
function activarmodoeasy(){
	variablemodoeasy=1;
	document.getElementById('selectmodos').disabled=true;
}

function activarmodoveryeasy(){
	variablemodoeasy=1;
	document.getElementById('selectmodos').disabled=true;
}


function validarSelect(){
	var selectCombo = document.getElementById("ComboUnico");

	if(selectCombo.value ==0){
    	document.getElementById("mensajeError").innerText = "¡Selecciona al menos una pregunta!";
 	}else{
 		if(variablemodoeasy==1){
 			modoeasy2();
 		}
 		else{
 			validarPregunta();
 		}
 		
 		document.getElementById('botoneasyid').innerText="";
 		document.getElementById('p2prova').innerText=variablemodoeasy;
 		
 	}


}
function modoeasy2(){
	modoeasy();
 	validarPregunta();
}
function modoeasy(){
	var elementoAtrib = document.querySelector('#cartaOculta');
	var hair = elementoAtrib.getAttribute("cabello");
	var glasses = elementoAtrib.getAttribute("gafas");
	var gender = elementoAtrib.getAttribute("sexo");

	var selectCabello = document.getElementById("OptCabello");
	var selectGafas = document.getElementById("OptGafas");
	var selectSexo = document.getElementById("OptSexo");
	if(gender=="hombre<br"){
		gender="hombre";
	}
	else if(gender=="mujer<br"){
		gender="mujer";
	}
	
	for(var i=0;i<arraycartas.length;i++){
		arraycartas2=String(arraycartas[i]).split(",");
		arraycartas3=arraycartas2.filter(Boolean);
		arraycartas4.push(arraycartas3);
	}
	for (var i=0;i<arraycartasnombres.length;i++){
		arraycartasnombre2.push(arraycartasnombres[i][0]);
	}
	
	for(var i=0;i<arraycartas4.length;i++){
		arraycarac=String(arraycartas4[i]).split(",");
		arraycarac2.push(arraycarac);
	}
	for(var i=0;i<arraycarac2.length;i++){
		arraycarac2[i].push(arraycartasnombre2[i]);
	}
	
	

	if(selectCabello.value!=0){
		for (var i=0;i<arraycarac2.length;i++){
			if(hair!=arraycarac2[i][3]){
				if(arraycarac2[i][3]==selectCabello.value){
					girar(arraycarac2[i][7]);
				}
				else if(hair==selectCabello.value){
					if(hair!=arraycarac2[i][3]){
						girar(arraycarac2[i][7]);
					}
				}
			}
		}	
	}
	//document.getElementById('OptCabello').value = 0;
	else if(selectGafas.value!=0){
		for (var i=0;i<arraycarac2.length;i++){
			if(glasses!=arraycarac2[i][1]){
				if(arraycarac2[i][1]==selectGafas.value){
					girar(arraycarac2[i][7]);
				}
				else if(arraycarac2[i][1]!=glasses){
					girar(arraycarac2[i][7]);
				}
				
			}
		}
	}
	//document.getElementById('OptGafas').value = 0;
	else if (selectSexo.value!=0) {
		for (var i=0;i<arraycarac2.length;i++){
			if(arraycarac2[i][5]=="hombre<br"){
				gender2="hombre";
			}
			else if(arraycarac2[i][5]=="mujer<br"){
				gender2="mujer";
			}
			if(gender!=gender2){
				if(gender2==selectSexo.value){
					girar(arraycarac2[i][7]);
				}
				else if(gender2!=gender){
					girar(arraycarac2[i][7]);
				}
				
			}
		}
	}
	//document.getElementById('OptSexo').value = 0;
	
}

var contador = 0;
var PreguntaHecha = 0;
var CartaNoGirada =0;

function mensajeAviso(){
	if(PreguntaHecha==1 && CartaNoGirada == CartaGirada){
		confirmarMensajeAviso();
	}else if(PreguntaHecha>=1 && CartaNoGirada == CartaGirada){

	}else{
		PreguntaHecha =0;
	}
	CartaNoGirada=CartaGirada;
	PreguntaHecha+=1;
}
function confirmarMensajeAviso(){
	var opcion = confirm("¿Seguro que quieres realizar otra pregunta sin girar ninguna carta?");
	if(opcion==true){
		
		document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
	}else{
		contador=contador-1;
		document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
		document.getElementById("mensajeError").innerText = "";
		document.getElementById("mensajeCorrecto").innerText ="";
	}
}

function validarPregunta(){
	var elementoAtrib = document.querySelector('#cartaOculta');
	var hair = elementoAtrib.getAttribute("cabello");
	var glasses = elementoAtrib.getAttribute("gafas");
	var gender = elementoAtrib.getAttribute("sexo");
	var selectCombo = document.getElementById("ComboUnico");
	
	if(gender=="hombre<br"){
		gender="hombre";
	}
	else if(gender=="mujer<br"){
		gender="mujer";
	}
	if(selectCombo.value==hair){
		document.getElementById("mensajeCorrecto").innerText = "Sí, tiene el color de pelo "+hair+".";
		document.getElementById("mensajeError").innerText = "";
		contador=contador+1;
		document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
		document.getElementById('ComboUnico').value = 0;
		desactivarColorIncorrecto()
		activarColorCorrecto();
	}else if(selectCombo.value==glasses){
		document.getElementById("mensajeCorrecto").innerText = glasses+" tiene gafas esta persona.";
		contador=contador+1;
		document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
		document.getElementById('ComboUnico').value =0;
		document.getElementById("mensajeError").innerText = "";
		desactivarColorIncorrecto()
		activarColorCorrecto();
	}else if(selectCombo.value==gender){
		document.getElementById("mensajeCorrecto").innerText = "Sí, es "+gender+".";
		document.getElementById("mensajeError").innerText = "";
		contador=contador+1;
		document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
		document.getElementById('ComboUnico').value = 0;
		desactivarColorIncorrecto()
		activarColorCorrecto();
	}
	desactivarColorIncorrecto()
}
function pedirnombre() {
    var person = prompt("Introduce tu nombre", "Nombre");
   
}

function preguntar(){
    var mensaje = confirm("¿Quieres guardar tu puntuación?");
    if (mensaje) {
        pedirnombre();

    }
}

function fartificiales(){
	set_width();
    write_fire();
    launch();
    setInterval('stepthrough()', speed);
	
}
function write_fire() {
	var b, s;
	b=document.createElement("div");
	s=b.style;
	s.position="absolute";
	b.setAttribute("id", "bod");
	document.body.appendChild(b);
	set_scroll();
	set_width();
	b.appendChild(div("lg", 3, 4));
	b.appendChild(div("tg", 2, 3));
	for (var i=0; i<bits; i++) b.appendChild(div("bg"+i, 1, 1));
}
function div(id, w, h) {
	var d=document.createElement("div");
	d.style.position="absolute";
	d.style.overflow="hidden";
	d.style.width=w+"px";
	d.style.height=h+"px";
	d.setAttribute("id", id);
	return (d);
}
function bang() {
	var i, X, Y, Z, A=0;
	for (i=0; i<bits; i++) {
	X=Math.round(Xpos[i]);
	Y=Math.round(Ypos[i]);
	Z=document.getElementById("bg"+i).style;
	if((X>=0)&&(X<swide)&&(Y>=0)&&(Y<shigh)) {
	Z.left=X+"px";
	Z.top=Y+"px";
	}
	if ((decay[i]-=1)>14) {
	Z.width="3px";
	Z.height="3px";
	}
	else if (decay[i]>7) {
	Z.width="2px";
	Z.height="2px";
	}
	else if (decay[i]>3) {
	Z.width="1px";
	Z.height="1px";
	}
	else if (++A) Z.visibility="hidden";
	Xpos[i]+=dX[i];
	Ypos[i]+=(dY[i]+=1.25/intensity);
	}
	if (A!=bits) setTimeout("bang()", speed);
}

function stepthrough() {
	var i, Z;
	var oldx=xpos;
	var oldy=ypos;
	xpos+=dx;
	ypos-=4;
	if (ypos<bangheight||xpos<0||xpos>=swide||ypos>=shigh) {
	for (i=0; i<bits; i++) {
	Xpos[i]=xpos;
	Ypos[i]=ypos;
	dY[i]=(Math.random()-0.5)*intensity;
	dX[i]=(Math.random()-0.5)*(intensity-Math.abs(dY[i]))*1.25;
	decay[i]=Math.floor((Math.random()*16)+16);
	Z=document.getElementById("bg"+i).style;
	Z.backgroundColor=colours[colour];
	Z.visibility="visible";
	}
	bang();
	launch();
	}
	document.getElementById("lg").style.left=xpos+"px";
	document.getElementById("lg").style.top=ypos+"px";
	document.getElementById("tg").style.left=oldx+"px";
	document.getElementById("tg").style.top=oldy+"px";
}
function launch() {
	colour=Math.floor(Math.random()*colours.length);
	xpos=Math.round((0.5+Math.random())*swide*0.5);
	ypos=shigh-5;
	dx=(Math.random()-0.5)*4;
	bangheight=Math.round((0.5+Math.random())*shigh*0.4);
	document.getElementById("lg").style.backgroundColor=colours[colour];
	document.getElementById("tg").style.backgroundColor=colours[colour];
}

function set_scroll() {
	var sleft, sdown;
	if (typeof(self.pageYOffset)=="number") {
	sdown=self.pageYOffset;
	sleft=self.pageXOffset;
	}
	else if (document.body.scrollTop || document.body.scrollLeft) {
	sdown=document.body.scrollTop;
	sleft=document.body.scrollLeft;
	}
	else if (document.documentElement && (document.documentElement.scrollTop || document.documentElement.scrollLeft)) {
	sleft=document.documentElement.scrollLeft;
	sdown=document.documentElement.scrollTop;
	}
	else {
	sdown=0;
	sleft=0;
	}
	var s=document.getElementById("bod").style;
	s.top=sdown+"px";
	s.left=sleft+"px";
}

window.onresize=set_width;
function set_width() {
	if (typeof(self.innerWidth)=="number") {
	swide=self.innerWidth;
	shigh=self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientWidth) {
	swide=document.documentElement.clientWidth;
	shigh=document.documentElement.clientHeight;
	}
	else if (document.body.clientWidth) {
	swide=document.body.clientWidth;
	shigh=document.body.clientHeight;
	}
}
function activarColorCorrecto(){
	document.getElementById("mensajeCorrecto").className='animacion';
}
function desactivarColorCorrecto(){
	document.getElementById("mensajeCorrecto").className='';
}
function activarColorIncorrecto(){
	document.getElementById("mensajeError").className='animacion';
}
function desactivarColorIncorrecto(){
	document.getElementById("mensajeError").className='';
}
function habilitarBotonPregunta(){
	var ComboUnico = document.getElementById("ComboUnico");
	var boton = document.getElementById("pregunta");
	boton.disabled = !ComboUnico.value;
}
