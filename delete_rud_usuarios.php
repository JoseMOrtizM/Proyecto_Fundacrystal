<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}else{
//conexion
require ("conexion.php");
//rescatando usuario a eliminar
$id=htmlentities(addslashes($_GET["Id"]));
//eliminando
$consulta="DELETE FROM `datos_usuarios` WHERE ID=$id";
$resultados=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=rud_usuarios.php"><?php
//header("location:rud_usuarios.php");
}
?>