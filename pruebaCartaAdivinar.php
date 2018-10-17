<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
	<p id="cartas"></p>
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
		
	   	var arraycartas=<?php echo json_encode($arrayGeneral);?>;
		var arraynombres=[];
		for(var i=0;i<arraycartas.length;i++){
			arraynombres.push(arraycartas[i][0]);}
			document.write(arraynombres);

	    function adivinaCarta() {
	    	var i=Math.floor((Math.random() * 7));
			var cartaAdivinar=arraynombres[i];
			//document.write(cartaAdivinar+"<br>");
			delete arraynombres[i];
			//var arraynombres=arraynombres;
			//document.write(arraynombres);

			for (var i=0 ;i <= arraynombres.length; i++) {
				//document.write("<br>"+arraynombres[i]);
			}
			var arrayMezclar= ['0','1','2','3','4','5','6'];
			//document.write(arraysNumerosCartas);

		    var i,j,k;
		    for (i = arrayMezclar.length; i; i--) {
		        j = Math.floor(Math.random() * i);
		        k = arrayMezclar[i - 1];
		        arrayMezclar[i - 1] = arrayMezclar[j];
		        arrayMezclar[j] = k;
		    }
		    for (i=0;i<=arrayMezclar.length;i++){
		    	 document.write(arraynombres[arrayMezclar[i]]);
		    }
		   


	    	}

	</script>

</body>
</html>