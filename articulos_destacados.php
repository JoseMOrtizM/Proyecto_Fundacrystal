<?php
//conexion
require ("conexion.php");
if(!isset($_POST['art_titulo'])){}else{
	$titulo_articulo=$_POST['art_titulo'];
	//SUMANDO UN ME_GUSTA AL ARTICULO
	$consulta="UPDATE `datos_articulos` SET ME_GUSTA=ME_GUSTA+1, VISITAS=VISITAS+1 WHERE ART_TITULO='$titulo_articulo'";
	$resultado=mysqli_query($conexion,$consulta);
}
//SUMANDO UNA VISITA AL SITIO
$consulta="UPDATE `datos_visitas` SET VISITAS=VISITAS+1 WHERE DESCRIPCION='TOTAL'";
$resultado=mysqli_query($conexion,$consulta);
//FECHA Y HORA PARA LA QUE SE EJECUTO LA VISITA
$fecha_ahora_ano=date("Y"); 
$fecha_ahora_mes=date("m");
//SUMANDO UNA VISITA AL MES ACTUAL
$consulta="UPDATE `datos_visitas` SET VISITAS=VISITAS+1 WHERE DESCRIPCION='$fecha_ahora_ano-$fecha_ahora_mes'";
$resultado=mysqli_query($conexion,$consulta);
?>
<!DOCTYPE HTML>
<html>
<head>
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
<title>Fundación Crystal - Inicio</title>
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
//aside
require ("aside.php");
?>
<section>
<article style="border:#473663 8px ridge; border-radius:30px 0px 20px 0px; color:#FFF; background-color:#376092; margin-top:15px;">
<h1 class="aside_titulo" style="border-radius:20px 0px 10px 0px; border-top:0px; border-bottom:0px; color:#000;">Artículos Destacados</h1>
</article>
<?php
    //OBTENIENDO ARRAY DE ARTICULOS
    $consulta="SELECT 
				`datos_articulos`.ART_FECHA AS FECHA,
				`datos_usuarios`.NOMBRE AS NOMBRE,
				`datos_usuarios`.APELLIDO AS APELLIDO,
				`datos_articulos`.CATEGORIA AS CATEGORIA,
				`datos_articulos`.ART_TITULO AS ART_TITULO,
				`datos_articulos`.VISITAS AS VISITAS,
				`datos_articulos`.ME_GUSTA AS ME_GUSTA,
				`datos_articulos`.FOTO_1 AS FOTO_1,
				`datos_articulos`.PARRAFO_1 AS PARRAFO_1,
				`datos_articulos`.SUB_TITULO_1 AS SUB_TITULO_1
				FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO ORDER BY VISITAS DESC, ME_GUSTA DESC, FECHA DESC LIMIT 0,4";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $art_fec=$fila['FECHA'];
        $art_nom=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
        $art_ape=ucwords(mb_strtolower($fila['APELLIDO'],'UTF-8'));
        $art_cat=ucfirst(mb_strtolower($fila['CATEGORIA'],'UTF-8'));
        $art_tit=$fila['ART_TITULO'];
        $art_vis=$fila['VISITAS'];
        $art_gus=$fila['ME_GUSTA'];
        $art_st1=$fila['SUB_TITULO_1'];
        $art_par1=$fila['PARRAFO_1'];
        $art_foto=$fila['FOTO_1'];
		echo "<article style='color:#FFF; background-color:#376092;'>";
		echo "<div class='articulo_titulo' style='color:#000; border-top:0px; border-bottom-color:#473663;'><h2 style='margin-top:0px;'>$art_tit</h2>";
		echo "<h4>
			  <img width='20px' src='IMAGENES/AUTOR.jpg'/> $art_nom $art_ape&nbsp;
			  <img width='20px' src='IMAGENES/FECHA.jpg'/> $art_fec&nbsp;
			  <img width='20px' src='IMAGENES/CATEGORIA.jpg'/> $art_cat&nbsp;
			  <img width='20px' src='IMAGENES/VISITAS.jpg'/> $art_vis&nbsp;
			  <img width='20px' src='IMAGENES/ME_GUSTA.jpg'/> $art_gus&nbsp;
		</h4></div>";
		echo "<figure class='div-img hidden'><img class='img' src='IMAGENES/$art_foto'/></figure>";
		echo "<h3>$art_st1</h3>";
		if(strlen($art_par1)<=500){}else{$art_par1=substr($art_par1, 0, 450);}
		echo "<p>$art_par1...</p>";
		echo "<table style='width:100px; margin-right:10px; margin-left:auto;'><td><form name='ir_al_articulo' action='' method='post'><input type='text' name='art_titulo' hidden value='$art_tit'><input type='submit' value='Me Gusta'></form></td><td><form name='art_titulo' action='articulos.php' method='get'><input type='text' name='art_titulo' hidden value='$art_tit'><input type='submit' value='Leer mas...'></form></td></table>";
		echo "</article>";
    }
?>
</section>
<?php
//footer
require ("footer.php");
?>
<br><br>
</body>
</html>
<?php
mysqli_close($conexion);
?>