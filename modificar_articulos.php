<?php
session_start();
if(!isset($_SESSION["usuario_adm"]) and !isset($_SESSION["usuario_write"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO EL USUARIO Y OBTENIENDO FOTO
if(isset($_SESSION["usuario_adm"])){$user=$_SESSION["usuario_adm"];}else{
if(isset($_SESSION["usuario_write"])){$user=$_SESSION["usuario_write"];}}
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
<title>Fundación Crystal - Modificar Articulos</title>
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
	if(isset($_GET["pag_form"])){
		if($_GET["pag_form"]=='Seleccione otra Página'){$pagina=1;}else{		$pagina=$_GET["pag_form"];}
	}else{$pagina=1;}
	//paginado
	$empesar_desde=($pagina-1)*$registros_filtrados;
	$sql_total="SELECT `datos_articulos`.ID AS ID FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO WHERE `datos_usuarios`.NOMBRE = '$autor_nombre' AND `datos_usuarios`.APELLIDO = '$autor_apellido'";
	$resultado=mysqli_query($conexion,$sql_total);
	$numero_filas=0;
	while(($fila=mysqli_fetch_array($resultado))==true){
		$numero_filas=$numero_filas+1;
	}
	$total_paginas=ceil($numero_filas/$registros_filtrados);
?>

<h1 style="text-align:center; font-size:28px; font-style:italic; background-color:#fefefe; border:#f0d78a 8px ridge; width:90%; margin:auto; margin-top:5px; margin-bottom:5px;">Usted ha escrito: <?php echo "$numero_filas"; ?> Artículos.
<br><a style="font-size:16px; color:#F00;">Se muestran <?php echo "$registros_filtrados"; ?> Artículos por página &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp; Esta es la Página <?php echo "$pagina"; ?> de <?php echo "$total_paginas"; ?> &nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp; Seleccione un Articulo para Modificarlo.</a></h1>

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
				`datos_usuarios`.NOMBRE = '$autor_nombre' AND `datos_usuarios`.APELLIDO = '$autor_apellido'
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
		echo "<article style='width:90%; margin:auto; margin-bottom:5px;'>";
		echo "<div class='articulo_titulo' style='height:110px; border-bottom:0;'><figure class='div-img hidden' style='height:100px; width:150px; float:left;'><a href='modificar_articulo_seleccionado.php?titulo_articulo=$art_tit'><img class='img' src='IMAGENES/$art_foto' width='150px' height='100px'/></a></figure>";
		echo "<h2 style='margin-top:0px; padding:3px; padding-left:162px;'><a href='modificar_articulo_seleccionado.php?titulo_articulo=$art_tit'>$art_tit</a></h2>";
		echo "<h4><img width='20px' src='IMAGENES/AUTOR.jpg'/> $art_nom $art_ape &nbsp;
			  <img width='20px' src='IMAGENES/FECHA.jpg'/> $art_fec &nbsp;
			  <img width='20px' src='IMAGENES/CATEGORIA.jpg'/> $art_cat &nbsp;
			  <img width='20px' src='IMAGENES/VISITAS.jpg'/> $art_vis &nbsp;
			  <img width='20px' src='IMAGENES/ME_GUSTA.jpg'/> $art_gus &nbsp;&nbsp;&nbsp;&nbsp;
			  <a href='modificar_articulo_seleccionado.php?titulo_articulo=$art_tit'>Modificar este Artículo ></a></h4></div>
		";
		echo "</article>";
    }
?>
    <article  style='width:90%; margin:auto;'>
      <table style="width:auto; margin:auto;">
        <tr>
          <td>
          <?php
          if($pagina>1){
			    $pag_ant=$pagina-1;
		  		echo "<a href='?pag_form=$pag_ant'>< Página Anterior</a>&nbsp;&nbsp;&nbsp;";   
		  }else{}

		  if($pagina<>$total_paginas){
			  	$pag_sig=$pagina+1;
		  		echo "&nbsp;&nbsp;&nbsp;<a href='?pag_form=$pag_sig'>Págna Siguiente ></a>";
		  }else{}

          if($total_paginas==1){
			    $pag_ant=$pagina-1;
		  		echo "<&nbsp;&nbsp;&nbsp;&nbsp;>";   
		  }else{}
          ?>
		  </td>
        </tr>
      </table>
    </article>
</section>
<br><br>
</body>
</html>
<?php
mysqli_close($conexion);
?>