<?php
session_start();
if(!isset($_SESSION["usuario_adm"]) and !isset($_SESSION["usuario_write"]) and !isset($_SESSION["usuario_desabilitado"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO EL USUARIO Y OBTENIENDO FOTO
if(isset($_SESSION["usuario_adm"])){$user=$_SESSION["usuario_adm"];}else{
if(isset($_SESSION["usuario_write"])){$user=$_SESSION["usuario_write"];}else{
if(isset($_SESSION["usuario_desabilitado"])){$user=$_SESSION["usuario_desabilitado"];}}}
$consulta="SELECT FOTO FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
//DEFINIENDO AO ACTUAL
$ano_actual=date("Y");
//EXTRAYENDO TOTAL DE VISITAS
$consulta="SELECT VISITAS FROM `datos_visitas` WHERE DESCRIPCION='TOTAL'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$total_visitas=$fila['VISITAS'];
//EXTRAYENDO VISITAS POR MES PARA EL AO ACTUAL
$consulta="SELECT DESCRIPCION, VISITAS FROM `datos_visitas` WHERE DESCRIPCION LIKE '%$ano_actual%'";
$resultado=mysqli_query($conexion,$consulta);
$cta_mes=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$mes_i=$fila['DESCRIPCION'];
	$porc_01=explode("-", $mes_i);
	$meses[$cta_mes]=$porc_01[1];
	$visitas[$cta_mes]=$fila['VISITAS'];
	$cta_mes=$cta_mes+1;
}
//EXTRAYENDO VISITAS POR AUTOR
$consulta="SELECT `datos_usuarios`.NOMBRE AS NOMBRE, `datos_usuarios`.APELLIDO AS APELLIDO, `datos_articulos`.VISITAS AS VISITAS FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO = `datos_usuarios`.AUTOR_CORREO GROUP BY NOMBRE, APELLIDO ORDER BY VISITAS";
$resultado=mysqli_query($conexion,$consulta);
$cta_autor_visitas=0;
$max_visitas=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$autor_nombre_visitas[$cta_autor_visitas]=$fila['NOMBRE'];
	$autor_apellido_visitas[$cta_autor_visitas]=$fila['APELLIDO'];
	$autor_visitas[$cta_autor_visitas]=$fila['VISITAS'];
	if($max_visitas<$autor_visitas[$cta_autor_visitas]){
		$max_visitas=$autor_visitas[$cta_autor_visitas];
	}else{}
	$cta_autor_visitas=$cta_autor_visitas+1;
}
//EXTRAYENDO LIKES POR AUTOR
$consulta="SELECT `datos_usuarios`.NOMBRE AS NOMBRE, `datos_usuarios`.APELLIDO AS APELLIDO, `datos_articulos`.ME_GUSTA AS ME_GUSTA FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO = `datos_usuarios`.AUTOR_CORREO GROUP BY NOMBRE, APELLIDO ORDER BY ME_GUSTA";
$resultado=mysqli_query($conexion,$consulta);
$cta_autor_likes=0;
$max_likes=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$autor_nombre_likes[$cta_autor_likes]=$fila['NOMBRE'];
	$autor_apellido_likes[$cta_autor_likes]=$fila['APELLIDO'];
	$autor_likes[$cta_autor_likes]=$fila['ME_GUSTA'];
	if($max_likes<$autor_likes[$cta_autor_likes]){
		$max_likes=$autor_likes[$cta_autor_likes];
	}else{}
	$cta_autor_likes=$cta_autor_likes+1;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundacin Crystal - Zona Administracin</title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
<?php
//header
require ("efecto_entrada.php");
?>
<script type="text/javascript" src="jquery.min.js"></script>
<script src="jquery.canvasjs.min.js"></script>
</head>
<body>
<?php
//header
require ("header_zona_adm_1.php");
?>
<aside style="margin-top:0px; margin-bottom:5px; border-radius:0px;">
	<table style="width:100%;">
    <td style="height:300px; width:50%;">
    <div id="visitas_por_autor" style="height:300px; width:98%; margin:auto; border:#473663 6px ridge; "></div>
    </td>
    <td style="height:300px; width:50%;">
	<div id="likes_por_autor" style="height:300px; width:98%; margin:auto; border:#473663 6px ridge; "></div>
	</td>
    </table>
</aside>
<section>
	<article style="height:300px; background-color:#FFF;">
	<h2>Bienvenido: <?php if(isset($_SESSION["usuario_adm"])){echo $_SESSION["usuario_adm"];}else{if(isset($_SESSION["usuario_write"])){echo $_SESSION["usuario_write"];}else{if(isset($_SESSION["usuario_desabilitado"])){echo $_SESSION["usuario_desabilitado"];}}} ?></h2>
<?php 
	if(isset($_SESSION["usuario_adm"])){
		//ACCESO A TODO
		echo "<h3><a href='nuevo_articulo.php'>1.- Publicar Nuevo Artculo</a></h3>";
		echo "<h3><a href='modificar_articulos.php'>2.- Modificar Mis Artculos Publicados</a></h3>";
		echo "<h3><a href='ver_comentarios.php'>3.- Revisar Mis Comentarios</a> / ";
		echo "<a href='ver_comentarios_no_leidos.php'>Revisar NO LEIDOS</a></h3>";
		echo "<h3><a href='modificar_mi_usuario.php'>4.- Modificar Mis Datos de Usuario</a></h3>";
		echo "<h3><a href='rud_articulos.php'>5.- Modificar/Eliminar Datos de Artculos</a></h3>";
		echo "<h3><a href='rud_comentarios.php'>6.- Modificar/Eliminar Datos de Comentarios</a> / ";
		echo "<a href='rud_comentarios_nl.php'>Ver NO LEIDOS</a></h3>";
		echo "<h3><a href='rud_usuarios.php'>7.- Modificar/Eliminar Datos de Usuarios</a></h3>";
		echo "<h3><a href='crud_servicios_eventos.php'>8.- Modificar/Eliminar Datos de las Secciones: Servicios, Formación, Eventos y Conócenos</a></h3>";
	}else{if(isset($_SESSION["usuario_write"])){
		//ACCESO USUARIO ESCRITOR
		echo "<h3><a href='nuevo_articulo.php'>1.- Publicar Nuevo Artculo</a></h3>";
		echo "<h3><a href='modificar_articulos.php'>2.- Modificar Mis Artculos Publicados</a></h3>";
		echo "<h3><a href='ver_comentarios.php'>3.- Revisar Mis Comentarios</a> / ";
		echo "<a href='ver_comentarios_no_leidos.php'>Revisar NO LEIDOS</a></h3>";
		echo "<h3><a href='modificar_mi_usuario.php'>4.- Modificar Mis Datos de Usuario</a></h3>";
	}else{if(isset($_SESSION["usuario_desabilitado"])){
		//SUSCRIPTOR BANEADO
		echo "<h1>LO SENTIMOS:</h1><h2>ESTA CUENTA HA SIDO DESABILITADA POR LOS ADMINISTRADORES DE ESTE SITIO WEB, POR VIOLAR NUESTRAS POLTICAS DE USO DEL SITIO.</h2>";
	}}}
?>
</article>
</section>
<footer style='width:96%; margin:auto; margin-top:0px;'>
	<table>
    <td style="height:125px; width:64%;">
    <div id="visitas_por_mes" style="height:125px; width:100%; margin:auto;"></div>
    </td>
    <td style="height:125px; width:36%;">
	<h2 style="text-align:center;">Total de Visitas:</h2>
    <h1 style="text-align:center; color:#ae433c;"><?php echo "$total_visitas"; ?></h1>
	</td>
    </table>
</footer>
<br><br>
</body>
</html>
<script type="text/javascript">

	$(function () {
		var options = {
			title: {
				text: "Visitas por Autor:"
			},
			theme: "theme1",
			exportEnabled: false,
			animationEnabled: true,
			axisX: {
				interval: 1
			},
			axisY: {
				minimum: 0,
      			maximum: <?php echo "$max_visitas";?>
			},

			legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			itemclick: function (e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
				e.chart.render();
				}
			},

			data: [{
				showInLegend: false,
				type: "bar",
				name: "Visitas",
				color: "Green",
				dataPoints: [
<?php
				$e=0;
				while($e<$cta_autor_visitas){
					$o=$e+1;
					echo "{ x: $o, y: $autor_visitas[$e], label: '$autor_nombre_visitas[$e] $autor_apellido_visitas[$e]'}";
					if($o<$cta_autor_visitas){echo ",";}else{}
					$e=$e+1;
				}
?>
				]
			}]
		};
		$("#visitas_por_autor").CanvasJSChart(options);
	});

	$(function () {
		var options = {
			title: {
				text: "Likes por Autor:"
			},
			theme: "theme1",
			exportEnabled: false,
			animationEnabled: true,
			axisX: {
				interval: 1
			},
			axisY: {
				minimum: 0,
      			maximum: <?php echo "$max_likes";?>
			},
			legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			itemclick: function (e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
				e.chart.render();
				}
			},

			data: [{
				showInLegend: false,
				type: "bar",
				name: "Me_Gusta",
				color: "Blue",
				dataPoints: [
<?php
				$e=0;
				while($e<$cta_autor_likes){
					$o=$e+1;
					echo "{ x: $o, y: $autor_likes[$e], label: '$autor_nombre_likes[$e] $autor_apellido_likes[$e]'}";
					if($o<$cta_autor_likes){echo ",";}else{}
					$e=$e+1;
				}
?>
				]
			}]
		};
		$("#likes_por_autor").CanvasJSChart(options);
	});

	$(function () {
		var options = {
			title: {
				text: "Visitas para el ao: <?php echo "$ano_actual"; ?>"
			},
			theme: "theme1",
			exportEnabled: false,
			animationEnabled: true,
			axisX: {
				interval: 1
			},

			legend: {
			cursor: "pointer",
			verticalAlign: "top",
			horizontalAlign: "center",
			itemclick: function (e) {
			if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
				e.chart.render();
				}
			},

			data: [{
				showInLegend: false,
				type: "stackedColumn",
				name: "Visitas",
				color: "red",
				indexLabel: "{y}",
				dataPoints: [
				  { x: 1, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==1){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Ene"},
				  { x: 2, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==2){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Feb"},
				  { x: 3, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==3){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Mar"},
				  { x: 4, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==4){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Abr"},
				  { x: 5, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==5){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-May"},
				  { x: 6, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==6){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Jun"},
				  { x: 7, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==7){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Jul"},
				  { x: 8, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==8){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Ago"},
				  { x: 9, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==9){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Sep"},
				  { x: 10, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==10){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Oct"},
				  { x: 11, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==11){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Nov"},
				  { x: 12, y: <?php $e=0;$verf="error";while($e<=11){if(isset($meses[$e])){if($meses[$e]==12){echo "$visitas[$e]";$verf="ok";}}$e=$e+1;}if($verf=="error"){echo "null";} ?>, label:"Visitas-Dic"}
				]
			}, {
				showInLegend: true,
				type: "stackedColumn",
				name: "",
				color: "#FFF",
				dataPoints: [
				  { x: 1, y: 0, label:"Ene"},
				  { x: 2, y: 0, label:"Feb"},
				  { x: 3, y: 0, label:"Mar"},
				  { x: 4, y: 0, label:"Abr"},
				  { x: 5, y: 0, label:"May"},
				  { x: 6, y: 0, label:"Jun"},
				  { x: 7, y: 0, label:"Jul"},
				  { x: 8, y: 0, label:"Ago"},
				  { x: 9, y: 0, label:"Sep"},
				  { x: 10, y: 0, label:"Oct"},
				  { x: 11, y: 0, label:"Nov"},
				  { x: 12, y: 0, label:"Dic"}
				]
			}]
		};
		$("#visitas_por_mes").CanvasJSChart(options);
	});

</script>
<?php
mysqli_close($conexion);
?>