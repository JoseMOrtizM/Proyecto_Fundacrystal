<?php
//conexion
require ("conexion.php");
if(!isset($_GET['art_titulo'])){}else{
	$titulo_articulo=$_GET['art_titulo'];
	//SUMANDO UNA VISITA AL ARTICULO
	$consulta="UPDATE `datos_articulos` SET VISITAS=VISITAS+1 WHERE ART_TITULO='$titulo_articulo'";
	$resultado=mysqli_query($conexion,$consulta);
}
if(!isset($_POST['art_titulo'])){}else{
	$titulo_articulo=$_POST['art_titulo'];
	//SUMANDO UN ME_GUSTA AL ARTICULO
	$consulta="UPDATE `datos_articulos` SET ME_GUSTA=ME_GUSTA+1 WHERE ART_TITULO='$titulo_articulo'";
	$resultado=mysqli_query($conexion,$consulta);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<?php
//META CANONICAL PARA INDEX
echo "<link rel='canonical' href='http://www.fundacrystal.tk/articulos.php' />";
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
<title><?php echo "fundacrystal: $titulo_articulo"; ?></title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
<style>
br{
	margin-bottom: 5px;
}
</style>
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
//DEFINIENDO MENSAJE EN PANTALLA PARA ERRORES:
if(!isset($titulo_articulo)){
	echo "<article style='border:#473663 8px ridge; border-radius:30px 0px 20px 0px; color:#FFF; background-color:#376092; margin-top:15px;'><h1 class='aside_titulo' style='border-radius:20px 0px 10px 0px; border-top:0px; border-bottom:0px; color:#000;'>Seleccione un Artículo</h1></article>";
}else{
	//definiendo datos del paginado
	//registros filtrados por página
	$registros_filtrados=10;
	//página
	if(isset($_GET["pag_form"])){
		if($_GET["pag_form"]=='Seleccione otra Página'){$pagina=1;}else{		$pagina=$_GET["pag_form"];}
	}else{$pagina=1;}
	//paginado
	$empesar_desde=($pagina-1)*$registros_filtrados;
	$sql_total="SELECT `datos_comentarios`.ID AS ID FROM `datos_comentarios` WHERE `datos_comentarios`.ART_TITULO = '$titulo_articulo'";
	$resultado=mysqli_query($conexion,$sql_total);
	$numero_filas=0;
	while(($fila=mysqli_fetch_array($resultado))==true){
		$numero_filas=$numero_filas+1;
	}
	$total_paginas=ceil($numero_filas/$registros_filtrados);
	//CREANDO ARRAY DE ESTILO PARA LAS IMÁGENES
	$posicion[0]='float:left; width:49%; margin:1%;';
	$posicion[1]='float:right; width:49%; margin:1%;';
	$posicion[2]='float:none; width:auto%; margin:1%;';
	//OBTENIENDO DATOS DEL ARTICULO
	$sql_total="SELECT 
				`datos_articulos`.ART_FECHA AS FECHA,
				`datos_usuarios`.NOMBRE AS NOMBRE,
				`datos_usuarios`.APELLIDO AS APELLIDO,
				`datos_articulos`.CATEGORIA AS CATEGORIA,
				`datos_articulos`.ART_TITULO AS ART_TITULO,
				`datos_articulos`.VISITAS AS VISITAS,
				`datos_articulos`.ME_GUSTA AS ME_GUSTA,
				`datos_articulos`.FOTO_1 AS FOTO_1,
				`datos_articulos`.SUB_TITULO_1 AS SUB_TITULO_1,
				`datos_articulos`.PARRAFO_1 AS PARRAFO_1,
				`datos_articulos`.FOTO_2 AS FOTO_2,
				`datos_articulos`.SUB_TITULO_2 AS SUB_TITULO_2,
				`datos_articulos`.PARRAFO_2 AS PARRAFO_2,
				`datos_articulos`.FOTO_3 AS FOTO_3,
				`datos_articulos`.SUB_TITULO_3 AS SUB_TITULO_3,
				`datos_articulos`.PARRAFO_3 AS PARRAFO_3,
				`datos_articulos`.FOTO_4 AS FOTO_4,
				`datos_articulos`.SUB_TITULO_4 AS SUB_TITULO_4,
				`datos_articulos`.PARRAFO_4 AS PARRAFO_4,
				`datos_articulos`.FOTO_5 AS FOTO_5,
				`datos_articulos`.SUB_TITULO_5 AS SUB_TITULO_5,
				`datos_articulos`.PARRAFO_5 AS PARRAFO_5,
				`datos_articulos`.FOTO_6 AS FOTO_6,
				`datos_articulos`.SUB_TITULO_6 AS SUB_TITULO_6,
				`datos_articulos`.PARRAFO_6 AS PARRAFO_6,
				`datos_articulos`.FOTO_7 AS FOTO_7,
				`datos_articulos`.SUB_TITULO_7 AS SUB_TITULO_7,
				`datos_articulos`.PARRAFO_7 AS PARRAFO_7,
				`datos_articulos`.FOTO_8 AS FOTO_8,
				`datos_articulos`.SUB_TITULO_8 AS SUB_TITULO_8,
				`datos_articulos`.PARRAFO_8 AS PARRAFO_8,
				`datos_articulos`.FOTO_9 AS FOTO_9,
				`datos_articulos`.SUB_TITULO_9 AS SUB_TITULO_9,
				`datos_articulos`.PARRAFO_9 AS PARRAFO_9,
				`datos_articulos`.FOTO_10 AS FOTO_10,
				`datos_articulos`.SUB_TITULO_10 AS SUB_TITULO_10,
				`datos_articulos`.PARRAFO_10 AS PARRAFO_10,
				`datos_articulos`.FOTO_11 AS FOTO_11,
				`datos_articulos`.SUB_TITULO_11 AS SUB_TITULO_11,
				`datos_articulos`.PARRAFO_11 AS PARRAFO_11,
				`datos_articulos`.FOTO_12 AS FOTO_12,
				`datos_articulos`.SUB_TITULO_12 AS SUB_TITULO_12,
				`datos_articulos`.PARRAFO_12 AS PARRAFO_12,
				`datos_articulos`.FOTO_13 AS FOTO_13,
				`datos_articulos`.SUB_TITULO_13 AS SUB_TITULO_13,
				`datos_articulos`.PARRAFO_13 AS PARRAFO_13,
				`datos_articulos`.FOTO_14 AS FOTO_14,
				`datos_articulos`.SUB_TITULO_14 AS SUB_TITULO_14,
				`datos_articulos`.PARRAFO_14 AS PARRAFO_14,
				`datos_articulos`.FOTO_15 AS FOTO_15,
				`datos_articulos`.SUB_TITULO_15 AS SUB_TITULO_15,
				`datos_articulos`.PARRAFO_15 AS PARRAFO_15,
				`datos_articulos`.FOTO_16 AS FOTO_16,
				`datos_articulos`.SUB_TITULO_16 AS SUB_TITULO_16,
				`datos_articulos`.PARRAFO_16 AS PARRAFO_16,
				`datos_articulos`.FOTO_17 AS FOTO_17,
				`datos_articulos`.SUB_TITULO_17 AS SUB_TITULO_17,
				`datos_articulos`.PARRAFO_17 AS PARRAFO_17,
				`datos_articulos`.FOTO_18 AS FOTO_18,
				`datos_articulos`.SUB_TITULO_18 AS SUB_TITULO_18,
				`datos_articulos`.PARRAFO_18 AS PARRAFO_18,
				`datos_articulos`.FOTO_19 AS FOTO_19,
				`datos_articulos`.SUB_TITULO_19 AS SUB_TITULO_19,
				`datos_articulos`.PARRAFO_19 AS PARRAFO_19,
				`datos_articulos`.FOTO_20 AS FOTO_20,
				`datos_articulos`.SUB_TITULO_20 AS SUB_TITULO_20,
				`datos_articulos`.PARRAFO_20 AS PARRAFO_20
				FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO WHERE 
				`datos_articulos`.ART_TITULO = '$titulo_articulo'";
	$resultado=mysqli_query($conexion,$sql_total);
	//IMPRIMIENDO ARTICULO COMPLETO
	$fila=mysqli_fetch_array($resultado);
	$art_fec=$fila['FECHA'];
	$art_nom=$fila['NOMBRE'];
	$art_ape=$fila['APELLIDO'];
	$art_cat=$fila['CATEGORIA'];
	$art_tit=$fila['ART_TITULO'];
	$art_tit_comentarios=$fila['ART_TITULO'];
	$art_vis=$fila['VISITAS'];
	$art_gus=$fila['ME_GUSTA'];
	$art_subt_i[0]=$fila['SUB_TITULO_1'];
	$art_parr_i[0]=$fila['PARRAFO_1'];
	$art_foto_i[0]=$fila['FOTO_1'];
	$art_subt_i[1]=$fila['SUB_TITULO_2'];
	$art_parr_i[1]=$fila['PARRAFO_2'];
	$art_foto_i[1]=$fila['FOTO_2'];
	$art_subt_i[2]=$fila['SUB_TITULO_3'];
	$art_parr_i[2]=$fila['PARRAFO_3'];
	$art_foto_i[2]=$fila['FOTO_3'];
	$art_subt_i[3]=$fila['SUB_TITULO_4'];
	$art_parr_i[3]=$fila['PARRAFO_4'];
	$art_foto_i[3]=$fila['FOTO_4'];
	$art_subt_i[4]=$fila['SUB_TITULO_5'];
	$art_parr_i[4]=$fila['PARRAFO_5'];
	$art_foto_i[4]=$fila['FOTO_5'];
	$art_subt_i[5]=$fila['SUB_TITULO_6'];
	$art_parr_i[5]=$fila['PARRAFO_6'];
	$art_foto_i[5]=$fila['FOTO_6'];
	$art_subt_i[6]=$fila['SUB_TITULO_7'];
	$art_parr_i[6]=$fila['PARRAFO_7'];
	$art_foto_i[6]=$fila['FOTO_7'];
	$art_subt_i[7]=$fila['SUB_TITULO_8'];
	$art_parr_i[7]=$fila['PARRAFO_8'];
	$art_foto_i[7]=$fila['FOTO_8'];
	$art_subt_i[8]=$fila['SUB_TITULO_9'];
	$art_parr_i[8]=$fila['PARRAFO_9'];
	$art_foto_i[8]=$fila['FOTO_9'];
	$art_subt_i[9]=$fila['SUB_TITULO_10'];
	$art_parr_i[9]=$fila['PARRAFO_10'];
	$art_foto_i[9]=$fila['FOTO_10'];
	$art_subt_i[10]=$fila['SUB_TITULO_11'];
	$art_parr_i[10]=$fila['PARRAFO_11'];
	$art_foto_i[10]=$fila['FOTO_11'];
	$art_subt_i[11]=$fila['SUB_TITULO_12'];
	$art_parr_i[11]=$fila['PARRAFO_12'];
	$art_foto_i[11]=$fila['FOTO_12'];
	$art_subt_i[12]=$fila['SUB_TITULO_13'];
	$art_parr_i[12]=$fila['PARRAFO_13'];
	$art_foto_i[12]=$fila['FOTO_13'];
	$art_subt_i[13]=$fila['SUB_TITULO_14'];
	$art_parr_i[13]=$fila['PARRAFO_14'];
	$art_foto_i[13]=$fila['FOTO_14'];
	$art_subt_i[14]=$fila['SUB_TITULO_15'];
	$art_parr_i[14]=$fila['PARRAFO_15'];
	$art_foto_i[14]=$fila['FOTO_15'];
	$art_subt_i[15]=$fila['SUB_TITULO_16'];
	$art_parr_i[15]=$fila['PARRAFO_16'];
	$art_foto_i[15]=$fila['FOTO_16'];
	$art_subt_i[16]=$fila['SUB_TITULO_17'];
	$art_parr_i[16]=$fila['PARRAFO_17'];
	$art_foto_i[16]=$fila['FOTO_17'];
	$art_subt_i[17]=$fila['SUB_TITULO_18'];
	$art_parr_i[17]=$fila['PARRAFO_18'];
	$art_foto_i[17]=$fila['FOTO_18'];
	$art_subt_i[18]=$fila['SUB_TITULO_19'];
	$art_parr_i[18]=$fila['PARRAFO_19'];
	$art_foto_i[18]=$fila['FOTO_19'];
	$art_subt_i[19]=$fila['SUB_TITULO_20'];
	$art_parr_i[19]=$fila['PARRAFO_20'];
	$art_foto_i[19]=$fila['FOTO_20'];

	//REEMPLAZANDO ".", "/", ":", ")", "?", "!" POR "<BR><BR>" PARA TODOS LOS PARRAFOS
	$cta_parrafo=0;
	while($cta_parrafo<20){
		$reemplazo_enter=str_replace(".",".<br>",$art_parr_i[$cta_parrafo]);
		$reemplazo_enter=str_replace(".<br> ",". ",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>.","..",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>/","./",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>,",".,",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>)",".)",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>!",".!",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>:",".:",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>a",".a",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>b",".b",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>c",".c",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>d",".d",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>e",".e",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>f",".f",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>g",".g",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>h",".h",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>i",".i",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>j",".j",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>k",".k",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>l",".l",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>m",".m",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>n",".n",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>ñ",".ñ",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>o",".o",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>p",".p",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>q",".q",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>r",".r",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>s",".s",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>t",".t",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>u",".u",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>v",".v",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>w",".w",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>x",".x",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>y",".y",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>z",".z",$reemplazo_enter);
		$reemplazo_enter=str_replace("/","/<br>",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br> ","/ ",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>.","/.",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>/","//",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>,","/,",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>)","/)",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>!","/!",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>:","/:",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>a","/a",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>b","/b",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>c","/c",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>d","/d",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>e","/e",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>f","/f",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>g","/g",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>h","/h",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>i","/i",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>j","/j",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>k","/k",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>l","/l",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>m","/m",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>n","/n",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>ñ","/ñ",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>o","/o",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>p","/p",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>q","/q",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>r","/r",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>s","/s",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>t","/t",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>u","/u",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>v","/v",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>w","/w",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>x","/x",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>y","/y",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>z","/z",$reemplazo_enter);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br> ",": ",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>.",":.",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>/",":/",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>,",":,",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>)",":)",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>!",":!",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>:","::",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>a",":a",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>b",":b",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>c",":c",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>d",":d",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>e",":e",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>f",":f",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>g",":g",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>h",":h",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>i",":i",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>j",":j",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>k",":k",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>l",":l",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>m",":m",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>n",":n",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>ñ",":ñ",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>o",":o",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>p",":p",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>q",":q",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>r",":r",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>s",":s",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>t",":t",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>u",":u",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>v",":v",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>w",":w",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>x",":x",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>y",":y",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>z",":z",$reemplazo_enter);
		$reemplazo_enter=str_replace(")",")<br>",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br> ",") ",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>.",").",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>/",")/",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>,","),",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>)","))",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>!",")!",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>:","):",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>a",")a",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>b",")b",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>c",")c",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>d",")d",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>e",")e",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>f",")f",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>g",")g",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>h",")h",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>i",")i",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>j",")j",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>k",")k",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>l",")l",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>m",")m",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>n",")n",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>ñ",")ñ",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>o",")o",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>p",")p",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>q",")q",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>r",")r",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>s",")s",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>t",")t",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>u",")u",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>v",")v",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>w",")w",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>x",")x",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>y",")y",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>z",")z",$reemplazo_enter);
		$reemplazo_enter=str_replace("?","?<br>",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br> ","? ",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>.","?.",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>/","?/",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>,","?,",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>)","?)",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>!","?!",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>:","?:",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>a","?a",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>b","?b",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>c","?c",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>d","?d",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>e","?e",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>f","?f",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>g","?g",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>h","?h",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>i","?i",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>j","?j",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>k","?k",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>l","?l",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>m","?m",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>n","?n",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>ñ","?ñ",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>o","?o",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>p","?p",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>q","?q",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>r","?r",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>s","?s",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>t","?t",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>u","?u",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>v","?v",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>w","?w",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>x","?x",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>y","?y",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>z","?z",$reemplazo_enter);
		$reemplazo_enter=str_replace("!","!<br>",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br> ","! ",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>.","!.",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>/","!/",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>,","!,",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>)","!)",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>!","!!",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>:","!:",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>a","!a",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>b","!b",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>c","!c",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>d","!d",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>e","!e",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>f","!f",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>g","!g",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>h","!h",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>i","!i",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>j","!j",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>k","!k",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>l","!l",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>m","!m",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>n","!n",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>ñ","!ñ",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>o","!o",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>p","!p",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>q","!q",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>r","!r",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>s","!s",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>t","!t",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>u","!u",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>v","!v",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>w","!w",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>x","!x",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>y","!y",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>z","!z",$reemplazo_enter);
		//PARA NO SALTASR LOS ";""
		$reemplazo_enter=str_replace(".<br>;",".;",$reemplazo_enter);
		$reemplazo_enter=str_replace("/<br>;","/;",$reemplazo_enter);
		$reemplazo_enter=str_replace(":<br>;",":;",$reemplazo_enter);
		$reemplazo_enter=str_replace(")<br>;",");",$reemplazo_enter);
		$reemplazo_enter=str_replace("?<br>;","?;",$reemplazo_enter);
		$reemplazo_enter=str_replace("!<br>;","!;",$reemplazo_enter);
		//PARA NO SALTAR LOS NÚMEROS MAYORES AL MIL
		$reemplazo_enter=str_replace(".<br>000",".000",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>001",".001",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>002",".002",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>003",".003",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>004",".004",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>005",".005",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>006",".006",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>007",".007",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>008",".008",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>009",".009",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>010",".010",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>011",".011",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>012",".012",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>013",".013",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>014",".014",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>015",".015",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>016",".016",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>017",".017",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>018",".018",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>019",".019",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>020",".020",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>021",".021",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>022",".022",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>023",".023",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>024",".024",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>025",".025",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>026",".026",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>027",".027",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>028",".028",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>029",".029",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>030",".030",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>031",".031",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>032",".032",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>033",".033",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>034",".034",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>035",".035",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>036",".036",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>037",".037",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>038",".038",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>039",".039",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>040",".040",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>041",".041",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>042",".042",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>043",".043",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>044",".044",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>045",".045",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>046",".046",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>047",".047",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>048",".048",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>049",".049",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>050",".050",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>051",".051",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>052",".052",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>053",".053",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>054",".054",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>055",".055",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>056",".056",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>057",".057",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>058",".058",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>059",".059",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>060",".060",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>061",".061",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>062",".062",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>063",".063",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>064",".064",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>065",".065",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>066",".066",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>067",".067",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>068",".068",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>069",".069",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>070",".070",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>071",".071",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>072",".072",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>073",".073",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>074",".074",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>075",".075",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>076",".076",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>077",".077",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>078",".078",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>079",".079",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>080",".080",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>081",".081",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>082",".082",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>083",".083",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>084",".084",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>085",".085",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>086",".086",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>087",".087",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>088",".088",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>089",".089",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>090",".090",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>091",".091",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>092",".092",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>093",".093",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>094",".094",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>095",".095",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>096",".096",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>097",".097",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>098",".098",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>099",".099",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>100",".100",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>101",".101",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>102",".102",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>103",".103",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>104",".104",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>105",".105",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>106",".106",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>107",".107",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>108",".108",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>109",".109",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>110",".110",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>111",".111",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>112",".112",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>113",".113",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>114",".114",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>115",".115",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>116",".116",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>117",".117",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>118",".118",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>119",".119",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>120",".120",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>121",".121",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>122",".122",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>123",".123",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>124",".124",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>125",".125",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>126",".126",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>127",".127",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>128",".128",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>129",".129",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>130",".130",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>131",".131",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>132",".132",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>133",".133",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>134",".134",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>135",".135",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>136",".136",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>137",".137",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>138",".138",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>139",".139",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>140",".140",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>141",".141",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>142",".142",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>143",".143",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>144",".144",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>145",".145",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>146",".146",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>147",".147",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>148",".148",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>149",".149",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>150",".150",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>151",".151",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>152",".152",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>153",".153",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>154",".154",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>155",".155",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>156",".156",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>157",".157",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>158",".158",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>159",".159",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>160",".160",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>161",".161",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>162",".162",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>163",".163",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>164",".164",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>165",".165",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>166",".166",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>167",".167",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>168",".168",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>169",".169",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>170",".170",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>171",".171",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>172",".172",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>173",".173",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>174",".174",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>175",".175",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>176",".176",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>177",".177",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>178",".178",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>179",".179",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>180",".180",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>181",".181",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>182",".182",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>183",".183",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>184",".184",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>185",".185",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>186",".186",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>187",".187",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>188",".188",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>189",".189",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>190",".190",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>191",".191",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>192",".192",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>193",".193",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>194",".194",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>195",".195",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>196",".196",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>197",".197",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>198",".198",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>199",".199",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>200",".200",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>201",".201",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>202",".202",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>203",".203",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>204",".204",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>205",".205",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>206",".206",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>207",".207",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>208",".208",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>209",".209",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>210",".210",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>211",".211",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>212",".212",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>213",".213",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>214",".214",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>215",".215",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>216",".216",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>217",".217",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>218",".218",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>219",".219",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>220",".220",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>221",".221",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>222",".222",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>223",".223",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>224",".224",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>225",".225",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>226",".226",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>227",".227",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>228",".228",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>229",".229",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>230",".230",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>231",".231",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>232",".232",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>233",".233",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>234",".234",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>235",".235",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>236",".236",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>237",".237",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>238",".238",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>239",".239",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>240",".240",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>241",".241",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>242",".242",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>243",".243",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>244",".244",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>245",".245",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>246",".246",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>247",".247",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>248",".248",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>249",".249",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>250",".250",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>251",".251",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>252",".252",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>253",".253",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>254",".254",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>255",".255",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>256",".256",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>257",".257",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>258",".258",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>259",".259",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>260",".260",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>261",".261",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>262",".262",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>263",".263",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>264",".264",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>265",".265",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>266",".266",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>267",".267",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>268",".268",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>269",".269",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>270",".270",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>271",".271",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>272",".272",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>273",".273",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>274",".274",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>275",".275",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>276",".276",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>277",".277",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>278",".278",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>279",".279",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>280",".280",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>281",".281",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>282",".282",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>283",".283",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>284",".284",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>285",".285",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>286",".286",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>287",".287",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>288",".288",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>289",".289",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>290",".290",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>291",".291",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>292",".292",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>293",".293",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>294",".294",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>295",".295",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>296",".296",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>297",".297",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>298",".298",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>299",".299",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>300",".300",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>301",".301",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>302",".302",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>303",".303",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>304",".304",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>305",".305",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>306",".306",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>307",".307",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>308",".308",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>309",".309",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>310",".310",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>311",".311",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>312",".312",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>313",".313",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>314",".314",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>315",".315",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>316",".316",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>317",".317",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>318",".318",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>319",".319",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>320",".320",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>321",".321",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>322",".322",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>323",".323",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>324",".324",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>325",".325",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>326",".326",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>327",".327",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>328",".328",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>329",".329",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>330",".330",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>331",".331",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>332",".332",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>333",".333",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>334",".334",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>335",".335",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>336",".336",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>337",".337",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>338",".338",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>339",".339",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>340",".340",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>341",".341",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>342",".342",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>343",".343",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>344",".344",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>345",".345",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>346",".346",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>347",".347",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>348",".348",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>349",".349",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>350",".350",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>351",".351",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>352",".352",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>353",".353",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>354",".354",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>355",".355",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>356",".356",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>357",".357",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>358",".358",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>359",".359",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>360",".360",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>361",".361",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>362",".362",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>363",".363",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>364",".364",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>365",".365",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>366",".366",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>367",".367",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>368",".368",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>369",".369",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>370",".370",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>371",".371",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>372",".372",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>373",".373",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>374",".374",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>375",".375",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>376",".376",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>377",".377",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>378",".378",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>379",".379",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>380",".380",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>381",".381",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>382",".382",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>383",".383",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>384",".384",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>385",".385",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>386",".386",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>387",".387",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>388",".388",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>389",".389",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>390",".390",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>391",".391",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>392",".392",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>393",".393",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>394",".394",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>395",".395",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>396",".396",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>397",".397",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>398",".398",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>399",".399",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>400",".400",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>401",".401",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>402",".402",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>403",".403",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>404",".404",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>405",".405",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>406",".406",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>407",".407",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>408",".408",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>409",".409",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>410",".410",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>411",".411",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>412",".412",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>413",".413",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>414",".414",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>415",".415",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>416",".416",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>417",".417",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>418",".418",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>419",".419",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>420",".420",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>421",".421",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>422",".422",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>423",".423",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>424",".424",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>425",".425",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>426",".426",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>427",".427",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>428",".428",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>429",".429",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>430",".430",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>431",".431",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>432",".432",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>433",".433",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>434",".434",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>435",".435",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>436",".436",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>437",".437",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>438",".438",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>439",".439",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>440",".440",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>441",".441",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>442",".442",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>443",".443",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>444",".444",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>445",".445",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>446",".446",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>447",".447",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>448",".448",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>449",".449",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>450",".450",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>451",".451",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>452",".452",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>453",".453",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>454",".454",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>455",".455",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>456",".456",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>457",".457",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>458",".458",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>459",".459",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>460",".460",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>461",".461",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>462",".462",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>463",".463",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>464",".464",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>465",".465",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>466",".466",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>467",".467",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>468",".468",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>469",".469",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>470",".470",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>471",".471",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>472",".472",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>473",".473",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>474",".474",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>475",".475",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>476",".476",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>477",".477",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>478",".478",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>479",".479",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>480",".480",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>481",".481",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>482",".482",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>483",".483",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>484",".484",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>485",".485",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>486",".486",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>487",".487",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>488",".488",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>489",".489",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>490",".490",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>491",".491",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>492",".492",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>493",".493",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>494",".494",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>495",".495",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>496",".496",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>497",".497",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>498",".498",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>499",".499",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>500",".500",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>501",".501",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>502",".502",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>503",".503",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>504",".504",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>505",".505",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>506",".506",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>507",".507",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>508",".508",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>509",".509",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>510",".510",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>511",".511",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>512",".512",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>513",".513",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>514",".514",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>515",".515",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>516",".516",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>517",".517",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>518",".518",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>519",".519",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>520",".520",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>521",".521",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>522",".522",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>523",".523",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>524",".524",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>525",".525",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>526",".526",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>527",".527",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>528",".528",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>529",".529",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>530",".530",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>531",".531",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>532",".532",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>533",".533",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>534",".534",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>535",".535",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>536",".536",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>537",".537",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>538",".538",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>539",".539",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>540",".540",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>541",".541",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>542",".542",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>543",".543",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>544",".544",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>545",".545",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>546",".546",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>547",".547",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>548",".548",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>549",".549",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>550",".550",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>551",".551",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>552",".552",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>553",".553",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>554",".554",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>555",".555",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>556",".556",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>557",".557",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>558",".558",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>559",".559",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>560",".560",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>561",".561",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>562",".562",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>563",".563",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>564",".564",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>565",".565",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>566",".566",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>567",".567",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>568",".568",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>569",".569",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>570",".570",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>571",".571",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>572",".572",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>573",".573",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>574",".574",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>575",".575",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>576",".576",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>577",".577",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>578",".578",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>579",".579",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>580",".580",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>581",".581",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>582",".582",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>583",".583",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>584",".584",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>585",".585",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>586",".586",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>587",".587",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>588",".588",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>589",".589",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>590",".590",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>591",".591",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>592",".592",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>593",".593",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>594",".594",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>595",".595",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>596",".596",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>597",".597",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>598",".598",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>599",".599",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>600",".600",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>601",".601",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>602",".602",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>603",".603",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>604",".604",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>605",".605",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>606",".606",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>607",".607",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>608",".608",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>609",".609",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>610",".610",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>611",".611",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>612",".612",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>613",".613",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>614",".614",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>615",".615",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>616",".616",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>617",".617",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>618",".618",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>619",".619",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>620",".620",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>621",".621",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>622",".622",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>623",".623",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>624",".624",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>625",".625",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>626",".626",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>627",".627",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>628",".628",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>629",".629",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>630",".630",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>631",".631",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>632",".632",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>633",".633",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>634",".634",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>635",".635",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>636",".636",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>637",".637",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>638",".638",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>639",".639",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>640",".640",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>641",".641",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>642",".642",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>643",".643",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>644",".644",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>645",".645",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>646",".646",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>647",".647",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>648",".648",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>649",".649",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>650",".650",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>651",".651",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>652",".652",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>653",".653",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>654",".654",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>655",".655",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>656",".656",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>657",".657",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>658",".658",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>659",".659",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>660",".660",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>661",".661",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>662",".662",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>663",".663",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>664",".664",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>665",".665",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>666",".666",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>667",".667",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>668",".668",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>669",".669",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>670",".670",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>671",".671",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>672",".672",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>673",".673",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>674",".674",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>675",".675",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>676",".676",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>677",".677",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>678",".678",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>679",".679",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>680",".680",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>681",".681",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>682",".682",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>683",".683",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>684",".684",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>685",".685",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>686",".686",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>687",".687",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>688",".688",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>689",".689",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>690",".690",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>691",".691",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>692",".692",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>693",".693",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>694",".694",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>695",".695",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>696",".696",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>697",".697",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>698",".698",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>699",".699",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>700",".700",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>701",".701",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>702",".702",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>703",".703",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>704",".704",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>705",".705",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>706",".706",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>707",".707",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>708",".708",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>709",".709",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>710",".710",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>711",".711",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>712",".712",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>713",".713",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>714",".714",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>715",".715",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>716",".716",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>717",".717",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>718",".718",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>719",".719",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>720",".720",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>721",".721",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>722",".722",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>723",".723",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>724",".724",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>725",".725",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>726",".726",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>727",".727",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>728",".728",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>729",".729",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>730",".730",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>731",".731",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>732",".732",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>733",".733",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>734",".734",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>735",".735",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>736",".736",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>737",".737",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>738",".738",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>739",".739",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>740",".740",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>741",".741",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>742",".742",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>743",".743",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>744",".744",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>745",".745",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>746",".746",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>747",".747",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>748",".748",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>749",".749",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>750",".750",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>751",".751",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>752",".752",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>753",".753",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>754",".754",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>755",".755",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>756",".756",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>757",".757",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>758",".758",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>759",".759",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>760",".760",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>761",".761",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>762",".762",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>763",".763",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>764",".764",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>765",".765",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>766",".766",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>767",".767",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>768",".768",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>769",".769",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>770",".770",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>771",".771",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>772",".772",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>773",".773",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>774",".774",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>775",".775",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>776",".776",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>777",".777",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>778",".778",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>779",".779",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>780",".780",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>781",".781",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>782",".782",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>783",".783",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>784",".784",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>785",".785",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>786",".786",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>787",".787",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>788",".788",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>789",".789",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>790",".790",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>791",".791",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>792",".792",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>793",".793",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>794",".794",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>795",".795",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>796",".796",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>797",".797",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>798",".798",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>799",".799",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>800",".800",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>801",".801",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>802",".802",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>803",".803",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>804",".804",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>805",".805",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>806",".806",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>807",".807",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>808",".808",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>809",".809",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>810",".810",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>811",".811",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>812",".812",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>813",".813",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>814",".814",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>815",".815",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>816",".816",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>817",".817",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>818",".818",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>819",".819",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>820",".820",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>821",".821",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>822",".822",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>823",".823",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>824",".824",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>825",".825",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>826",".826",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>827",".827",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>828",".828",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>829",".829",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>830",".830",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>831",".831",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>832",".832",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>833",".833",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>834",".834",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>835",".835",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>836",".836",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>837",".837",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>838",".838",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>839",".839",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>840",".840",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>841",".841",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>842",".842",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>843",".843",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>844",".844",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>845",".845",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>846",".846",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>847",".847",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>848",".848",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>849",".849",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>850",".850",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>851",".851",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>852",".852",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>853",".853",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>854",".854",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>855",".855",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>856",".856",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>857",".857",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>858",".858",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>859",".859",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>860",".860",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>861",".861",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>862",".862",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>863",".863",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>864",".864",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>865",".865",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>866",".866",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>867",".867",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>868",".868",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>869",".869",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>870",".870",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>871",".871",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>872",".872",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>873",".873",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>874",".874",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>875",".875",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>876",".876",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>877",".877",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>878",".878",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>879",".879",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>880",".880",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>881",".881",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>882",".882",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>883",".883",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>884",".884",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>885",".885",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>886",".886",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>887",".887",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>888",".888",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>889",".889",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>890",".890",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>891",".891",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>892",".892",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>893",".893",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>894",".894",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>895",".895",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>896",".896",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>897",".897",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>898",".898",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>899",".899",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>900",".900",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>901",".901",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>902",".902",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>903",".903",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>904",".904",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>905",".905",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>906",".906",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>907",".907",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>908",".908",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>909",".909",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>910",".910",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>911",".911",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>912",".912",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>913",".913",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>914",".914",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>915",".915",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>916",".916",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>917",".917",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>918",".918",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>919",".919",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>920",".920",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>921",".921",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>922",".922",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>923",".923",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>924",".924",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>925",".925",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>926",".926",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>927",".927",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>928",".928",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>929",".929",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>930",".930",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>931",".931",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>932",".932",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>933",".933",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>934",".934",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>935",".935",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>936",".936",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>937",".937",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>938",".938",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>939",".939",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>940",".940",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>941",".941",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>942",".942",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>943",".943",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>944",".944",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>945",".945",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>946",".946",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>947",".947",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>948",".948",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>949",".949",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>950",".950",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>951",".951",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>952",".952",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>953",".953",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>954",".954",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>955",".955",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>956",".956",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>957",".957",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>958",".958",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>959",".959",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>960",".960",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>961",".961",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>962",".962",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>963",".963",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>964",".964",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>965",".965",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>966",".966",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>967",".967",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>968",".968",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>969",".969",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>970",".970",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>971",".971",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>972",".972",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>973",".973",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>974",".974",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>975",".975",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>976",".976",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>977",".977",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>978",".978",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>979",".979",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>980",".980",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>981",".981",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>982",".982",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>983",".983",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>984",".984",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>985",".985",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>986",".986",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>987",".987",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>988",".988",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>989",".989",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>990",".990",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>991",".991",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>992",".992",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>993",".993",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>994",".994",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>995",".995",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>996",".996",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>997",".997",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>998",".998",$reemplazo_enter);
		$reemplazo_enter=str_replace(".<br>999",".999",$reemplazo_enter);
		//FINALMENTE EL PARRAFO QUEDA ASÍ
		$art_parr_i[$cta_parrafo]=$reemplazo_enter;
		//PASANDO AL SIGUIENTE PARRAFO
		$cta_parrafo=$cta_parrafo+1;
	}

	//IMPRIMIENDO ENCABEZADO DEL ARTICULO
	echo "<article style='background-color:#fff; margin-top:15px; border-radius:30px 0px 20px 0px;'>";
	echo "<div class='articulo_titulo' style='color:#000; border-radius:20px 0px 0px 0px;'><h2 style='margin-top:0px;'>$art_tit</h2>";
	echo "<table style='font-size:14px; background-color:#fff;'><td style='text-align:justify; padding-left:0.5%;'>
		  <img width='20px' src='IMAGENES/AUTOR.jpg'/> $art_nom $art_ape
		  <img width='20px' src='IMAGENES/FECHA.jpg'/> $art_fec
		  <img width='20px' src='IMAGENES/CATEGORIA.jpg'/> $art_cat
		  <img width='20px' src='IMAGENES/VISITAS.jpg'/> $art_vis
		  <img width='20px' src='IMAGENES/ME_GUSTA.jpg'/> $art_gus
		  <td><form name='ir_al_articulo' action='' method='post'><input type='text' name='art_titulo' hidden value='$art_tit'><input type='submit' value='Me Gusta'></form></td></td></table></div>";

	//IMPRIMIENDO SUBTITULOS, FOTOS Y PARRAFOS
	$cta_parrafo=0;
	while($cta_parrafo<20){
		//IMPRIMIENDO SUBTITULO
		if($art_subt_i[$cta_parrafo]==true){
			echo "<h3>$art_subt_i[$cta_parrafo]</h3>";
		}else{}
		//IMPRIMIENDO FOTO
		if($art_foto_i[$cta_parrafo]==true){
			$e=rand(0,2);
			echo "<figure class='div-img1 hidden' style='$posicion[$e]'><img class='img1' src='IMAGENES/$art_foto_i[$cta_parrafo]'/></figure>";
		}else{}
		//IMPRIMIENDO EL PARRAFO.
		if($art_parr_i[$cta_parrafo]==true){
			//PARTIENDO EL PARRAFO EN PALABRAS INDIVIDUALES PARA AGREGARLE ENLACES EXTERNOS
			$porciones = explode(" ", $art_parr_i[$cta_parrafo]);
			$i=0;
			echo "<p> ";
			while(isset($porciones[$i])==true){
				if(strpos("-$porciones[$i]", "www") > 0){
					if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
					echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
				}else{
					if(strpos("-$porciones[$i]", ".info") > 0){
						if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
						echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
					}else{
						if(strpos("-$porciones[$i]", ".com") > 0){
							if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
							echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
						}else{
							if(strpos("-$porciones[$i]", ".net") > 0){
								if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
								echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
							}else{
								if(strpos("-$porciones[$i]", ".org") > 0){
									if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
									echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
								}else{
									if(strpos("-$porciones[$i]", ".ve") > 0){
										if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
										echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
									}else{
										if(strpos("-$porciones[$i]", ".gob") > 0){
											if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
											echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
										}else{
											if(strpos("-$porciones[$i]", ".gov") > 0){
												if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
												echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
											}else{
												if(strpos("-$porciones[$i]", ".tk") > 0){
													if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
													echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
												}else{
													if(strpos("-$porciones[$i]", ".html") > 0){
														if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
														echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
													}else{
														if(strpos("-$porciones[$i]", ".php") > 0){
															if(strpos("-$porciones[$i]", "http:") === false){$porciones[$i]="http://" . $porciones[$i];}else{}
															echo "<strong><a href='$porciones[$i]'>$porciones[$i]</a></strong> ";
														}else{
															$cta_tags=0;
															$verificar_enlace=0;
															while($cta_tags<$cantidad_de_palabras_clave){
																if($porciones[$i]==$tags[$cta_tags]){
																	echo "<strong><a href='busqueda_like.php?buscar_like=$tags[$cta_tags]'>$tags[$cta_tags]</a></strong> ";
																	$verificar_enlace=1;
																}else{}
																$cta_tags=$cta_tags+1;
															}
															if($verificar_enlace==0){
																echo "$porciones[$i] ";
															}else{}															
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				$i=$i+1;
			}
		}else{}
		echo "</p>";
		$cta_parrafo=$cta_parrafo+1;
	}
	echo "</article>";

	//SOBRE EL AUTOR
	echo "<h2 class='aside_titulo' style='text-align:center; font-style:italic; width:50%; margin-left:6%; margin-right:auto; margin-top:5px; margin-bottom:5px; border:#473663 6px ridge;'>Sobre el Autor:</h2>";
    $consulta="SELECT 
		`datos_usuarios`.AUTOR_CORREO AS AUTOR_CORREO,
		`datos_usuarios`.NOMBRE AS NOMBRE,
		`datos_usuarios`.APELLIDO AS APELLIDO,
		`datos_usuarios`.DESCRIPCION AS DESCRIPCION,
		`datos_usuarios`.FACEBOOK AS FACEBOOK,
		`datos_usuarios`.INSTAGRAM AS INSTAGRAM,
		`datos_usuarios`.TWITTER AS TWITTER,
		`datos_usuarios`.FOTO AS FOTO,
		`datos_usuarios`.NACIONALIDAD AS NACIONALIDAD
		FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO WHERE `datos_articulos`.ART_TITULO = '$titulo_articulo'
		GROUP BY AUTOR_CORREO";
    $resultado=mysqli_query($conexion,$consulta);
	$fila=mysqli_fetch_array($resultado);
    $nombre_autor=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
    $apellido_autor=ucwords(mb_strtolower($fila['APELLIDO'],'UTF-8'));
    $nacionalidad_autor=ucwords(mb_strtolower($fila['NACIONALIDAD'],'UTF-8'));
	$descripcion_autor=ucfirst(mb_strtolower($fila['DESCRIPCION'],'UTF-8'));
	$facebook_autor=$fila['FACEBOOK'];
	$instagram_autor=$fila['INSTAGRAM'];
	$twitter_autor=$fila['TWITTER'];
	$foto_autor=$fila['FOTO'];
	echo "<article style='width:50%; margin-left:6%; margin-right:auto; margin-top:5px; margin-bottom:5px; background-color:#fff;'>";
	echo "<div class='articulo_titulo' style='height:110px;'><figure class='div-img hidden' style='height:100px; width:150px; float:left; border-radius:45%; border:solid 1px; margin-top:4px; background-color:#fff;'><img class='img' src='IMAGENES/$foto_autor' width='150px' height='100px'/></figure>";
	echo "<h3 style='margin-top:0px; padding:3px; padding-left:162px; font-size:20px;'>$nombre_autor $apellido_autor</h3><br><h3 style='text-align:center;'>";
	if($facebook_autor==true){
	echo "<a href='$facebook_autor'><img width='30px' height='30px' src='IMAGENES/FACEBOOK.jpg'/></a>";}else{}
	if($twitter_autor==true){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='$twitter_autor'><img width='30px' height='30px' src='IMAGENES/TWITTER.jpg'/></a>";}else{}
	if($instagram_autor==true){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='$instagram_autor'><img width='30px' height='30px' src='IMAGENES/INSTAGRAM.jpg'/></a>";}else{}
	echo "</h3></div><h4>$descripcion_autor</h4></article>";
	//SOBRE LOS COMENTARIOS
	echo "<h2 class='aside_titulo' style='text-align:center; font-style:italic; width:50%; margin-left:6%; margin-right:auto; margin-top:5px; margin-bottom:5px; border:#473663 6px ridge;'>$numero_filas Comentarios (Pág. $pagina / $total_paginas)</h2>";
    //OBTENIENDO ARRAY DE COMENTARIOS DEL ARTICULO
	if($numero_filas==0){}else{//inicio del si de los comentario nulos//
    $consulta="SELECT `datos_comentarios`.NOMBRE AS NOMBRE, `datos_comentarios`.FECHA AS FECHA, `datos_comentarios`.COMENTARIO AS COMENTARIO FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO INNER JOIN `datos_comentarios` ON `datos_comentarios`.ART_TITULO=`datos_articulos`.ART_TITULO WHERE `datos_articulos`.ART_TITULO = '$titulo_articulo'
				ORDER BY `datos_comentarios`.FECHA ASC, `datos_comentarios`.NOMBRE ASC LIMIT $empesar_desde,$registros_filtrados";
    $resultado=mysqli_query($conexion,$consulta);
	echo "<article style='background-color:#eeeeee;'>";
    while(($fila=mysqli_fetch_array($resultado))==true){
        $com_nombre=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
        $porc_01=$fila['FECHA'];
		$porc_02=explode(" ", $porc_01);
		$com_fecha=$porc_02[0];
        $comentario=ucfirst(mb_strtolower($fila['COMENTARIO'],'UTF-8'));
		echo "<h4 style='font-size:14px; text-align:justify; background-color:#376092; color:#fff; margin:0px 0px 10px 0px; padding:3px; border:1px #000 solid; color:#EE5;'>&nbsp;&nbsp;<img width='20px' src='IMAGENES/AUTOR.jpg'/> &nbsp;&nbsp; $com_nombre &nbsp;&nbsp; <img width='20px' src='IMAGENES/FECHA.jpg'/> &nbsp;&nbsp; $com_fecha</h4>";
		echo "<p>$comentario</p>";
    }

?>
      <table style="width:100%; margin:auto; border-top:#473663 8px ridge; background-color:#376092; color:#fff;">
        <form name="autor_buscar" action="articulos.php" method="get">
        <tr>
        <td style="width:11%;"></td>
        <td>Para ver más comentarios <input type="text" name="art_titulo" style="width:200px;" value="<?php echo "$art_tit_comentarios"; ?>" hidden>selecione una Página:&nbsp;&nbsp;&nbsp;<select name="pag_form">
            <?php
            //IMPRIMIENDO PAGINADO
            $i=1;
            while($i<=$total_paginas){
                echo "<option>$i</option>";
                $i=$i+1;
            }
            ?>
            </select>
          </td>
          <td>&nbsp;<input type="submit" name="imprimir" value="y haga click aquí"></td>
          <td style="width:11%;"></td>
        </tr>
        </form>
      </table>
    </article>
	<?php } //cierre del si de los comentarios nulos// ?>
	<article>
    	<form action="insertar_comentario.php" method="post" name="agregar_comentario">
        	<table style="background-color:#376092; color:#fff;">
            	<tr>
                	<td colspan="2" style="color:#ee5;">AGREGAR COMENTARIO:</td>
                </tr>
                <tr>
                	<td style="width:5%;">Correo:</td>
                    <td style="width:95%;"><input type="email" name="correo_comentario" required style="width:98%;"></td>
                </tr>
                <tr>
                	<td>Nombre:</td>
                    <td><input type="text" name="nombre_comentario" required  style="width:98%;"></td>
                </tr>
                <tr>
                	<td>Comentario:</td>
                    <td><textarea name="contenido_comentario" id="contenido_comentario" required style="width:98%;">Por favor, ingrese aquí sus comentarios</textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="titulo_del_articulo" value="<?php echo "$art_tit_comentarios"; ?>" hidden><input type="text" name="fecha_del_comentario" value="<?php $fecha_ahora_y_m_d_h_i_s=date("Y-m-d H:i:s");  echo "$fecha_ahora_y_m_d_h_i_s"; ?>" hidden><input type="submit" name="enviar" id="enviar" value="Registrar"></td>
                </tr>
            </table>
        </form>
    </article>
<?php } ?>
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