<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - Insertando Comentario</title>
<?php
//META CANONICAL PARA INDEX
echo "<link rel='canonical' href='http://www.fundacrystal.tk/insertar_comentario.php' />";
// TIPO DE IDIOMA Y TIPO DE DOCUMENTO
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
// META DESCRIPCION
echo "<meta name='description' content='Orientación a familiares y personas con TEA o Autismo. La mejor información; tratamientos, terapias y dietas, desarrollada por expertos de todo el mundo' />";
// META ROBOTS PARA PÁGINA INDEX Y BUSQUEDA LIKE O VISIBLE AL BUSCADOR
//echo "<meta name='robots' content='index, follow'>";
// META ROBOTS PARA PÁGINAS INTERNAS INVISIBLES AL BUSCADOR PERO RASTREABLES
echo "<meta name='robots' content='noindex, follow'>";
// META KEYS WORDS SACADAS DE LA LISTA DE CATEGORIAS DE LA BD
echo "<meta name='keywords' content='";
	//OBTENIENDO CATEGORIAS DE LA BD
	$consulta="SELECT TAGS FROM `DATOS_TAGS` GROUP BY TAGS ORDER BY CATEGORIA";
	$resultado=mysqli_query($conexion,$consulta);
	$cta_categoria=0;
	while(($fila=mysqli_fetch_array($resultado))==true){
		$categorias[$cta_categoria]=ucfirst(mb_strtolower($fila['TAGS'],'UTF-8'));
		$cta_categoria=$cta_categoria+1;
	}
	//PONIENDO EL CONTADOR EN SU LUGAR
	$cta_categoria=$cta_categoria-1;
	//IMPRIMIENDO CATEGORIAS
	$i=0;
	while($i<=$cta_categoria){
		echo ", $categorias[$i]";
		$i=$i+1;
	}
echo "'/>";
// META VIEWPORT
//echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'/>";
echo "<meta property='og:title' content='¡Ayúdanos a conseguir una mejor comprensión del autismo en Venezuela! - FundaCrystal'/>";
//Compatibilidad con Internet Explorer
echo "<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>";
//Schema.org para Google
echo "<meta itemprop='name' content='FundaCrystal'>";
echo "<meta itemprop='description' content='Orientación a familiares y personas con TEA o Autismo. La mejor información; tratamientos, terapias y dietas, desarrollada por expertos de todo el mundo'>"; 
echo "<meta itemprop='image' content='http://fundacrystal.tk/IMAGENES/LOGO01.jpg'>";// OJO: HAY QUE COLOCAR ESTE LOGO EN LA RAIZ DEL HOSTING
?>
</head>
<body>
<?php
//conexion
require ("conexion.php");
//RESCATANDO DATOS PARA INSERTAR COMENTARIO
$correo_comentario=mysqli_real_escape_string($conexion,$_POST['correo_comentario']);
$nombre_comentario=mysqli_real_escape_string($conexion,$_POST['nombre_comentario']);
$contenido_comentario=mysqli_real_escape_string($conexion,$_POST['contenido_comentario']);
$fecha_del_comentario=$_POST['fecha_del_comentario'];
$titulo_articulo=$_POST['titulo_del_articulo'];
//INSERTANDO COMENTARIO
$consulta="INSERT INTO `datos_comentarios`(NOMBRE, CORREO, ART_TITULO, FECHA, COMENTARIO, LEIDO) VALUES ('$nombre_comentario', '$correo_comentario', '$titulo_articulo', '$fecha_del_comentario', '$contenido_comentario', 'NO')";
$resultado=mysqli_query($conexion,$consulta);
?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=articulos.php?art_titulo=<?php echo "$titulo_articulo"; ?>">
<?php
//header("location:articulos.php?art_titulo=$titulo_articulo");
?>
</body>
</html>
<?php
mysqli_close($conexion);
?>