<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//del form
$titulo_articulo=$_GET["titulo_articulo"];
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
<title>Fundación Crystal - Eliminar este Articulo previo</title>
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
<section class="aside_titulo" style="width:95%; margin:auto; border:#473663 8px ridge;">
	<h1>Usted Seleccionó eliminar el artículo titulado:</h1>
	<h2 style="color:#F00"><?php echo "$titulo_articulo"; ?></h2>
    <br>
    <table style="width:auto; border:#000 1px solid; margin:auto; font-size:40px;">
    <tr>
    	<td colspan="2" style="background-color:#CCC; border:#000 1px solid; font-size:26px;">Seguro que desea eliminarlo:
        </td>
    </tr>
    <tr>
    	<td style="width:50%;"><form action="rud_eliminar_articulo_seleccionado.php" name="eliminar" method="post"><input type="hidden" name="articulo" value="<?php echo "$titulo_articulo"; ?>"><input type="submit" name="verificar" value="SI" style="font-size:30px;"></form>
        </td>
        <td style="width:50%;"><form action="zona_adm.php" name="no" method="post"><input type="hidden" name="no" value="si"><input type="submit" name="verificar" value="NO" style="font-size:30px;"></form>
        </td>
    </tr>
    </table>
    <br>
</section>
</body>
</html>
<?php
mysqli_close($conexion);
?>