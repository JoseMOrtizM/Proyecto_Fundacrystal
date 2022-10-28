<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=Salir.php"><?php
	//header("location:Salir.php");
}else{
//conexion
require ("conexion.php");
//rescatando articulo a eliminar
$articulo=$_POST["articulo"];
//opteniendo fotos del articulo a eliminar
$consulta="SELECT * FROM `datos_articulos` WHERE ART_TITULO='$articulo'";
$resultados=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultados);
$foto['0']=$fila["FOTO_1"];
$foto['1']=$fila["FOTO_2"];
$foto['2']=$fila["FOTO_3"];
$foto['3']=$fila["FOTO_4"];
$foto['4']=$fila["FOTO_5"];
$foto['5']=$fila["FOTO_6"];
$foto['6']=$fila["FOTO_7"];
$foto['7']=$fila["FOTO_8"];
$foto['8']=$fila["FOTO_9"];
$foto['9']=$fila["FOTO_10"];
$foto['10']=$fila["FOTO_11"];
$foto['11']=$fila["FOTO_12"];
$foto['12']=$fila["FOTO_13"];
$foto['13']=$fila["FOTO_14"];
$foto['14']=$fila["FOTO_15"];
$foto['15']=$fila["FOTO_16"];
$foto['16']=$fila["FOTO_17"];
$foto['17']=$fila["FOTO_18"];
$foto['18']=$fila["FOTO_19"];
$foto['19']=$fila["FOTO_20"];
//eliminando fotos del directorio
$i=0;
while($i<=19){
	if($foto[$i]<>0 or $foto[$i]<>''){
		unlink('IMAGENES/' . $foto[$i]);
	}
	$i=$i+1;
}
//eliminando
$consulta="DELETE FROM `datos_articulos` WHERE ART_TITULO='$articulo'";
$resultados=mysqli_query($conexion,$consulta);
$consulta="DELETE FROM `datos_comentarios` WHERE ART_TITULO='$articulo'";
$resultados=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=rud_articulos.php"><?php
//header("location:rud_articulos.php");
}
?>