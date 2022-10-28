<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//rescatando del form
$id=$_POST["id"];
$pagina=$_POST["pagina"];
$consulta="DELETE FROM `datos_comentarios` WHERE ID=$id";
$resultado=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=rud_comentarios_nl.php"><?php
//header("location:rud_comentarios_nl.php");
?>