<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
	
	$array = file("caracteristicas.txt");
	print_r($array);
	
	echo "<br/>";

	$file = fopen("prueba.txt", "w");
	fwrite($file, "esto es una prueba de escritura".PHP_EOL);
	fclose($file);


	$arraylinea = fopen("caracteristicas.txt","r");
	$lista=array();
	while (!feof($arraylinea)) {

		echo fgets($arraylinea)."<br/>";
	}
	fclose("arraylinea");

	

 ?>

</body>
</html>
