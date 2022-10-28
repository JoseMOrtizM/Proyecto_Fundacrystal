<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//rescatando del form
$id=$_POST["id"];
$pagina=$_POST["pagina"];
$consulta="UPDATE `datos_comentarios` SET LEIDO='NO' WHERE ID='$id'";
$resultado=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=rud_comentarios.php?pagina= <?php echo "$pagina"; ?> "><?php
//header("location:rud_comentarios.php?pagina=$pagina");
?>