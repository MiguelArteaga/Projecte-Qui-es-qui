<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link href='estilos-quien-es-quien.css' type='text/css' rel='stylesheet' >
</head>
<body>
	<?php
	$arraycaract=file('config.txt');
	$arrayimg = file('imatges.txt');
	 # Array general del archivo config.
    $longitudCaract = count($arraycaract);
    $GeneralConfig = array();
    for($c=0;$c<$longitudCaract;$c++){
      $datos = explode(":", $arraycaract[$c]);
      array_push($GeneralConfig, $datos);
    }
    # Array de los titulos para los select.
    $Titulos = array();
    $longGnlConfig = count($GeneralConfig);
    for($p=0;$p<$longGnlConfig;$p++){
      array_push($Titulos, $GeneralConfig[$p][0]);
    }
    $Datos = array();
    for($r=0;$r<$longGnlConfig;$r++){
    	array_push($Datos, $GeneralConfig[$r][1]);
    }o0,
    print_r($Datos);
    /*
    echo"<div class='general'>";
  	echo"<div class='caja1'>";
    for($s=0;$s<$longTitulos;$s++){
    		echo"<p>$Titulos[$s]</p>";
    			echo"<select id='$Titulos[$s]'>";
    			if($Titulos[$s]==$Titulos[$s]){
    				$cero = 0;
    				for($o=0;$o<$longValuesCabello;$o++){
    					echo"<option value='$valoresCabello[$cero][$o]'>$valoresCabello[$cero][$o]</option>";	
    				}
    				
    			}

    			echo"</select>";

    	}
    	echo"</div>";
    echo"</div>";
   */
	?>
</body>
</html>