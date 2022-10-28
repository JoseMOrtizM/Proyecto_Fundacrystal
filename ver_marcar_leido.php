<?php
session_start();
if(!isset($_SESSION["usuario_adm"])and !isset($_SESSION["usuario_write"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//rescatando del form
$id=$_POST["id"];
$pagina=$_POST["pagina"];
$consulta="UPDATE `datos_comentarios` SET LEIDO='SI' WHERE ID='$id'";
$resultado=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=ver_comentarios.php"><?php
//header("location:ver_comentarios.php");
?>