<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO EL USUARIO Y OBTENIENDO FOTO
$user=$_SESSION["usuario_adm"];
$consulta="SELECT FOTO FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
//DEFINIENDO AÑO ACTUAL
$ano_actual=date("Y");
//rescatando del form
$id=$_POST["id"];
$pagina=$_POST["pagina"];
$consulta="SELECT COMENTARIO, NOMBRE, ART_TITULO FROM `datos_comentarios` WHERE ID=$id";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$comentario=$fila['COMENTARIO'];
$nombre_comentarista=$fila['NOMBRE'];
$articulo=$fila['ART_TITULO'];

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - RUT Responder Comentarios_nl</title>
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
<br><br>
<section style="width:80%; margin:auto; background-color:#ddd; border:#4fa7d7 8px ridge;">
<form action="rud_insertar_respuesta_nl.php" method="post" name="insertar_comentario">
    <table>
        <tr>
            <td style='border:#000 1px solid; width:20%;'>Comentarista</td>
            <td style='border:#000 1px solid; width:80%;'>Comentaro</td>
        </tr>
        <tr>
            <td style='border:#000 1px solid; background-color:#FFF;'><?php echo "$nombre_comentarista"; ?></td>
            <td style='border:#000 1px solid; background-color:#FFF; text-align:justify;'><?php echo "$comentario"; ?></td>
        </tr>
        <tr>
            <td style='border:#000 1px solid;'>Responder Aquí:</td>
            <td style='border:#000 1px solid;'><textarea name="respuesta" rows="4" style="width:99%;" autofocus></textarea></td>
        </tr>
        <tr>
            <td colspan="2" style='border:#000 1px solid;'><input type="hidden" name="pagina" value="<?php echo "$pagina"; ?>"><input type="hidden" name="articulo_titulo" value="<?php echo "$articulo"; ?>"><input type="submit" name="enviar" value="Responder"></td>
        </tr>
	</table>
</form>
</section>
</body>
</html>
<?php
mysqli_close($conexion);
?>