<?php
session_start();
if(!isset($_SESSION["usuario_adm"]) and !isset($_SESSION["usuario_write"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//OBTENIENDO USUARIO Y CORREO
if(isset($_SESSION["usuario_adm"])){$user=$_SESSION["usuario_adm"];}else{
if(isset($_SESSION["usuario_write"])){$user=$_SESSION["usuario_write"];}}
$consulta="SELECT FOTO, NOMBRE, APELLIDO FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
$nombre_autor=$fila['NOMBRE'];
$apellido_autor=$fila['APELLIDO'];
//RESCATANDO DATOS PARA INSERTAR COMENTARIO
$correo_comentario=$user;
$nombre_comentario=$nombre_autor . " " . $apellido_autor;
$contenido_comentario=htmlentities(addslashes($_POST['respuesta']));
$pagina=$_POST['pagina'];
$nombre_comentarista=$_POST['nombre_comentarista'];
$fecha_del_comentario=date("Y-m-d H:i:s");
$titulo_articulo=$_POST['articulo_titulo'];
//INSERTANDO COMENTARIO
$consulta="INSERT INTO `datos_comentarios`(NOMBRE, CORREO, ART_TITULO, FECHA, COMENTARIO, LEIDO) VALUES ('Respuesta para: $nombre_comentarista', '$correo_comentario', '$titulo_articulo', '$fecha_del_comentario', '$contenido_comentario', 'SI')";
$resultado=mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=ver_comentarios.php"><?php
//header("location:ver_comentarios.php");
?>