<!DOCTYPE html>
<html>
<head>
	<title></title>
    <script type="text/javascript" src="funciones2.js"></script>
	 <link href='estilos-quien-es-quien.css' type='text/css' rel='stylesheet' >
</head>
<body>
	<?php

    $Imagenes = fopen("imatges.txt", "r");
    $ImageInfo = array();
    $ImageNombre = array();
    $ImageDatos = array();
    $ImageGeneral = array();

    while(!feof($Imagenes)){
      $linea=fgets($Imagenes);
      array_push($ImageInfo, $linea);
    }
    fclose($Imagenes);
    //print_r($Image);
    for($a=0;$a<count($ImageInfo);$a++){
      $SinPuntoComa = str_replace(":", " ", $ImageInfo[$a]);
      $SinComas = str_replace(",", "", $SinPuntoComa);
      $Info = explode(" ",$SinComas);
      array_push($ImageGeneral, $Info);
    }

    
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
    $cartaoculta = $arrayGeneral2[0];
    $img = $arrayGeneral2;
    $arrayDiv = [];
    $arrayId= [];
    $divs=range(1,12);
    shuffle($divs);
    foreach ($divs as $valor) {
      array_push($arrayDiv,"card".$valor);
      array_push($arrayId,"id".$valor);
    }
    $DatosPersonajes = array();
    $lgnl = count($arrayGeneral);
    for($e=0;$e<$lgnl;$e++){
      $prueba = explode(",", $arrayGeneral[$e][1]);
      array_push($DatosPersonajes, $prueba);
    }
    $AtributosCabello = array();
    $AtributosGafas = array();
    $AtributosSexo = array();
    $logitudp = count($DatosPersonajes);

    #Creando array AtributosCabello
    for($c=0;$c<$logitudp;$c++){
      $DatosC = explode(" ", $DatosPersonajes[$c][1]);
      array_push($AtributosCabello, $DatosC);
    }
    #Creando array AtributosGafas
    for($a=0;$a<$logitudp;$a++){
      $DatosG = explode(" ", $DatosPersonajes[$a][0]);
      array_push($AtributosGafas, $DatosG);
    }
    #Creando array AtributosSexo
    for($s=0;$s<$logitudp;$s++){
      $DatosS = explode(" ", $DatosPersonajes[$s][2]);
      array_push($AtributosSexo, $DatosS);
    }
    //Posicion 3 y 7esta vacia (?)
    //gafas si >2
    //cabello > 4
    //sexp > 8
    $a=4;
    $b=2;
    $c=8;
    $i=0;
    print_r($ImageGeneral[2][0]);
    foreach ($img as $fotos) {
      if( substr($fotos,-3)=="jpg" or substr($fotos,-3)=="png" or substr($fotos,-4)=="jpeg"){
        echo "<div id='$fotos' onclick='girar(this.id)' class='$arrayDiv[$i]'>";
        echo "<div><img class='imgfront' id='$fotos' onclick='nombreCartas(this.id)' src='imagenes/$fotos' width='100' height='100'></div>";
        echo "<div class='back'><img class='imgback'src='imagenes2/reversos.jpg' width='100' height='100'></div>";
        echo "</div>";
        $i=$i+1;
        if ($cartaoculta==$fotos) {
          echo "<div id='id13' class='divoculta'>";
          echo "<div><img class='imgback'src='imagenes2/reversos.jpg' width='150' height='150'></div>";
          for($p=0;$p<count($ImageGeneral);$p++){
            if($cartaoculta==$ImageGeneral[$p][0]){
              $AtCabello = $ImageGeneral[$p][$a];
              $AtGafas = $ImageGeneral[$p][$b];
              $AtSexo = $ImageGeneral[$p][$c];
            }
          }
         echo"<div class='back'><img class='imgfront' id='cartaOculta' src='imagenes/$fotos' width='160' height='150' cabello='$AtCabello' gafas='$AtGafas' sexo='$AtSexo'></div>";
          echo "</div>";
        }
    }
    }
   
    
  /*
if(selectCombo.value=='si'){
    if(glasses=="si"){
      document.getElementById("mensajeCorrecto").innerText = "Si tiene gafas.";
      document.getElementById("mensajeError").innerText = null;
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      document.getElementById('ComboUnico').value = 0;
      desactivarColorIncorrecto()
      activarColorCorrecto();
    }else if(glasses=!'si'){
      document.getElementById("mensajeError").innerText = "No tiene gafas.";
      document.getElementById("mensajeCorrecto").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      //Llamar funcion se parpadeo rojo.
    }
  }
  if(selectCombo.value=='moreno'){
    if(hair=="moreno"){
      document.getElementById("mensajeCorrecto").innerText = "Sí, tiene el color de pelo "+selectCombo.value+".";
      document.getElementById("mensajeError").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      document.getElementById('ComboUnico').value = 0;
      desactivarColorIncorrecto()
      activarColorCorrecto();
    }else if(hair!='moreno'){
      document.getElementById("mensajeError").innerText = "No tiene el color de pelo "+selectCombo.value+".";
      document.getElementById("mensajeCorrecto").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      //Llamar funcion se parpadeo rojo.
    }
  }
  if(selectCombo.value=='rubio'){
    if(hair=="rubio"){
      document.getElementById("mensajeCorrecto").innerText = "Sí, tiene el color de pelo "+selectCombo.value+".";
      document.getElementById("mensajeError").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      document.getElementById('ComboUnico').value = 0;
      desactivarColorIncorrecto()
      activarColorCorrecto();
    }else if(hair!='rubio'){
      document.getElementById("mensajeError").innerText = "No tiene el color de pelo "+selectCombo.value+".";
      document.getElementById("mensajeCorrecto").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      //Llamar funcion se parpadeo rojo.
    }
  }
  if(selectCombo.value=='castany'){
    if(hair=="castany"){
      document.getElementById("mensajeCorrecto").innerText = "Sí, tiene el color de pelo "+selectCombo.value+".";
      document.getElementById("mensajeError").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      document.getElementById('ComboUnico').value = 0;
      desactivarColorIncorrecto()
      activarColorCorrecto();
    }else if(hair!='castany'){
      document.getElementById("mensajeError").innerText = "No tiene el color de pelo "+selectCombo.value+".";
      document.getElementById("mensajeCorrecto").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      //Llamar funcion se parpadeo rojo.
    }
  }
  if(selectCombo.value=='hombre'){
    if(gender=="hombre"){
      document.getElementById("mensajeCorrecto").innerText = "Sí, es "+selectCombo.value+".";
      document.getElementById("mensajeError").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      document.getElementById('ComboUnico').value = 0;
      desactivarColorIncorrecto()
      activarColorCorrecto();
    }else if(gender!='hombre'){
      document.getElementById("mensajeError").innerText = "No es "+selectCombo.value+".";
      document.getElementById("mensajeCorrecto").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      //Llamar funcion se parpadeo rojo.
    }
  }
  if(selectCombo.value=='mujer'){
    if(gender=="mujer"){
      document.getElementById("mensajeCorrecto").innerText = "Sí, es "+selectCombo.value+".";
      document.getElementById("mensajeError").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      document.getElementById('ComboUnico').value = 0;
      desactivarColorIncorrecto()
      activarColorCorrecto();
    }else if(gender!='mujer'){
      document.getElementById("mensajeError").innerText = "No es "+selectCombo.value+".";
      document.getElementById("mensajeCorrecto").innerText = "";
      contador=contador+1;
      document.getElementById("contadorPregunta").innerText = "Contador: "+contador;
      //Llamar funcion se parpadeo rojo.
    }
  }


  
    $Config = fopen("config.txt", "r");
    $Conf = array();
    $GeneralConfig = array();
    $Atributos= array();
    $Nombres = array();
    while(!feof($Config)){
        $linea=fgets($Config);
        array_push($Conf, $linea);
    }
    fclose($Config);
    for($w=0;$w<count($Conf);$w++){
        $Nombre = explode(":", $Conf[$w]);
        $Atributo = explode(" ",$Nombre[1]);
        array_push($Nombres, $Nombre[0]);
        array_push($Atributos, $Atributo);  
    }
    
    print_r($Atributos[0][1]);
    $longAtributos = count($Atributos);
    echo"<form method='post' name='formulario'>";
    echo"<div class='general'>";
        echo"<div class='caja1'>";
        echo"<p>Elige una pregunta.</p>";
        echo"<select name='ComboUnico' id='ComboUnico'>";
            echo"<option value='0'>-- Selecciona --</option>";
            echo'<option value='.$Atributos[0][0].'>¿Tiene '.$Nombres[0].'?</option>';
            echo'<option value='.$Atributos[0][1].'>¿No tiene '.$Nombres[0].'?</option>';
            for($w=0;$w<$longAtributos;$w++){
                echo'<option value='.$Atributos[1][$w].'>¿Es '.$Atributos[1][$w].'?</option>';
            }
            for($y=0;$y<$longAtributos-1;$y++){
                echo'<option value='.$Atributos[2][$y].'>¿Es '.$Atributos[2][$y].'?</option>';
            }
        echo"</select>";
        echo"</div>";
        echo"<input type='button' name='pregunta' value='Haz la pregunta' onclick='validarSelect(); mensajeAviso();'>";
    echo"</form>";
    echo"<p class='contadorPregunta' id='contadorPregunta'>Contador: 0</p>";
    echo"<p id='mensajeCorrecto'></p>";
    echo"<p id='mensajeError'></p>";
    echo"</div>";
    */
    ?>
</html>