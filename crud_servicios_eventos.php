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
//DEFINIENDO EL FILTRO DEL FORMULARIO
if(isset($_GET['tipo_de_servicio'])==true){
	$tipo_de_servicio=$_GET['tipo_de_servicio'];
}else{
	$tipo_de_servicio='Eventos';
}
//DATOS A IMPRIMIR EN EL FORMULARIO
$consulta="SELECT * FROM `datos_servicios` 
	WHERE ACT = '$tipo_de_servicio'
	ORDER BY ACT, SUB_ACT DESC, FECHA ASC";
$resultado=mysqli_query($conexion,$consulta);
$i=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$id[$i]=$fila['ID'];
	$act[$i]=$fila['ACT'];
	$sub_act[$i]=$fila['SUB_ACT'];
	$titulo[$i]=$fila['TITULO'];
	$descripcion[$i]=$fila['DESCRIPCION'];
	$foto_servicio[$i]=$fila['FOTO'];
	$fecha[$i]=$fila['FECHA'];
	$i=$i+1;
}
?>
<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - CRUT Servicios Eventos</title>
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
<section style="width:98%; margin:auto; background-color:transparent;; border:#4fa7d7 8px ridge;">
    <table style="width:100%;">
            <?php
			$eventos='Eventos';
			$form='Formación';
			$nues_serv='Nuestros Servicios';
			$conocenos='Conócenos';
            $e=0;
			while(isset($act[$e])){
				$i=$e+1;
				if($e==0){
					echo "<tr><td colspan='4' style='background-color:#ddd; height:35px; border:1px solid #000;'>Consultar Secciones: &nbsp;&nbsp;
					<a class='ingreso' href='crud_servicios_eventos.php?tipo_de_servicio=$eventos'>Eventos</a>, &nbsp;&nbsp;
					<a class='ingreso' href='crud_servicios_eventos.php?tipo_de_servicio=$form'>Formación</a>, &nbsp;&nbsp;
					<a class='ingreso'  href='crud_servicios_eventos.php?tipo_de_servicio=$nues_serv'>Nuestros Servicios</a>&nbsp;&nbsp; &nbsp;
					<a class='ingreso'  href='crud_servicios_eventos.php?tipo_de_servicio=$conocenos'>Conócenos</a></td></tr>
		            <tr>
		            <td colspan='4' style='border:#000 1px solid; font-size:30px; background-color:#376092; color:#EE5;'>Este es el Listado de $tipo_de_servicio</td>
			        </tr>";
				}else{
					if($act[$e]==$act[$e-1]){
					echo "<tr><td colspan='4' style='background-color:#666; height:5px; border:1px solid #000;'> </td></tr>";
					}else{
					echo "<tr><td colspan='4' style='background-color:transparent; height:30px;'> </td></tr>";
					echo "<tr><td colspan='4' style='border:#000 1px solid; font-size:30px; background-color:#376092; color:#FFFFFF;'>$act[$e]</td></tr>";
					}
				}
				echo "<tr>
				<form action='crud_servicios_eventos_update.php' method='post' enctype='multipart/form-data'><input type='hidden' name='id' value='$id[$e]'><input type='hidden' name='act' value='$act[$e]'>
				<td style='border:#000 1px solid; background-color:#ddd; width:14%;'>Tipo de Evento:<br>";
				if($tipo_de_servicio=="Eventos"){
					if($sub_act[$e]=='Realizados'){
						echo "<select name='sub_act' required style='width:90%; background-color:#ffffee;'><option>$sub_act[$e]</option><option>Próximos</option></select>";
					}else{
						echo "<select name='sub_act' required style='width:90%; background-color:#ffffee;'><option>$sub_act[$e]</option><option>Realizados</option></select>";
					}
				}else{
					echo "<input type='text' name='sub_act' required value='$sub_act[$e]' style='width:90%; background-color:#ffffee;'>";
				}	
				echo "</td>
				<td style='border:#000 1px solid; background-color:#ddd; width:11%;'>Fecha: (Y-m-d)<br><input type='date' name='fecha' required value='$fecha[$e]' style='width:90%; background-color:#ffffee;'></td>
				<td style='border:#000 1px solid; background-color:#ddd; width:65%;'>
				  <table style='width:100%;'>
					<td><input type='hidden' name='foto_servicio_nombre' value='$foto_servicio[$e]'><img src='IMAGENES/$foto_servicio[$e]' width='50px' height='30px'/></td>
					<td><div style='width:310px; overflow:hidden;'>Modificar Imagen<input type='file' name='nombre_nueva_imagen'></div></td>
				  </table>
				</td>
				<td rowspan='2' style='border:#000 1px solid; background-color:#ddd; width:10%;'><input type='submit' name='actualizar' value='Actualizar'><br>ó<br><a href='crud_servicios_eventos_delete.php?Id=$id[$e]'><input type='button' name='borrar' value='&nbsp; Borrar &nbsp;'></a></td>
				</tr>
				<tr>
				<td colspan='2' style='border:#000 1px solid; background-color:#ddd;'>Título:<br><textarea name='titulo' rows='7' style='width:94%; background-color:#ffffee;' required>$titulo[$e]</textarea></td>
				<td style='border:#000 1px solid; background-color:#ddd;'>Descripción:<br><textarea name='descripcion' rows='7' style='width:98%; background-color:#ffffee;' required>$descripcion[$e]</textarea></td>
				</td></form>
				</tr>";
				$e=$e+1;
        	}
			echo "<tr><td colspan='4' style='background-color:#666; height:5px; border:1px solid #000;'> </td></tr>
			<tr>
			<td colspan='4' style='background-color:#376092; color:#EE5; border:1px solid #000; font-size:30px;'>Insertar Nuevo $tipo_de_servicio</td>
			</tr>
			<tr>
			<form action='crud_servicios_eventos_insert.php' method='post' enctype='multipart/form-data'><input type='hidden' name='act' value='$tipo_de_servicio'>
			<td style='border:#000 1px solid; background-color:#ddd; width:14%;'>Tipo de Evento:<br>";
				if($tipo_de_servicio=="Eventos"){
					echo "<select name='sub_act' required style='width:90%; background-color:#ffffee;'><option></option><option>Próximos</option><option>Realizados</option></select>";
				}else{
					echo "<input type='text' name='sub_act' required value='' style='width:90%; background-color:#ffffee;'>";
				}	
			echo "<td style='border:#000 1px solid; background-color:#ddd; width:11%;'>Fecha: (Y-m-d)<br><input type='date' name='fecha' required style='width:90%; background-color:#ffffee;'></td>
			<td style='border:#000 1px solid; background-color:#ddd; width:65%;'>
			  <table style='width:100%;'>
				<td><div style='width:310px; overflow:hidden;'>Adjuntar Imagen<input type='file' name='nombre_nueva_imagen' required></div></td>
			  </table>
			</td>
			<td rowspan='2' style='border:#000 1px solid; background-color:#ddd; width:10%;'><input type='submit' name='insertar' value='Publicar'></td>
			</tr>
			<tr>
			<td colspan='2' style='border:#000 1px solid; background-color:#ddd;'>Título:<br><textarea name='titulo' rows='7' style='width:94%; background-color:#ffffee;' required></textarea></td>
			<td style='border:#000 1px solid; background-color:#ddd;'>Descripción:<br><textarea name='descripcion' rows='7' style='width:98%; background-color:#ffffee;' required></textarea></td>
			</td></form>
			</tr>";
			?>
    </table>
</section>
<br><br>
</body>
</html>
<?php
mysqli_close($conexion);
?>