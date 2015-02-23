
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Ejercicio nº1</title>
</head>
<body>

<p>Provincia id=1</p>
<?= $provincia;?>

<p>Listado de provincias</p>
<pre>

<?php 

 foreach ($provincias as $clave =>$valor){
     
     
     echo "id: ";
     echo $valor['id'];
     echo "<br/>";
     echo "nombre: ";
     echo $valor['nombre'];
     
     //print_r(print_r($valor));
    /* foreach ($valor as $nombre){
         
         
         echo $nombre['id'];
         echo $nombre['nombre'];
         echo "|";
         
     }*/
     
     echo "<br/>";
     
 }

?>

</pre>

</body>
</html>