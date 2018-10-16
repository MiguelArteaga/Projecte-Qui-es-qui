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
print_r(arrayNames)
$contador = 0;
print_r($names[0]);
foreach ($arrayNames as $key => $e) {
  print_r($e);
  if($e==$names[0]){
    $contador=$contador+1;
  }
  else{
    $contador=$contador-1;
  }
}

if($contador>0){
  print_r("Repetido");
}
else{
  print_r("No repetido");
}

?>
