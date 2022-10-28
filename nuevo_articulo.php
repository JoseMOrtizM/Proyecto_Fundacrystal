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
<title>Fundación Crystal - Nuevo Articulo</title>
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

<form action="insertar_articulo.php" method="post" enctype="multipart/form-data">
<table style="border: solid #333 1px; width:97%; margin:auto; background-color:#dfdfdf;">
<tr style="border: solid #333 1px;">
	<td colspan="4" style="border: solid #333 1px; width:15%; text-align:justify; padding:5px; background-color:#FFF; color:#F00;">
    	Estimado <strong><?php echo "$autor_nombre $autor_apellido"; ?></strong> en el siguiente cuadro podrá registrar la información del artículo de su preferencia. es <strong>IMPORTANTE</strong> tener en cuenta que debe agregar al menos el título, la categoria, el primer párrafo y la primera imagen (máximo 150 caracteres para título y sub-títulos, mínimo 400 caracteres para párrafos y máximo 2 Mega Bytes por imagen). presione el botón "Subir Artículo" al final de la tabla para registrar los datos.  
    </td>
</tr>
<tr style="border: solid #333 1px;">
	<td colspan="1" style="border: solid #333 1px; width:15%;">Título del Artículo:<br>(max: 150 Caracteres)</td>
    <td colspan="2" style="border: solid #333 1px; width:65%;"><textarea name="titulo" rows="1" style="width:98%; background-color:#ffffee;" required></textarea></td>
    <td colspan="1" style="border: solid #333 1px; width:20%;">
    	<table style="margin:0px; padding:0px;">
    	<tr>
        	<td style="border: solid #333 1px; width:95%;">Defina una Categoría:</td>
        </tr>
        <tr>
        	<td style="border: solid #333 1px; width:95%;"><input type="text" name="categoria" required style="background-color:#ffffee;"></td>
        </tr>
        </table>
    </td>
</tr>
<?php

$i=1;
echo"
	<tr style='border: solid #333 1px;'>
		<td style='border: solid #333 1px; width:15%;'>Sub-Título $i:<br>(max: 150 Caracteres)</td>
		<td style='border: solid #333 1px; width:45%;'><textarea name='subtitulo_$i' rows='1' style='width:96%; background-color:#ffffee;'></textarea></td>
		<td colspan='2' style='border: solid #333 1px; width:40%;'>Imagen $i: (max: 2 mb)<br><input type='file' name='imagen_$i' required></td>
	</tr>
	<tr style='border: solid #333 1px;'>
		<td colspan='1' style='border: solid #333 1px; width:15%;'>Parrafo $i:<br>(mín: 400 Caracteres)</td>
		<td colspan='3' style='border: solid #333 1px; width:85%;'><textarea name='parrafo_$i' rows='7' style='width:98%; background-color:#ffffee;' required></textarea></td>
	</tr>
";
$i=$i+1;
while($i<=20){
	echo"
		<tr style='border: solid #333 1px;'>
			<td style='border: solid #333 1px; width:15%;'>Sub-Título $i:<br>(max: 150 Caracteres)</td>
			<td style='border: solid #333 1px; width:45%;'><textarea name='subtitulo_$i' rows='1' style='width:96%; background-color:#ffffee;'></textarea></td>
			<td colspan='2' style='border: solid #333 1px; width:40%;'>Imagen $i: (max: 2 mb)<br><input type='file' name='imagen_$i'></td>
		</tr>
		<tr style='border: solid #333 1px;'>
			<td colspan='1' style='border: solid #333 1px; width:15%;'>Parrafo $i:<br>(mín: 400 Caracteres)</td>
			<td colspan='3' style='border: solid #333 1px; width:85%;'><textarea name='parrafo_$i' rows='7' style='width:98%; background-color:#ffffee;'></textarea></td>
		</tr>
	";
	$i=$i+1;
}
?>

<tr>
	<td colspan="4"><input type="text" name="mes" value="<?php echo "$mes_actual"; ?>" hidden><input type="text" name="ano" value="<?php echo "$ano_actual"; ?>" hidden><input type="text" name="fecha" value="<?php echo "$fecha_y_m_d"; ?>" hidden><input type="submit" name="subir" value="Subir Artículo"></td>
</tr>
</table>
</form>
</section>
<br><br>
</body>
</html>
<?php
mysqli_close($conexion);
?>