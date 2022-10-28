<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO VALORES DEL FORM	
$id=mysqli_real_escape_string($conexion,$_POST["id"]);
$correo=mysqli_real_escape_string($conexion,$_POST["correo"]);
$nombre=mysqli_real_escape_string($conexion,$_POST["nombre"]);
$apellido=mysqli_real_escape_string($conexion,$_POST["apellido"]);
$pregunta=mysqli_real_escape_string($conexion,$_POST["pregunta"]);
$respuesta=mysqli_real_escape_string($conexion,$_POST["respuesta"]);
$contrasena=mysqli_real_escape_string($conexion,$_POST["contrasena"]);
$nivel_acceso=$_POST["nivel_acceso"];
//ACTUALIZANDO
$consulta="UPDATE `datos_usuarios` SET AUTOR_CORREO='$correo', NOMBRE='$nombre', APELLIDO='$apellido', PREGUNTA='$pregunta', RESPUESTA='$respuesta', CONTRASENA='$contrasena', NIVEL_ACCESO='$nivel_acceso' WHERE ID='$id'";
$resultados=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=rud_usuarios.php"><?php
//header("location:rud_usuarios.php");
?>