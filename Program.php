<html>
  <head>
    <title></title>
  </head>

  <body>
    <?php
    #Arrays que usaremos
    $arrayImg = array(); #Contiene los datos de imatge.txt.
    $arrayGeneral = array(); #Contiene los datos separados por dos puntos.
    $arrayNombres = array(); #Contiene todos los nombres de las imagenes.
    $charactersImg = array(); #Contiene los caracteres de imatge.txt
    $arrayConfig = array(); #Contiene todos los datos de Config.txt
    $characterConf = array(); #Contiene los caracteres de Config.txt
    #Lectura del fichero imatges.txt.
    $Img = fopen("imatges.txt", "r") or die("Error al leer el documento.");
    while(!feof($Img)){
      $linea=fgets($Img);
      $saltodelinea=nl2br($linea);
      array_push($arrayImg, $saltodelinea);
    }
    fclose($Img);
    #Lectura del fichero Config.txt.
    $Config = fopen("config.txt", "r") or die("Error al leer el documento.");
    while (!feof($Config)) {
      $linea=fgets($Config);
      $saltodelinea=nl2br($linea);
      array_push($arrayConfig, $saltodelinea);
    }
    fclose($Config);
    # Añadimos el fichero en un array. Usando la funcion explode separamos ese valor que contenta dos puntos.
    foreach ($arrayConfig as $key => $a) {
      $caracter = explode(":", $a);
      array_push($characterConf, $caracter);
    }
    # Añadiremos a nuestra array general todos los datos.
    foreach ($arrayImg as $key => $i) {
      $names = explode(":",$i);
      array_push($arrayGeneral, $names);
    }
    # Creacion de array nombres

    $longGnl = count($arrayGeneral[1]);
    for($i = 0; $i<$longGnl;$i++){
      array_push($arrayNombres, $arrayGeneral[$i][1]);
    }
    # Creacion de array caracteristicas

    for($i=0;$i<$longGnl;$i++){
      array_push($charactersImg, $arrayGeneral[$i][1]);
    }
    # 1. Una misma imagen (nombre de imagen) aparece dos veces en el archivo img.txt
    # 2. Dos imagenes diferentes tiene las mismas caracteristicas.
    # 3.Una característica que aparezca en el fichero imatges.txt no aparece en el fichero config.txt (al revés no importa)
    if(count($arrayNombres)>count(array_unique($arrayNombres)) || count($charactersImg)>count(array_unique($charactersImg))){
      $Logs = fopen("logs.txt", "w");
      fwrite($Logs, "¡Error! Hay un nombre repetido en el archivo imatges.txt.");
      fclose($Logs);
      echo"<h2>¡Error! Hay un nombre repetido en el archivo imatges.txt.</h2>";
    }else{

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
        <p id="sexe">Sexe</p>
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
