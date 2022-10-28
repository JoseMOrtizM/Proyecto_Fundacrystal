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

//INICIO DEL PAGINADO
$registros_filtrados=12;
if(isset($_GET["pagina"])){
	if($_GET["pagina"]==1){
		header("location:rud_usuarios.php");
	}else{
		$pagina=$_GET["pagina"];
	}
}else{
	$pagina=1;
}
$empesar_desde=($pagina-1)*$registros_filtrados;
$sql_total="SELECT ID FROM `datos_usuarios`";
$resultado=mysqli_query($conexion,$sql_total);
$numero_filas=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$numero_filas=$numero_filas+1;
}
$total_paginas=ceil($numero_filas/$registros_filtrados);

//DATOS A IMPRIMIR EN EL FORMULARIO
$consulta="SELECT ID, AUTOR_CORREO, NOMBRE, APELLIDO, PREGUNTA, RESPUESTA, CONTRASENA, NIVEL_ACCESO FROM `datos_usuarios` ORDER BY AUTOR_CORREO LIMIT $empesar_desde,$registros_filtrados";
$resultado=mysqli_query($conexion,$consulta);
$i=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$id[$i]=$fila['ID'];
	$correo[$i]=$fila['AUTOR_CORREO'];
	$nombre[$i]=$fila['NOMBRE'];
	$apellido[$i]=$fila['APELLIDO'];
	$pregunta[$i]=$fila['PREGUNTA'];
	$respuesta[$i]=$fila['RESPUESTA'];
	$contrasena[$i]=$fila['CONTRASENA'];
	$nivel_acceso[$i]=$fila['NIVEL_ACCESO'];
	$i=$i+1;
}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - RUT USUARIOS</title>
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
<section style="width:97%; margin:auto; color:#000; background-color:#ddd; border:#473663 8px ridge;">
    <table>
        <tr>
            <th colspan='9' style='border:#000 1px solid; color:#FFF; background-color:#376092;'>
                DATOS DE SEGURIDAD DE USUARIOS REGISTRADOS:
            </th>
        </tr>
        <tr>
            <td rowspan='2' style='border:#000 1px solid;'>Correo Electrónico</td>
            <td rowspan='2' style='border:#000 1px solid;'>Nombre</td>
            <td rowspan='2' style='border:#000 1px solid;'>Apellido</td>
            <td colspan='4' style='border:#000 1px solid;'>Datos de Seguridad</td>
            <td colspan='2' style='border:#000 1px solid;'>ACCIONES</td>
        </tr>
        <tr>
            <td style='border:#000 1px solid;'>Pregunta</td>
            <td style='border:#000 1px solid;'>Respuesta</td>
            <td style='border:#000 1px solid;'>Contraseña</td>
            <td style='border:#000 1px solid;'>Acceso</td>
            <td style='border:#000 1px solid;'>Actualizar</td>
            <td style='border:#000 1px solid;'>Borrar</td>
        </tr>
            <?php
            $e=0;
            while($e<$i){
                echo "<tr><form action='update_rud_usuarios.php' method='post'>";
                echo "<input type='hidden' name='id' value='$id[$e]'>";
				echo "<td style='border:#000 1px solid; width:23%;'><input type='email' name='correo' value='$correo[$e]' style='width:96%'></td>";
                echo "<td style='border:#000 1px solid; width:8%;'><input type='text' name='nombre' value='$nombre[$e]' style='width:90%'></td>";
                echo "<td style='border:#000 1px solid; width:8%;'><input type='text' name='apellido' value='$apellido[$e]' style='width:90%'></td>";
                echo "<td style='border:#000 1px solid;'>
				<select name='pregunta' style='width:99%'>
				<option>$pregunta[$e]</option>
				<option>Cual es el Nombre de tu mascota</option>
				<option>Cual es el segundo nombre de tu Padre</option>
				<option>Cual es el segundo nombre de tu Madre</option>
				<option>Cual es tu libro favorito</option>
				<option>Cual es la marca de tu primer carro</option>
				<option>Donde fue tu luna de miel</option>
				<option>Ocupación de tu abuela</option>
				<option>Ocupación de tu abuelo</option>
				<option>Cual es tu hotel favorito</option>
				<option>Donde fueron tus primeras vacaciones</option>
				<option>Cual es tu actor favorito</option>
				<option>Cual es tu actris favorita</option>
				<option>Cual es tu canción favorita</option>
				<option>Cual es tu película favorita</option>
				<option>Cual es tu deporte favorito</option>
				<option>Cual fue la marca de tu primer celular</option>
				<option>Cual es la marca de tu carro favorito</option>
				<option>Cual es el nombre de tu padrino de bodas</option>
				<option>Cual es el nombre de tu madrina de bodas</option>
				<option>Cual es el nombre de tu mejor amigo</option>
				</select>
				</td>";
                echo "<td style='border:#000 1px solid; width:10%;'><input type='text' name='respuesta' value='$respuesta[$e]' style='width:90%'></td>";
                echo "<td style='border:#000 1px solid; width:12%;'><input type='text' name='contrasena' value='$contrasena[$e]' style='width:90%'></td>";
                echo "<td style='border:#000 1px solid; width:13%;'><select name='nivel_acceso' style='width:99%'><option>$nivel_acceso[$e]</option><option>ESCRITOR</option><option>ADMINISTRADOR</option><option>DESABILITADO</option></select></td>";
                echo "<td style='border:#000 1px solid;'><input type='submit' name='actualizar' value='Actualizar'></td></form>";
                echo "<td style='border:#000 1px solid;'><a href='delete_rud_usuarios.php?Id=$id[$e]'><input type='submit' name='borrar' value='Borrar'></a></td>";
                echo "</tr>";
                $e=$e+1;
            }
            ?>
    	<!--PAGINACIÓN-->
        <tr>
        <td colspan='9'>
        <?php
        echo "Páginas disponibles:  ";
        for($i=1; $i<=$total_paginas; $i++){
            echo "<a href='?pagina=" . $i . "'>" . $i . "</a> ";
        }
        echo "<br>(Se Muestran: $registros_filtrados Usuarios por Página / de un total de $numero_filas Usuarios registrados).";
        ?>
        </td>
    
    </table>
</section>

</body>
</html>

<?php
mysqli_close($conexion);
?>