<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO EL USUARIO Y OBTENIENDO FOTO
$user=$_SESSION["usuario_adm"];
$consulta="SELECT FOTO, NOMBRE, APELLIDO FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
$autor_nombre=$fila['NOMBRE'];
$autor_apellido=$fila['APELLIDO'];
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - CRUD/Insertar Servicios</title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
</head>
<body>
<?php
//header
require ("header_zona_adm_2.php");
?>
<section>
<?php
//rescatando datos del formulario
//VERIFICANDO ACT
if($_POST['act']<>true){
	$ver_act="error";
}else{
	$act_nombre=mysqli_real_escape_string($conexion,$_POST['act']);
}
if(strlen($act_nombre)>150){
	$ver_act="error";
}else{
	$ver_act="ok";
}
//VERIFICANDO SUB-ACT
if($_POST['sub_act']<>true){
	$ver_sub_act="error";
}else{
	$sub_act_nombre=mysqli_real_escape_string($conexion,$_POST['sub_act']);
}
if(strlen($sub_act_nombre)>150){
	$ver_sub_act="error";
}else{
	$ver_sub_act="ok";
}
//VERIFICANDO FECHA
if($_POST['fecha']<>true){
	$ver_fecha="error";
}else{
	$sub_act_fecha=mysqli_real_escape_string($conexion,$_POST['fecha']);
	$ver_fecha="ok";
}
//VERIFICANDO TITULO
if($_POST['titulo']<>true){
	$ver_titulo="error";
}else{
	$sub_act_titulo=mysqli_real_escape_string($conexion,$_POST['titulo']);
}
if(strlen($sub_act_titulo)>250){
	$ver_titulo="error";
}else{
	$ver_titulo="ok";
}
//VERIFICANDO DESCRIPCIÓN
if($_POST['descripcion']<>true){
	$ver_descripcion="error";
}else{
	$sub_act_descripcion=mysqli_real_escape_string($conexion,$_POST['descripcion']);
}
if(strlen($sub_act_descripcion)<400){
	$ver_descripcion="error";
}else{
	$ver_descripcion="ok";
}
//VERIFICANDO IMAGEN
if($_FILES['nombre_nueva_imagen']['name']<>true){
	$img_name='';
	$img_type='';
	$img_size=0;
	$ruta_temporal='';
	$ruta_destino='';
	$ver_img_type="error";
	$ver_img_size="error";
}else{
	$img_name=utf8_decode($_FILES['nombre_nueva_imagen']['name']);
	$img_type=$_FILES['nombre_nueva_imagen']['type'];
	$img_size=$_FILES['nombre_nueva_imagen']['size'];
	$ruta_temporal=$_FILES['nombre_nueva_imagen']["tmp_name"];
	$ruta_destino=$_SERVER['DOCUMENT_ROOT'] . '/FUNDACRYSTAL/IMAGENES/' . $img_name;
	//VERIFICANDO DUPLICIDAD DE NOMBRE DE LA IMAGEN Y CAMBIANDOLO DE SER NECESARIO
	if(file_exists($ruta_destino)==true){
		$img_name='1' . $img_name;
		$ruta_destino=$_SERVER['DOCUMENT_ROOT'] . '/FUNDACRYSTAL/IMAGENES/' .  $img_name;
	}
	//VERIFICANDO TIPO DE IMAGEN
	if($img_type=='image/jpeg' or $img_type=='image/jpg' or $img_type=='image/png' or $img_type=='image/gif'){$ver_img_type="ok";}else{$ver_img_type="error";}
	//VERIFICANDO TAMAÑO DE IMAGEN
	if($img_size>2000000){$ver_img_size="error";}else{$ver_img_size="ok";}
}
//VERIFICANDO QUE TODOS LOS DATOS ESTÁN CORRECTOS
if($ver_act=='ok' and $ver_sub_act=='ok' and $ver_fecha=='ok' and $ver_titulo=='ok' and $ver_descripcion=='ok' and $ver_img_type=='ok' and $ver_img_size=='ok'){
	// COLOCANDO LOS DATOS DEL ARTICULO A MODIFICAR
	$consulta="INSERT INTO `datos_servicios` 
	(ACT, SUB_ACT, TITULO, DESCRIPCION, FOTO, FECHA) VALUES
	('$act_nombre', '$sub_act_nombre', '$sub_act_titulo', '$sub_act_descripcion', '$img_name', '$sub_act_fecha');";
	$resultado=mysqli_query($conexion,$consulta);
	//MOVIENDO IMAGEN A LA CARPETA DE IMAGENES DEL PROYECTO
	move_uploaded_file($ruta_temporal,$ruta_destino);
	//IMPRIMIENDO MENSAJE EN PANTALLA
	echo "<table style='border: solid #333 1px; width:97%; margin:auto; background-color:#dfdfdf;'><tr style='border: solid #333 1px;'><td colspan='4' style='border: solid #333 1px; width:15%; text-align:justify; padding:5px; background-color:#FFF; color:#F00;'><h3>DATOS PUBLICADOS CON ÉXITO</h3></td></tr></table>";
}else{
	echo "<table style='border: solid #333 1px; width:97%; margin:auto; background-color:#dfdfdf;'><tr style='border: solid #333 1px;'><td colspan='4' style='border: solid #333 1px; width:15%; text-align:justify; padding:5px; background-color:#FFF; color:#F00;'><h3>ERROR por favor revise los datos suministrados y vuelva a intentarlo</h3><p>ACT: $ver_act SUB-ACT: $ver_sub_act FECHA: $ver_fecha TITULO: $ver_titulo DESCRIPCIÓN: $ver_descripcion IMAGEN_TIPO: $ver_img_type IMAGEN_TAMAÑO: $ver_img_size</p></td></tr></table>";
}
header("location:crud_servicios_eventos.php?tipo_de_servicio=$act_nombre");
?>
</section>
</body>
</html>
<?php
mysqli_close($conexion);
?>