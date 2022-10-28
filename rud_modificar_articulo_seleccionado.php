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
//RESCATANDO VALORES DEL FORMULARIO
if($_GET['titulo_articulo']==true){$titulo_articulo=$_GET['titulo_articulo'];}else{header("location:Salir.php");}

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
	$art_nom=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
	$art_ape=ucwords(mb_strtolower($fila['APELLIDO'],'UTF-8'));
	$art_cat=ucfirst(mb_strtolower($fila['CATEGORIA'],'UTF-8'));
	$art_tit=$fila['ART_TITULO'];
	$art_vis=$fila['VISITAS'];
	$art_gus=$fila['ME_GUSTA'];
	$art_subt[0]=ucfirst(mb_strtolower($fila['SUB_TITULO_1'],'UTF-8'));
	$art_parr[0]=$fila['PARRAFO_1'];
	$art_foto[0]=$fila['FOTO_1'];
	$art_subt[1]=ucfirst(mb_strtolower($fila['SUB_TITULO_2'],'UTF-8'));
	$art_parr[1]=$fila['PARRAFO_2'];
	$art_foto[1]=$fila['FOTO_2'];
	$art_subt[2]=ucfirst(mb_strtolower($fila['SUB_TITULO_3'],'UTF-8'));
	$art_parr[2]=$fila['PARRAFO_3'];
	$art_foto[2]=$fila['FOTO_3'];
	$art_subt[3]=ucfirst(mb_strtolower($fila['SUB_TITULO_4'],'UTF-8'));
	$art_parr[3]=$fila['PARRAFO_4'];
	$art_foto[3]=$fila['FOTO_4'];
	$art_subt[4]=ucfirst(mb_strtolower($fila['SUB_TITULO_5'],'UTF-8'));
	$art_parr[4]=$fila['PARRAFO_5'];
	$art_foto[4]=$fila['FOTO_5'];
	$art_subt[5]=ucfirst(mb_strtolower($fila['SUB_TITULO_6'],'UTF-8'));
	$art_parr[5]=$fila['PARRAFO_6'];
	$art_foto[5]=$fila['FOTO_6'];
	$art_subt[6]=ucfirst(mb_strtolower($fila['SUB_TITULO_7'],'UTF-8'));
	$art_parr[6]=$fila['PARRAFO_7'];
	$art_foto[6]=$fila['FOTO_7'];
	$art_subt[7]=ucfirst(mb_strtolower($fila['SUB_TITULO_8'],'UTF-8'));
	$art_parr[7]=$fila['PARRAFO_8'];
	$art_foto[7]=$fila['FOTO_8'];
	$art_subt[8]=ucfirst(mb_strtolower($fila['SUB_TITULO_9'],'UTF-8'));
	$art_parr[8]=$fila['PARRAFO_9'];
	$art_foto[8]=$fila['FOTO_9'];
	$art_subt[9]=ucfirst(mb_strtolower($fila['SUB_TITULO_10'],'UTF-8'));
	$art_parr[9]=$fila['PARRAFO_10'];
	$art_foto[9]=$fila['FOTO_10'];
	$art_subt[10]=ucfirst(mb_strtolower($fila['SUB_TITULO_11'],'UTF-8'));
	$art_parr[10]=$fila['PARRAFO_11'];
	$art_foto[10]=$fila['FOTO_11'];
	$art_subt[11]=ucfirst(mb_strtolower($fila['SUB_TITULO_12'],'UTF-8'));
	$art_parr[11]=$fila['PARRAFO_12'];
	$art_foto[11]=$fila['FOTO_12'];
	$art_subt[12]=ucfirst(mb_strtolower($fila['SUB_TITULO_13'],'UTF-8'));
	$art_parr[12]=$fila['PARRAFO_13'];
	$art_foto[12]=$fila['FOTO_13'];
	$art_subt[13]=ucfirst(mb_strtolower($fila['SUB_TITULO_14'],'UTF-8'));
	$art_parr[13]=$fila['PARRAFO_14'];
	$art_foto[13]=$fila['FOTO_14'];
	$art_subt[14]=ucfirst(mb_strtolower($fila['SUB_TITULO_15'],'UTF-8'));
	$art_parr[14]=$fila['PARRAFO_15'];
	$art_foto[14]=$fila['FOTO_15'];
	$art_subt[15]=ucfirst(mb_strtolower($fila['SUB_TITULO_16'],'UTF-8'));
	$art_parr[15]=$fila['PARRAFO_16'];
	$art_foto[15]=$fila['FOTO_16'];
	$art_subt[16]=ucfirst(mb_strtolower($fila['SUB_TITULO_17'],'UTF-8'));
	$art_parr[16]=$fila['PARRAFO_17'];
	$art_foto[16]=$fila['FOTO_17'];
	$art_subt[17]=ucfirst(mb_strtolower($fila['SUB_TITULO_18'],'UTF-8'));
	$art_parr[17]=$fila['PARRAFO_18'];
	$art_foto[17]=$fila['FOTO_18'];
	$art_subt[18]=ucfirst(mb_strtolower($fila['SUB_TITULO_19'],'UTF-8'));
	$art_parr[18]=$fila['PARRAFO_19'];
	$art_foto[18]=$fila['FOTO_19'];
	$art_subt[19]=ucfirst(mb_strtolower($fila['SUB_TITULO_20'],'UTF-8'));
	$art_parr[19]=$fila['PARRAFO_20'];
	$art_foto[19]=$fila['FOTO_20'];
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - RUD/Modificar Articulo Seleccionado</title>
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
<form action="rud_update_articulo.php" method="post" enctype="multipart/form-data">
<table style="border: solid #333 1px; width:97%; margin:auto; background-color:#dfdfdf;">
<tr style="border: solid #333 1px;">
	<td colspan="4" style="border: solid #333 1px; width:15%; text-align:justify; padding:5px; background-color:#FFF; color:#F00;">
    	Estimado <strong><?php echo "$autor_nombre $autor_apellido"; ?></strong> en el siguiente cuadro podrá modificar la información del artículo que seleccionó. es <strong>IMPORTANTE</strong> tener en cuenta que debe existir al menos el título, la categoria, el primer párrafo y la primera imagen (máximo 150 caracteres para título y sub-títulos, mínimo 400 caracteres para párrafos y máximo 2 Mega Bytes por imagen). Presione el botón "Modificar Artículo" al final de la tabla para modificar los datos.  
    </td>
