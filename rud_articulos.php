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
//DEFINIENDO AÑO, MES Y FECHA ACTUAL
$ano_actual=date("Y");
$mes_actual=date("m");
$fecha_y_m_d=date("Y-m-d");
$fecha_d_m_y=date("d-m-Y");

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - Modificar Todos los Articulos</title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
<?php
//header
require ("efecto_entrada.php");
?>
</head>

<body>

<?php
//header
require ("header_zona_adm_2.php");
?>

<section>
<?php
	//definiendo datos del paginado
	//registros filtrados por página
	$registros_filtrados=10;
	//página
	if(isset($_GET["pagina"])){
		$pagina=$_GET["pagina"];
	}else{$pagina=1;}
	//paginado
	$empesar_desde=($pagina-1)*$registros_filtrados;
	$sql_total="SELECT `datos_articulos`.ID AS ID FROM `datos_articulos`";
	$resultado=mysqli_query($conexion,$sql_total);
	$numero_filas=0;
	while(($fila=mysqli_fetch_array($resultado))==true){
		$numero_filas=$numero_filas+1;
	}
	$total_paginas=ceil($numero_filas/$registros_filtrados);
?>

<h1 style="text-align:center; font-size:15px; font-style:italic; background-color:#fefefe; border:#f0d78a 8px ridge; width:96%; margin:auto; margin-top:5px; margin-bottom:5px;">Se han escrito: <?php echo "$numero_filas"; ?> Artículos. / <a style="font-size:16px; color:#F00;">Se muestran <?php echo "$registros_filtrados"; ?> Artículos por página</a> / Esta es la Página <?php echo "$pagina"; ?> de <?php echo "$total_paginas"; ?> / <a style="font-size:16px; color:#F00;">Seleccione un Articulo para Modificarlo.</a></h1>

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
				FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO
				ORDER BY ART_TITULO ASC, FECHA DESC LIMIT $empesar_desde,$registros_filtrados";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $art_fec=$fila['FECHA'];
        $art_nom=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
        $art_ape=ucwords(mb_strtolower($fila['APELLIDO'],'UTF-8'));
        $art_cat=ucfirst(mb_strtolower($fila['CATEGORIA'],'UTF-8'));
        $art_tit=ucfirst(mb_strtolower($fila['ART_TITULO'],'UTF-8'));
		$art_tit_eliminar=$fila['ART_TITULO'];
        $art_vis=$fila['VISITAS'];
        $art_gus=$fila['ME_GUSTA'];
        $art_foto=$fila['FOTO_1'];
		echo "<article style='width:96%; margin:auto; margin-bottom:5px;'>";
		echo "<div class='articulo_titulo' style='height:100px; border-bottom:0;'><figure class='div-img hidden' style='height:90px; width:150px; float:left;'><a href='rud_modificar_articulo_seleccionado.php?titulo_articulo=$art_tit'><img class='img' src='IMAGENES/$art_foto' width='150px' height='90px'/></a></figure>";
		echo "<h2 style='margin-top:0px; padding:3px; padding-left:162px;'><a href='rud_modificar_articulo_seleccionado.php?titulo_articulo=$art_tit'>$art_tit</a></h2>";
		echo "<h4><img width='20px' src='IMAGENES/AUTOR.jpg'/> $art_nom $art_ape &nbsp;
			  <img width='20px' src='IMAGENES/FECHA.jpg'/> $art_fec &nbsp;
			  <img width='20px' src='IMAGENES/CATEGORIA.jpg'/> $art_cat &nbsp;
			  <img width='20px' src='IMAGENES/VISITAS.jpg'/> $art_vis &nbsp;
			  <img width='20px' src='IMAGENES/ME_GUSTA.jpg'/> $art_gus &nbsp;&nbsp;&nbsp;&nbsp;
			  <a href='rud_modificar_articulo_seleccionado.php?titulo_articulo=$art_tit'>Modificar este Artículo</a> / <a href='rud_eliminar_articulo_seleccionado_prev.php?titulo_articulo=$art_tit_eliminar'>ELIMINAR</a></h4></div>
		";
		echo "</article>";
    }
?>

	<article style='width:96%; margin:auto; margin-bottom:5px;'>
	<!--PAGINACIÓN-->
    <table>
    <tr>
  	<th style="font-size:16px;">
	<?php
	$pasos_de_pagina=intval(($total_paginas-10)/5);
	echo "Páginas disponibles:  ";

if($total_paginas<=15){
	for($i=1; $i<=$total_paginas; $i++){
		echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";
	}
}else{
	if($pagina<=5){
		for($i=1; $i<=5; $i++){
			echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";
		}
		echo " < < < ";	
		for($o=6; $o<=$total_paginas-5; $o=$o+$pasos_de_pagina){
			echo "<a href='?pagina=" . $o . "'>" . $o . "</a>  ";
		}		
		echo " > > > ";		
		echo "<a href='?pagina=" . $total_paginas . "'>" . "Ultima Página (" . $total_paginas . ")" . "</a>  ";
	}else{
	if($pagina>=$total_paginas-5){
		echo "<a href='?pagina=1'>Página-1</a>  ";
		echo " < < < ";	
		for($o=$total_paginas-($pasos_de_pagina*5); $o<=$total_paginas-4; $o=$o+$pasos_de_pagina){
			echo "<a href='?pagina=" . $o . "'>" . $o . "</a>  ";
		}		
		echo " > > > ";		
		for($e=$total_paginas-4; $e<=$total_paginas; $e++){
			echo "<a href='?pagina=" . $e . "'>" . $e . "</a>  ";
		}
	}else{	
	if($pagina>5 and $pagina<$total_paginas-4){
		echo "<a href='?pagina=1'>Página-1)</a>  ";
		echo " < < < ";	
		for($o=$pagina-5; $o<=$pagina+5; $o++){
			echo "<a href='?pagina=" . $o . "'>" . $o . "</a>  ";
		}		
		echo " > > > ";		
		echo "<a href='?pagina=" . $total_paginas . "'>" . "Ultima Página (" . $total_paginas . ")" . "</a>  ";
	}}}
}
	?>
    </th>
  	</tr>
    </table>
    </article>

</section>
</body>
</html>
<?php
mysqli_close($conexion);
?>