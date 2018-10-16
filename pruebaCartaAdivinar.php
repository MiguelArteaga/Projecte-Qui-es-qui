<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="funcionesAdivinarCartas.js"></script>
</head>
<body>
	<p id="cartaAdivinar"></p>
	<button onclick="adivinaCarta()">Carta Adivinar</button>
	<?php
	#Lectura de fichero.
	$Img = fopen("imatges.txt", "r") or die("Error al leer documento.");
	$arrayImg = array();
	$arrayNames = array();
	$arrayGeneral = array();

	while(!feof($Img)){
	  $linea=fgets($Img);
	  $saltodelinea=nl2br($linea);
	  array_push($arrayImg, $saltodelinea);
	}
	fclose($Img);


	# Condiciones
	foreach ($arrayImg as $key => $i) {
	  #$names = explode(":",$i);
	  $names2 = explode(",",$i);
	  array_push($arrayGeneral, $names2);

	}
	 #print_r($arrayGeneral);
	?>
	<script type="text/javascript" >
		var arrayJS=<?php echo json_encode($arrayGeneral);?>;
	   // for(var i=0;i<arrayJS.length;i++){

       //document.write("<br>"+arrayJS[i]);}


	</script>

</body>
</html>