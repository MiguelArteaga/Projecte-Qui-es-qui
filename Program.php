<html>
  <head>
    <title></title>
    <script type='text/javascript'>
//<![CDATA[
// Fuegos artificiales
var bits=300; // Número de puntos
var intensity=50; // Intensidad de la explosión (recomendado entre 3 y 10)
var speed=10; // Velocidad (a menor numero, mas rapido)
var colours=new Array("#03f", "#f03", "#0e0", "#93f", "#0cc", "#f93");
// Colores de los fuegos

var dx, xpos, ypos, bangheight;
var Xpos=new Array();
var Ypos=new Array();
var dX=new Array();
var dY=new Array();
var decay=new Array();
var colour=0;
var swide=1000;
var shigh=1000;
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
window.onscroll=set_scroll;
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
window.onload=function() { if (document.getElementById) {
set_width();
write_fire();
launch();
setInterval('stepthrough()', speed);
}}
//]]>
</script>
  </head>

  <body>
    <?php
    #Arrays que usaremos
    $arrayImg = array();
    $arrayGeneral = array();
    $arrayNombres = array();
    $Carac = array();
    #Lectura de fichero.
    $Img = fopen("imatges.txt", "r") or die("Error al leer documento.");
    while(!feof($Img)){
      $linea=fgets($Img);
      $saltodelinea=nl2br($linea);
      array_push($arrayImg, $saltodelinea);
    }
    fclose($Img);

    # Añadimos el fichero en un array
    foreach ($arrayImg as $key => $i) {
      $names = explode(":",$i);
      array_push($arrayGeneral, $names);
    }
    # Creacion de array nombres
    $longGnl = count($arrayGeneral);
    for($i = 0; $i<$longGnl;$i++){
      array_push($arrayNombres, $arrayGeneral[$i][0]);
    }
    # Creacion de array caracteristicas
    for($i=0;$i<$longGnl;$i++){
      array_push($Carac, $arrayGeneral[$i][1]);
    }

    # 1. Una misma imagen (nombre de imagen) aparece dos veces en el archivo img.txt

    if(count($arrayNombres)>count(array_unique($arrayNombres))){
      $Logs = fopen("logs.txt", "w");
      fwrite($Logs, "¡Error! Hay un nombre repetido en el archivo imatges.txt.");
      fclose($Logs);
      echo"<h2>¡Error! Hay un nombre repetido en el archivo imatges.txt.</h2>";
    }elseif(count($Carac)>count(array_unique($Carac))){
      print_r("klk");
      $Log = fopen("logs.txt", "w");
      fwrite($Log, "¡Error! Hay caracteristicas repetidas en el archivo imatges.txt.");
      fclose($Log);
      echo"<h2>¡Error! Hay caracteristicas repetidas en el archivo imatges.txt.</h2>";
    }
    else{
    
    $arrayRandom=[];

    $numeros=range(0,11);
    shuffle($numeros);
    foreach ($numeros as $value) {
      array_push($arrayRandom,$value);
    }
    $arrayGeneral2=[];
    foreach ($numeros as $value) {
      array_push($arrayGeneral2, $arrayGeneral[$value][0]);
    }
    echo"<link href='estilos-quien-es-quien.css' type='text/css' rel='stylesheet' >";
    $cartaoculta = $arrayGeneral2[0];
    $img = $arrayGeneral2;
    $div = ['div1','div2','div3','div4','div5','div6','div7','div8','div9','div10','div11'];
    
    echo "<table>";
    $i=0;
    foreach ($img as $fotos) {
      if( substr($fotos,-3)=="jpg" or substr($fotos,-3)=="png" or substr($fotos,-4)=="jpeg"){
        if ($cartaoculta!=$fotos){
          echo "<div class=$div[$i]>";
          echo "<img src='imagenes/$fotos' width='120' height='120'>";
          echo "</div>";
          $i=$i+1;
        }else{
          echo "<div class='divoculta'>";
          echo "<img src='imagenes/$fotos' width='150' height='150'>";
          echo "</div>";
        }
    }
    }
    }
    ?>
    <form action="#" method="post">
      <div class="general">
      <div class="caja1">
        <p id="cabello">Cabello</p>
        <select name="OptCabello[]">
          <option value="Seleciona">Selecciona</option>
          <option value="Rubio">Rubio</option>
          <option value="Moreno">Moreno</option>
          <option value="Castany">Castany</option>
        </select>
      </div>
      <div class="caja2">
        <p id="gafas">Gafas</p>
        <select name="OptGafas[]">
          <option value="Seleciona">Selecciona</option>
          <option value="Si">Si</option>
          <option value="No">No</option>
        </select>
      </div>
      <div class="caja3">
        <p id="sexe">Sexo</p>
        <select name="OptSexo[]">
          <option value="Seleciona">Selecciona</option>
          <option value="Hombre">Hombre</option>
          <option value="Mujer">Mujer</option>
        </select>
      </div>
    </div>
    </form>
    <div class="boton">
    <input type="submit" name="enviar" value="Enviar"/>
    </div>

  </div>
  </body>
</html>
