<?php
//conexion
require ("conexion.php");
//RECUPERANDO DATOS DEL FORM
if(!isset($_POST["correo"]) and !isset($_POST["nacionalidad"]) and !isset($_POST["fecha_nacimiento"]) and !isset($_POST["pregunta"]) and !isset($_POST["respuesta"])){
	$correo="";$nacionalidad="";$fecha_nacimiento="";$carnet="";$respuesta="";
	header("location:recupera_datos.php");
}else{
	$correo=mysqli_real_escape_string($conexion,$_POST["correo"]);
	$nacionalidad=mysqli_real_escape_string($conexion,$_POST["nacionalidad"]);
	$fecha_nacimiento=mysqli_real_escape_string($conexion,$_POST["fecha_nacimiento"]);
	$pregunta=$_POST["pregunta"];
	$respuesta=mysqli_real_escape_string($conexion,$_POST["respuesta"]);
}
$consulta="SELECT * FROM `datos_usuarios` WHERE AUTOR_CORREO='$correo' AND NACIONALIDAD='$nacionalidad' AND F_NACIMIENTO='$fecha_nacimiento' AND PREGUNTA='$pregunta' AND RESPUESTA='$respuesta'";
$verf_cod="ok";
$resultado=mysqli_query($conexion,$consulta);
if(($filas=mysqli_fetch_array($resultado))==true){
	$nombre=$filas["NOMBRE"];
	$apellido=$filas["APELLIDO"];
	$correo_read=$filas["AUTOR_CORREO"];
	$contrasena=$filas["CONTRASENA"];
	$foto=$filas["FOTO"];
	$verf_cod="ok";
}else{$verf_cod="error";}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<?php
//META CANONICAL PARA INDEX
echo "<link rel='canonical' href='http://www.fundacrystal.tk/index.php' />";
// TIPO DE IDIOMA Y TIPO DE DOCUMENTO
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
// META DESCRIPCION
echo "<meta name='description' content='Orientación a familiares y personas con TEA o Autismo. La mejor información; tratamientos, terapias y dietas, desarrollada por expertos de todo el mundo' />";
// META ROBOTS PARA PÁGINA INDEX Y BUSQUEDA LIKE O VISIBLE AL BUSCADOR
echo "<meta name='robots' content='index, follow'>";
// META ROBOTS PARA PÁGINAS INTERNAS INVISIBLES AL BUSCADOR PERO RASTREABLES
//echo "<meta name='robots' content='noindex, follow'>";
// META KEYS WORDS SACADAS DE LA LISTA DE CATEGORIAS DE LA BD
echo "<meta name='keywords' content='Fundación Crystal, FundaCrystal";
  //OBTENIENDO CATEGORIAS DE LA BD
  $consulta="SELECT TAGS FROM `DATOS_TAGS` GROUP BY TAGS ORDER BY TAGS";
  $resultado=mysqli_query($conexion,$consulta);
  $cta_categoria=0;
  while(($fila=mysqli_fetch_array($resultado))==true){
    $tags[$cta_categoria]=$fila['TAGS'];
    $cta_categoria=$cta_categoria+1;
  }
  //PONIENDO EL CONTADOR EN SU LUGAR
  $cta_categoria=$cta_categoria-1;
  //IMPRIMIENDO CATEGORIAS
  $i=0;
  while($i<=$cta_categoria){
    echo ", $tags[$i]";
    $i=$i+1;
  }
  $cantidad_de_palabras_clave=$i;
