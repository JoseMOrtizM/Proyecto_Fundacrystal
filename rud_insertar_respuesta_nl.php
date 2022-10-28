<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//OBTENIENDO USUARIO Y CORREO
$user=$_SESSION["usuario_adm"];
$consulta="SELECT FOTO, NOMBRE, APELLIDO FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
$nombre_autor=$fila['NOMBRE'];
$apellido_autor=$fila['APELLIDO'];
//RESCATANDO DATOS PARA INSERTAR COMENTARIO
$correo_comentario=$user;
$nombre_comentario=$nombre_autor . " " . $apellido_autor;
$contenido_comentario=mysqli_real_escape_string($conexion,$_POST['respuesta']);
$pagina=$_POST['pagina'];
$fecha_del_comentario=date("Y-m-d H:i:s");
$titulo_articulo=$_POST['articulo_titulo'];
//INSERTANDO COMENTARIO
$consulta="INSERT INTO `datos_comentarios`(NOMBRE, CORREO, ART_TITULO, FECHA, COMENTARIO, LEIDO) VALUES ('Resp: $nombre_comentario', '$correo_comentario', '$titulo_articulo', '$fecha_del_comentario', '$contenido_comentario', 'SI')";
$resultado=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=rud_comentarios_nl.php"><?php
//header("location:rud_comentarios_nl.php");
?>