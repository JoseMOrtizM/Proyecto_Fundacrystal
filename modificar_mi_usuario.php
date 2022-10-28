<?php
session_start();
if(!isset($_SESSION["usuario_adm"]) and !isset($_SESSION["usuario_write"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO EL USUARIO Y OBTENIENDO FOTO
if(isset($_SESSION["usuario_adm"])){$user=$_SESSION["usuario_adm"];}else{
if(isset($_SESSION["usuario_write"])){$user=$_SESSION["usuario_write"];}else{}}
$consulta="SELECT * FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
$nombre=$fila['NOMBRE'];
$apellido=$fila['APELLIDO'];
$f_nac=$fila['F_NACIMIENTO'];
$correo=$fila['AUTOR_CORREO'];
$facebook=$fila['FACEBOOK'];
$instagram=$fila['INSTAGRAM'];
$twitter=$fila['TWITTER'];
$descrip=$fila['DESCRIPCION'];
$contrasena=$fila['CONTRASENA'];
$nacionalidad=$fila['NACIONALIDAD'];
$pregunta=$fila['PREGUNTA'];
$respuesta=$fila['RESPUESTA'];

//DEFINIENDO AÑO ACTUAL
$ano_actual=date("Y");
//EXTRAYENDO TOTAL DE VISITAS
$consulta="SELECT VISITAS FROM `datos_visitas` WHERE DESCRIPCION='TOTAL'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$total_visitas=$fila['VISITAS'];
//EXTRAYENDO VISITAS POR MES PARA EL AÑO ACTUAL
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
$consulta="SELECT `datos_usuarios`.NOMBRE AS NOMBRE, `datos_usuarios`.APELLIDO AS APELLIDO, SUM(`datos_articulos`.VISITAS) AS VISITAS FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO = `datos_usuarios`.AUTOR_CORREO GROUP BY NOMBRE, APELLIDO ORDER BY VISITAS";
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
$consulta="SELECT `datos_usuarios`.NOMBRE AS NOMBRE, `datos_usuarios`.APELLIDO AS APELLIDO, SUM(`datos_articulos`.ME_GUSTA) AS ME_GUSTA FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO = `datos_usuarios`.AUTOR_CORREO GROUP BY NOMBRE, APELLIDO ORDER BY ME_GUSTA";
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
<title>Fundación Crystal - Modificar mis datos</title>
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
require ("header_zona_adm_2.php");
?>
<aside style="margin-top:0px; margin-bottom:5px; border-radius:0px;">
	<table style="width:100%;">
    <td style="height:275px; width:50%;">
    <div id="visitas_por_autor" style="height:275px; width:100%; margin:auto;"></div>
    </td>
    <td style="height:275px; width:50%;">
	<div id="likes_por_autor" style="height:275px; width:100%; margin:auto;"></div>
	</td>
    </table>
</aside>

<section>
	<article style="height:275px;">
	<form action="update_user.php" method="post" name="modificar" enctype="multipart/form-data">
    <table>
    	<tr>
        	<th colspan="4" style="border:1px solid #333;"><h3 style="text-align:center;">Plantilla para modificar datos personales:</h3></th>
        </tr>
    	<tr>
        	<th style="border:1px solid #333;">Nombre:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="nombre" required value="<?php echo "$nombre"; ?>"></td>
        	<th style="border:1px solid #333;">Apellido:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="apellido" required value="<?php echo "$apellido"; ?>"></td>
        </tr>
    	<tr>
        	<th style="border:1px solid #333;">Fecha Nacimiento:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="f_nac" required value="<?php echo "$f_nac"; ?>"></td>
        	<th style="border:1px solid #333;">Correo:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="correo" required value="<?php echo "$correo"; ?>"></td>
        </tr>
    	<tr>
        	<th style="border:1px solid #333;">País:</th>
        	<td style="border:1px solid #333;">
                <select style="width:180px; font-size:12px; background-color:#ffffee;" type="text" name="nacionalidad">
                    <option><?php echo "$nacionalidad"; ?></option>
                    <option>Afganistán</option>
                    <option>Alemania</option>
                    <option>Angola</option>
                    <option>Antigua y Barbuda</option>
                    <option>Arabia Saudita</option>
                    <option>Argelia</option>
                    <option>Argentina</option>
                    <option>Armenia</option>
                    <option>Australia</option>
                    <option>Austria</option>
                    <option>Azerbaiyán</option>
                    <option>Bahamas</option>
                    <option>Bahréin</option>
                    <option>Bangladesh</option>
                    <option>Barbados</option>
                    <option>Bélgica</option>
                    <option>Bélice</option>
                    <option>Benin</option>
                    <option>Birmania</option>
                    <option>Bolivia</option>
                    <option>Botswana</option>
                    <option>Brasil</option>
                    <option>Brunei</option>
                    <option>Bulgaria</option>
                    <option>Burkina Fasso</option>
                    <option>Burundi</option>
                    <option>Bután</option>
                    <option>Cabo Verde</option>
                    <option>Camboya</option>
                    <option>Camerun</option>
                    <option>Canadá</option>
                    <option>Canarias</option>
                    <option>Chad</option>
                    <option>Chile</option>
                    <option>China</option>
                    <option>Chipre</option>
                    <option>Colombia</option>
                    <option>Comores</option>
                    <option>Congo Brazzaville</option>
                    <option>Congo Kinsasa</option>
                    <option>Corea del Norte</option>
                    <option>Corea del Sur</option>
                    <option>Costa de Marfil</option>
                    <option>Costa Rica</option>
                    <option>Cuba</option>
                    <option>Dinamarca</option>
                    <option>Djibuti</option>
                    <option>Dominica</option>
                    <option>Ecuador</option>
                    <option>Egipto</option>
                    <option>El Salvador</option>
                    <option>Emiratos Árabes Unidos</option>
                    <option>Eritrea</option>
                    <option>Eslovaquia</option>
                    <option>Eslovenia</option>
                    <option>España</option>
                    <option>Estados Unidos</option>
                    <option>Estonia</option>
                    <option>Etiopia</option>
                    <option>Fiji</option>
                    <option>Filipinas</option>
                    <option>Finlandia</option>
                    <option>Francia</option>
                    <option>Gabon</option>
                    <option>Gambia</option>
                    <option>Georgia</option>
                    <option>Ghana</option>
                    <option>Granada</option>
                    <option>Grecia</option>
                    <option>Guatemala</option>
                    <option>Guyana</option>
                    <option>Haití</option>
                    <option>Honduras</option>
                    <option>Hungría</option>
                    <option>India</option>
                    <option>Indonesia</option>
                    <option>Irán</option>
                    <option>Iraq</option>
                    <option>Irlanda</option>
                    <option>Islas Marshall</option>
                    <option>Islas Salomon</option>
                    <option>Israel</option>
                    <option>Italia</option>
                    <option>Jamaica</option>
                    <option>Japón</option>
                    <option>Jordania</option>
                    <option>Kazajistán</option>
                    <option>Kirguistán</option>
                    <option>Kiribati</option>
                    <option>Kuwait</option>
                    <option>Laos</option>
                    <option>Letonia</option>
                    <option>Líbano</option>
                    <option>Lituania</option>
                    <option>Luxemburgo</option>
                    <option>Malasia</option>
                    <option>Maldivas</option>
                    <option>Malta</option>
                    <option>México</option>
                    <option>Micronesia</option>
                    <option>Mongolia</option>
                    <option>Mozambique</option>
                    <option>Namibia</option>
                    <option>Naurú</option>
                    <option>Nepal</option>
                    <option>Nicaragua</option>
                    <option>Niger</option>
                    <option>Nigeria</option>
                    <option>Omán</option>
                    <option>Países Bajos</option>
                    <option>Pakistán</option>
                    <option>Palestina</option>
                    <option>Panamá</option>
                    <option>Paraguay</option>
                    <option>Perú</option>
                    <option>Polonia</option>
                    <option>Portugal</option>
                    <option>Puerto Rico</option>
                    <option>Qatar</option>
                    <option>Reino Unido</option>
                    <option>República Centroafricana</option>
                    <option>República Checa</option>
                    <option>República Dominicana</option>
                    <option>Reunion</option>
                    <option>Rumanía</option>
                    <option>Rusia</option>
                    <option>Rwanda</option>
                    <option>Sahara</option>
                    <option>San Cristóbal y Nevis</option>
                    <option>San Vicente y Las Granadinas</option>
                    <option>Santa Helena</option>
                    <option>Santa Lucía</option>
                    <option>Santo Tome y Principe</option>
                    <option>Senegal</option>
                    <option>Seychelles</option>
                    <option>Sierraleona</option>
                    <option>Singapur</option>
                    <option>Siria</option>
                    <option>Somalia</option>
                    <option>Sri Lanka</option>
                    <option>Sudafrica</option>
                    <option>Sudán</option>
                    <option>Suecia</option>
                    <option>Surinam</option>
                    <option>Swaziland</option>
                    <option>Tailandia</option>
                    <option>Taiwán</option>
                    <option>Tanzania</option>
                    <option>Tayikistán</option>
                    <option>Timor Oriental</option>
                    <option>Togo</option>
                    <option>Trinidad y Tobago </option>
                    <option>Tunez</option>
                    <option>Turkmenistán</option>
                    <option>Turquía</option>
                    <option>Uruguay</option>
                    <option>Uzbekistán</option>
                    <option>Venezuela</option>
                    <option>Vietnam</option>
                    <option>Yemen</option>
            	</select>
            
        	<th style="border:1px solid #333;">Facebook:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="facebook" value="<?php echo "$facebook"; ?>"></td>
        </tr>
    	<tr>
        	<th style="border:1px solid #333;">Twitter:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="twitter" value="<?php echo "$twitter"; ?>"></td>
        	<th style="border:1px solid #333;">Instagram:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="instagram" value="<?php echo "$instagram"; ?>"></td>
        </tr>
    	<tr>
        	<th style="border:1px solid #333;">Pregunta:</th>
        	<td style="border:1px solid #333;">
                <select style="width:180px; background-color:#ffffee;" type="text" name="pregunta">
                    <option><?php echo "$pregunta"; ?></option>
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
         	</td>
        	<th style="border:1px solid #333;">Respuesta:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="respuesta" required value="<?php echo "$respuesta"; ?>"></td>
        </tr>
    	<tr>
        	<th style="border:1px solid #333;">Contraseña:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="contrasena1" required value="<?php echo "$contrasena"; ?>"></td>
        	<th style="border:1px solid #333;">Rep. Cont.:</th>
        	<td style="border:1px solid #333;"><input type="text" style="width:175px; background-color:#ffffee;" name="contrasena2" required value="<?php echo "$contrasena"; ?>"></td>
        </tr>
    	<tr>
        	<th style="border:1px solid #333;">Descripción:<br><br>Nueva Foto:<br><div style="width:85px; overflow:hidden; text-align:center; margin:auto;"><input type='file' name='foto'></th>
        	<td colspan="2" style="border:1px solid #333;"><textarea rows="4" style="width:95%; background-color:#ffffee;" name="descrip"><?php echo "$descrip"; ?></textarea required></td>
            <td style="border:1px solid #333;"><input type="submit" name="modificar" style="font-size:24px;" value="Modificar"></td>
        </tr>
    
    </table>
    </form>
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
				text: "Visitas para el año: <?php echo "$ano_actual"; ?>"
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