<?php
//conexion
require ("conexion.php");

if(!isset($_POST['art_titulo'])){}else{
	$titulo_articulo=$_POST['art_titulo'];
	//SUMANDO UN ME_GUSTA AL ARTICULO
	$consulta="UPDATE `datos_articulos` SET ME_GUSTA=ME_GUSTA+1, VISITAS=VISITAS+1 WHERE ART_TITULO='$titulo_articulo'";
	$resultado=mysqli_query($conexion,$consulta);
}

//OBTENIENDO LA CATEGORIA DEL FORM
if(!isset($_GET['categoria'])){
	$categoria="Autismo";
}else{
	if($_GET['categoria']=="Elige una categoria"){
		$categoria="Autismo";
	}else{
		$categoria=$_GET["categoria"];
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<?php
//META CANONICAL PARA INDEX
echo "<link rel='canonical' href='http://www.fundacrystal.tk/categoria.php' />";
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
<title><?php echo "fundacrystal: $categoria"; ?></title>
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
<?php
	//definiendo datos del paginado
	//registros filtrados por página
	$registros_filtrados=15;
	//página
	if(isset($_GET["pag_form"])){
		if($_GET["pag_form"]=='Seleccione otra Página'){$pagina=1;}else{		$pagina=$_GET["pag_form"];}
	}else{$pagina=1;}
	//paginado
	$empesar_desde=($pagina-1)*$registros_filtrados;
	$sql_total="SELECT `datos_articulos`.ID AS ID FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO WHERE `datos_articulos`.CATEGORIA = '$categoria'";
	$resultado=mysqli_query($conexion,$sql_total);
	$numero_filas=0;
	while(($fila=mysqli_fetch_array($resultado))==true){
		$numero_filas=$numero_filas+1;
	}
	$total_paginas=ceil($numero_filas/$registros_filtrados);
?>

<h1 class="aside_titulo" style="text-align:center; font-size:28px; font-style:italic; border:#473663 8px ridge; width:54%; margin-left:4%; margin-right:auto; margin-top:15px; margin-bottom:5px; border-radius:20px 0px 10px 0px;">Artículos Encontrados: <?php echo "$numero_filas"; ?> (Pág. <?php echo "$pagina"; ?>/<?php echo "$total_paginas"; ?>)</h1>

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
				`datos_articulos`.FOTO_1 AS FOTO_1
				FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO WHERE 
				`datos_articulos`.CATEGORIA = '$categoria'
				ORDER BY VISITAS DESC, ME_GUSTA DESC, FECHA DESC LIMIT $empesar_desde,$registros_filtrados";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $art_fec=$fila['FECHA'];
        $art_nom=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
        $art_ape=ucwords(mb_strtolower($fila['APELLIDO'],'UTF-8'));
        $art_cat=ucfirst(mb_strtolower($fila['CATEGORIA'],'UTF-8'));
        $art_tit=ucfirst(mb_strtolower($fila['ART_TITULO'],'UTF-8'));
        $art_vis=$fila['VISITAS'];
        $art_gus=$fila['ME_GUSTA'];
        $art_foto=$fila['FOTO_1'];
		echo "<article>";
		echo "<div class='articulo_titulo' style='height:110px;'><figure class='div-img hidden' style='height:100px; width:150px; float:left;'><img class='img' src='IMAGENES/$art_foto' width='150px' height='100px'/></figure>";
		echo "<h2 style='margin-top:0px; padding:3px; padding-left:162px;'>$art_tit</h2></div>";
		echo "<table style='clear:left; font-size:14px; background-color:#fff;'><td style='width:78%; text-align:justify; padding-left:0.5%;'>
			  <img width='20px' src='IMAGENES/AUTOR.jpg'/> $art_nom $art_ape
			  <img width='20px' src='IMAGENES/FECHA.jpg'/> $art_fec
			  <img width='20px' src='IMAGENES/CATEGORIA.jpg'/> $art_cat
			  <img width='20px' src='IMAGENES/VISITAS.jpg'/> $art_vis
			  <img width='20px' src='IMAGENES/ME_GUSTA.jpg'/> $art_gus
		";
		echo "</td><td style='width:11%;'><form name='ir_al_articulo' action='' method='post'><input type='text' name='art_titulo' hidden value='$art_tit'><input type='submit' value='Me Gusta'></form></td><td style='width:11%;'><form name='art_titulo' action='articulos.php' method='get'><input type='text' name='art_titulo' hidden value='$art_tit'><input type='submit' value='Leer mas...'></form>";
		echo "</td></table></article>";
    }
?>
    <article style="background-color:#376092;">
      <table style="width:auto; margin:auto;">
        <tr>
          <td>
          <?php
          if($pagina>1){
			    $pag_ant=$pagina-1;
		  		echo "<a href='?pag_form=$pag_ant&categoria=$categoria' style='color:#EE5;'>< Página Anterior</a>&nbsp;&nbsp;&nbsp;";   
		  }else{}

		  if($pagina<>$total_paginas){
			  	$pag_sig=$pagina+1;
		  		echo "&nbsp;&nbsp;&nbsp;<a href='?pag_form=$pag_sig&categoria=$categoria' style='color:#EE5;'>Págna Siguiente ></a>";
		  }else{}

          if($total_paginas==1){
			    $pag_ant=$pagina-1;
		  		echo "<b style='color:#EE5;'><&nbsp;&nbsp;&nbsp;&nbsp;></b>";   
		  }else{}

          ?>
		  </td>
        </tr>
      </table>
    </article>
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