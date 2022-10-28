<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=Salir.php"><?php
	//header("location:Salir.php");
}else{
//conexion
require ("conexion.php");
//rescatando id a eliminar
$id=$_GET["Id"];
echo "$id<br>";
echo "SELECT ACT, FOTO FROM `datos_servicios` WHERE ID='$id'<br>";
echo "DELETE FROM `datos_servicios` WHERE ID='$id'";
//opteniendo fotos del articulo a eliminar
$consulta="SELECT ACT, FOTO FROM `datos_servicios` WHERE ID='$id'";
$resultados=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultados);
$foto=$fila["FOTO"];
$tipo_de_servicio=$fila["ACT"];
//eliminando fotos del directorio
unlink('IMAGENES/' . $foto);
//eliminando
$consulta="DELETE FROM `datos_servicios` WHERE ID='$id'";
$resultados=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
header("location:crud_servicios_eventos.php?tipo_de_servicio=$tipo_de_servicio");
}
?>