echo "'/>";
echo "<meta property='og:title' content='¡Ayúdanos a conseguir una mejor comprensión del autismo en Venezuela! - FundaCrystal'/>";
//Compatibilidad con Internet Explorer
echo "<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>";
//Schema.org para Google
echo "<meta itemprop='name' content='FundaCrystal'>";
echo "<meta itemprop='description' content='Orientación a familiares y personas con TEA o Autismo. La mejor información; tratamientos, terapias y dietas, desarrollada por expertos de todo el mundo'>"; 
echo "<meta itemprop='image' content='http://fundacrystal.tk/FUNDACRYSTAL/IMAGENES/LOGO01.jpg'>";// OJO: HAY QUE COLOCAR ESTE LOGO EN LA RAIZ DEL HOSTING
?>
<title>Fundación Crystal - Ver datos recuperados</title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
<?php
//header
require ("efecto_entrada.php");
?>
</head>
<body>
<?php
//header
require ("header.php");
?>
<section>
<?php
if($verf_cod=="error"){
	echo "<br><br><br><table style='width:550px; margin:auto; border:#473663 8px ridge; box-shadow:#333 10px 5px 10px; background-color:#376092; color:#000;'><tr style='border:#000 2px solid;'><th style='background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea); font-size:50px;'>DATOS DE USUARIO INVALIDOS</th></tr><tr style='border:#000 2px solid;'><td style='text-align:justify; background-color:#ffc; font-size:16px;'>Por favor verifíque los datos introducidos para CORREO PERSONAL, PAIS DE ORIGEN, FECHA DE NACIMIENTO, PREGUNTA y RESPUESTA DE SEGURIDAD, e inténtelo nuevamente.</td></tr><tr style='border:#000 2px solid;'><th style='background:-moz-linear-gradient(bottom, #FFF, #c1e2ea); background:-ms-linear-gradient(bottom, #FFF, #c1e2ea); background:-webkit-linear-gradient(bottom, #FFF, #c1e2ea); background:-o-radial-linear(bottom, #FFF, #c1e2ea);  font-size:24px;'><a href='recupera_datos.php'>Volver a la Página Anterior</a></th></tr></table><br><br><br>";
}else{
	echo "<br><table style='width:550px; margin:auto; border:#473663 8px ridge; box-shadow:#333 10px 5px 10px; background-color:#376092; color:#fff;'>
	<tr style='border:#000 2px solid;'><th colspan='2' style='font-size:40px; font-weight:bolder; background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea); color:#000;'>DATOS DE USUARIO VALIDOS</th></tr>
	<tr style='border:#000 2px solid;'><th>Su Pais de Origen es:</th>
	<th><input style='width:280px; text-align:center;' type='text' value='$nacionalidad'></th></tr>
	<tr style='border:#000 2px solid;'><th>Su Fecha de Nacimiento es:</th>
	<th><input style='width:280px; text-align:center;' type='text' value='$fecha_nacimiento'></th></tr>
	<tr style='border:#000 2px solid;'><th>Su Pregunta de Seguridad es:</th>
	<th><input style='width:280px; text-align:center;' type='text' value='$pregunta'></th></tr>
	<tr style='border:#000 2px solid;'><th>Su Respuesta de Seguridad es:</th>
	<th><input style='width:280px; text-align:center;' type='text' value='$respuesta'></th></tr>
	<tr style='border:#000 2px solid;'><th>Su Correo Electrónico es:</th>
	<th><input style='width:280px; text-align:center;' type='text' value='$correo_read'></th></tr>
	<tr style='border:#000 2px solid;'><th>Su Contraseña es:</th>
	<th><input style='width:280px; text-align:center;' type='text' value='$contrasena'></th></tr>
	<tr style='border:#000 2px solid;'><th colspan='2' style='background:-moz-linear-gradient(bottom, #FFF, #c1e2ea); background:-ms-linear-gradient(bottom, #FFF, #c1e2ea); background:-webkit-linear-gradient(bottom, #FFF, #c1e2ea); background:-o-radial-linear(bottom, #FFF, #c1e2ea);  font-size:18px;'><a href='recupera_datos.php'>Volver a la Página Anterior</a></th></tr></table><br><br>";}
?>
</section>
<?php
//header
require ("footer.php");
?>
<br><br>
</body>
</html>
<?php
mysqli_close($conexion);
?>