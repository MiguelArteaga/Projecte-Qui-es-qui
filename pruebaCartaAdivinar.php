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
	  $names2 = explode(":",$i);
	  array_push($arrayGeneral, $names2);

	}
	 #print_r($arrayGeneral);
	?>
	<script type="text/javascript" >


		//Pasamos $arrayGeneral a arraycartas para poder trabajar con el en Javascript.
	   	var arraycartas=<?php echo json_encode($arrayGeneral);?>;
		var arraynombres=[];


		//hacemos un bucle para coger solo los nombres de las carta y las guardamos en un array nuevo llamado "arraynombres".
		for(var i=0;i<arraycartas.length;i++){
			arraynombres.push(arraycartas[i][0]);}
			//document.write(arraynombres);
		//Creamos la funcion adivinarCarta.


	    function adivinaCarta() {
	    	//Declaramos un variable para hacer 7 numeros random.
	    	var i=Math.floor((Math.random() * 7));

	    	//Declaramos una variable nueva en la que guardamos la carta a adivinar.
			var cartaAdivinar=arraynombres[i];
			//document.write(cartaAdivinar+"<br>");
			
			//Eliminamos
			delete arraynombres[i];
			
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
		    	 document.write("<br>"+arraynombres[arrayMezclar[i]]);
		    }
	    }

	</script>

</body>
</html>