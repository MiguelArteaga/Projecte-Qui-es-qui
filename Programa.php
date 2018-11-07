<html>
  <head>
    <title></title>
    <script type="text/javascript" src="funciones.js"></script>
    <link href='estilos-quien-es-quien.css' type='text/css' rel='stylesheet' >
  </head>

  <body> 
    <?php
    echo "<p id='oculto' class='ocultoclass'></p>";
    echo "<p id='p1final' class='p1pro' ></p>";
    #Arrays que usaremos
    $arrayImg = array();
    $arrayGeneral = array();
    $arrayNombres = array();
    $Carac = array();
    //Nuevo!
    $arraycaract=file('config.txt');

    $caractconfig=array();
    $caractconfig2=array();
    $caractimatges=array();
    $caractimatges2=array();
    //Final Nuevo
    #Lectura de fichero.
    $Img = fopen("imatges.txt", "r") or die("Error al leer documento.");
    while(!feof($Img)){
      $linea=fgets($Img);
      array_push($arrayImg, $linea);
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
    //Nuevo!
    $errorcaract=true;
    #Añadimos las caracteristicas del fichero config.txt a un array
    foreach ($arraycaract as $i ) {
      $names = explode(":",$i);
      array_push($caractconfig, $names);
    }
    #Añadimos las caracteristicas del fichero imatges.txt a un array
    foreach($arrayGeneral as $u) {
      array_push($caractimatges,$u[1] );
    }
    foreach ($caractimatges as $value) {
    	$names = explode(" ",$value);
    	array_push($caractimatges2,$names);
    }
    foreach ($caractconfig as $value) {
    	$names = explode(" ",$value);
    	array_push($caractconfig2,$names);
    }
    $longCaractimatges2=count($caractimatges2);
    for ($i=0; $i < $longCaractimatges2; $i++) {
    	if ($caractimatges2[$i][0]!=$caractconfig[0][0]){
    		$errorcaract=false;
    	}
    	elseif ($caractimatges2[$i][3]!=$caractconfig[1][0]) {
    		$errorcaract=false;
    	}
    	elseif ($caractimatges2[$i][6]!=$caractconfig[2][0]) {
    		$errorcaract=false;
    	}
    }
    //Final Nuevo!
    # 1. Una misma imagen (nombre de imagen) aparece dos veces en el archivo img.txt
    if(count($arrayNombres)>count(array_unique($arrayNombres))){
      $Logs = fopen("logs.txt", "w");
      fwrite($Logs, "¡Error! Hay un nombre repetido en el archivo imatges.txt.");
      fclose($Logs);
      echo"<h2>¡Error! Hay un nombre repetido en el archivo imatges.txt.</h2>";
    }elseif(count($Carac)>count(array_unique($Carac))){
      $Log = fopen("logs.txt", "w");
      fwrite($Log, "¡Error! Hay caracteristicas repetidas en el archivo imatges.txt.");
      fclose($Log);
      echo"<h2>¡Error! Hay caracteristicas repetidas en el archivo imatges.txt.</h2>";
    }elseif($errorcaract==false){
      $Log = fopen("logs.txt", "w");
      fwrite($Log, "¡Error! Hay caracteristicas que no estan en el archivo config.txt.");
      fclose($Log);
      echo"<h2>¡Error! Hay caracteristicas que no estan en el archivo config.txt.</h2>";
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
    $numerodecartasimg=count($img);
    
    $y=2;
    $w=1;
    $i=0;
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
          for($o=0;$o<12;$o++){
            if($cartaoculta==$arrayNombres[$o]){
              $AtCabello = $AtributosCabello[$o][$y];
              $AtGafas = $AtributosGafas[$o][$w];
              $AtSexo = $AtributosSexo[$o][$y];
            }
          }
          echo"<div class='back'><img class='imgfront' id='cartaOculta' src='imagenes/$fotos' width='160' height='150' cabello='$AtCabello' gafas='$AtGafas' sexo='$AtSexo'></div>";
          echo "</div>";
        }
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
    echo"<form method='post' name='formulario'>";
    echo"<div class='general'>";
        echo"<div class='caja1'>";
        echo"<p>Elige una pregunta.</p>";
        echo"<select name='ComboUnico' id='ComboUnico' required onchange='habilitarBotonPregunta()'>";
            echo"<option value='' name='selecciona' selected='true' disabled='disabled'>-- Selecciona --</option>";
            for($a=0;$a<count($Nombres);$a++){
              for($b=0;$b<count($Atributos);$b++){
                for($c=0;$c<count($Atributos[$b]);$c++){
                  if($Nombres[$a]!='sexo' && $Nombres[$a]!='cabello'){
                    if($Atributos[$b][$c]=='si'){
                      echo'<option value='.$Atributos[$b][$c].'>¿Tiene '.$Nombres[$a].'?</option>';
                    }else{
                      echo'<option value='.$Atributos[$b][$c].'>¿No tiene '.$Nombres[$a].'?</option>';
                    }

                  }
                }
                 break;
                }   
              }
            for($w=0;$w<count($Atributos[1]);$w++){
                echo'<option value='.rtrim($Atributos[1][$w]).'>¿Es '.rtrim($Atributos[1][$w]).'?</option>';
            }
            for($y=0;$y<count($Atributos[2]);$y++){
                echo'<option value='.rtrim($Atributos[2][$y]).'>¿Es '.rtrim($Atributos[2][$y]).'?</option>';
            }
        echo"</select>";
        echo"</div>";
        echo"<input type='button' id='pregunta' disabled value='Haz la pregunta' onclick='validarSelect(); mensajeAviso();'>";
    echo"</form>";
        echo"<div class='caja1'";
          echo"<p class='contadorPregunta' id='contadorPregunta'>Contador: 0</p>";
        echo"</div>";
          echo"<p id='mensajeCorrecto'></p>";

          echo"<p id='mensajeError'></p>";

        echo"</div>";
        echo"<p id='botoneasyid'>";
        echo"<select name='modos' id='selectmodos'>";
          echo"<option value='1' onclick='activarmodoeasy()'>Modo Easy</option>";
          echo"<option value='2' onclick='activarmodoveryeasy()' >Very Easy</option>";
        echo"</select>";
        echo"</p>";
    }
    ?>
    <script type="text/javascript">
      var CartaOculta='<?php echo $cartaoculta;?>'
      var NumerosDeCartasImg='<?php echo $numerodecartasimg;?>'
      var arrayNombresCartas2=<?php echo json_encode($img);?>;
      var arraycartas=<?php echo json_encode($caractimatges2);?>;
      var arraycartasnombres=<?php echo json_encode($arrayGeneral);?>;

      // Fuegos artificiales

      var bits=400; // Número de puntos
      var intensity=15; // Intensidad de la explosión (recomendado entre 3 y 10)
      var speed=20; // Velocidad (a menor numero, mas rapido)
      var colours=new Array("#002BFF", "#7362FF", "#B200FF", "#3AFF00", "#FFF000", "#00FFD4");
      //Colores de los fuegos

      var dx, xpos, ypos, bangheight;
      var Xpos=new Array();
      var Ypos=new Array();
      var dX=new Array();
      var dY=new Array();
      var decay=new Array();
      var colour=0;
      var swide=800;
      var shigh=600;


      
      
       
    </script>
  </body>
</html>