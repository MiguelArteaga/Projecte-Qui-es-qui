<!DOCTYPE html>
<html>
<head>
	<title></title>
    <script type="text/javascript" src="funciones2.js"></script>
	 <link href='estilos-quien-es-quien.css' type='text/css' rel='stylesheet' >
</head>
<body>
	<?php
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
    ?>
</html>