</tr>
<tr style="border: solid #333 1px;">
	<td colspan="1" style="border: solid #333 1px; width:15%;">Título del Artículo:<br>(max: 150 Caracteres)</td>
    <td colspan="2" style="border: solid #333 1px; width:65%;"><textarea name="titulo" rows="1" style="width:98%; background-color:#ffffee;" required><?php echo "$art_tit"; ?></textarea></td>
    <td colspan="1" style="border: solid #333 1px; width:20%;">
    	<table style="margin:0px; padding:0px;">
    	<tr>
        	<td style="border: solid #333 1px; width:95%;">Defina una Categoría:</td>
        </tr>
        <tr>
        	<td style="border: solid #333 1px; width:95%;"><input type="text" name="categoria" required value="<?php echo "$art_cat"; ?>" style="background-color:#ffffee;"></td>
        </tr>
        </table>
    </td>
</tr>
<?php

$e=0;
$i=1;
echo"
	<tr style='border: solid #333 1px;'>
		<td style='border: solid #333 1px; width:15%;'>Sub-Título $i:<br>(max: 150 Caracteres)</td>
		<td style='border: solid #333 1px; width:45%;'><textarea name='subtitulo_$i' rows='1' style='width:96%; background-color:#ffffee;'>$art_subt[$e]</textarea></td>
		<td colspan='2' style='border: solid #333 1px; width:40%;'>
		  <table>
			<td><input type='hidden' name='nombre_imagen_$i' value='$art_foto[$e]' ><img src='IMAGENES/$art_foto[$e]' width='80px' height='50px'/></td>
			<td><div style='width:310px; overflow:hidden;'>Modificar Imagen $i<input type='file' name='imagen_$i'></div></td>
		  </table>
		</td>
	</tr>
	<tr style='border: solid #333 1px;'>
		<td colspan='1' style='border: solid #333 1px; width:15%;'>Parrafo $i:<br>(mín: 400 Caracteres)</td>
		<td colspan='3' style='border: solid #333 1px; width:85%;'><textarea name='parrafo_$i' rows='7' style='width:98%; background-color:#ffffee;' required>$art_parr[$e]</textarea></td>
	</tr>
";
$e=$e+1;
$i=$i+1;
while($i<=20){
	echo"
		<tr style='border: solid #333 1px;'>
			<td style='border: solid #333 1px; width:15%;'>Sub-Título $i:<br>(max: 150 Caracteres)</td>
			<td style='border: solid #333 1px; width:45%;'><textarea name='subtitulo_$i' rows='1' style='width:96%; background-color:#ffffee;'>$art_subt[$e]</textarea></td>
		<td colspan='2' style='border: solid #333 1px; width:40%;'>
		  <table>
			<td><input type='hidden' name='nombre_imagen_$i' value='$art_foto[$e]' ><img src='IMAGENES/$art_foto[$e]' width='80px' height='50px'/></td>
			<td><div style='width:310px; overflow:hidden;'>Modificar Imagen $i<input type='file' name='imagen_$i'></div></td>
		  </table>
		</td>
		</tr>
		<tr style='border: solid #333 1px;'>
			<td colspan='1' style='border: solid #333 1px; width:15%;'>Parrafo $i:<br>(mín: 400 Caracteres)</td>
			<td colspan='3' style='border: solid #333 1px; width:85%;'><textarea name='parrafo_$i' rows='7' style='width:98%; background-color:#ffffee;'>$art_parr[$e]</textarea></td>
		</tr>
	";
	$e=$e+1;
	$i=$i+1;
}
?>

<tr>
	<td colspan="4"><input type="submit" name="subir" value="Modificar Artículo"></td>
</tr>
</table>
</form>

</section>
</body>
</html>
<?php
mysqli_close($conexion);
?>