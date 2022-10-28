<?php
//conexion
require ("conexion.php");
//RECUPERANDO DATOS DEL FORM
if(!isset($_POST["nombre"]) or !isset($_POST["apellido"]) or !isset($_POST["nacionalidad"]) or !isset($_POST["fecha_nacimiento"]) or !isset($_POST["correo"]) or !isset($_POST["correo_conf"]) or !isset($_POST["contrasena"]) or !isset($_POST["contrasena_conf"]) or !isset($_POST["pregunta"]) or !isset($_POST["respuesta"]) or !isset($_POST["descripcion"]) or !isset($_FILES['foto']['name'])){
	mysqli_close($conexion);
	?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php"><?php
	//header("location:index.php");
}else{
	$nombre=addslashes($_POST['nombre']);
	$apellido=addslashes($_POST['apellido']);
	$nacionalidad=addslashes($_POST['nacionalidad']);
	$fecha_nacimiento=htmlentities(addslashes($_POST['fecha_nacimiento']));
		//VERIFICANDO QUE ELIGIÓ LA FECHA DE NACIMIENTO
		if($fecha_nacimiento=='Eliga una fecha' or $fecha_nacimiento=='$fecha_nacimiento'){
			$verf_fecha_nac_1="error";
			$fecha_nac_ano=date('Y')+1;
		}else{
			$verf_fecha_nac_1="ok";
			$fecha_nac_d_m_a=explode("-",$fecha_nacimiento);
			$fecha_nac_dia=$fecha_nac_d_m_a[0];
			$fecha_nac_mes_letra=$fecha_nac_d_m_a[1];
				if($fecha_nac_mes_letra=='Jan'){$fecha_nac_mes=1;}else{
				if($fecha_nac_mes_letra=='Feb'){$fecha_nac_mes=2;}else{
				if($fecha_nac_mes_letra=='Mar'){$fecha_nac_mes=3;}else{
				if($fecha_nac_mes_letra=='Apr'){$fecha_nac_mes=4;}else{
				if($fecha_nac_mes_letra=='May'){$fecha_nac_mes=5;}else{
				if($fecha_nac_mes_letra=='Jun'){$fecha_nac_mes=6;}else{
				if($fecha_nac_mes_letra=='Jul'){$fecha_nac_mes=7;}else{
				if($fecha_nac_mes_letra=='Aug'){$fecha_nac_mes=8;}else{
				if($fecha_nac_mes_letra=='Sep'){$fecha_nac_mes=9;}else{
				if($fecha_nac_mes_letra=='Oct'){$fecha_nac_mes=10;}else{
				if($fecha_nac_mes_letra=='Nov'){$fecha_nac_mes=11;}else{
				if($fecha_nac_mes_letra=='Dec'){$fecha_nac_mes=12;}}}}}}}}}}}}
			$fecha_nac_ano=$fecha_nac_d_m_a[2];
			$fecha_nac_sql=$fecha_nac_ano . '-' . $fecha_nac_mes . '-' . $fecha_nac_dia;
		}
	$correo=htmlentities(addslashes($_POST['correo']));
	$correo_conf=htmlentities(addslashes($_POST['correo_conf']));
	$contrasena=htmlentities(addslashes($_POST['contrasena']));
	$contrasena_conf=htmlentities(addslashes($_POST['contrasena_conf']));
	$pregunta=$_POST['pregunta'];
	$respuesta=htmlentities(addslashes($_POST['respuesta']));
	$descripcion=htmlentities(addslashes($_POST['descripcion']));
	$foto_name=$_FILES['foto']['name'];
	$foto_type=$_FILES['foto']['type'];
	$foto_size=$_FILES['foto']['size'];
	$ruta_temporal=$_FILES['foto']['tmp_name'];
	$ruta_destino=$_SERVER['DOCUMENT_ROOT'] . '/FUNDACRYSTAL/IMAGENES/' .  $foto_name;
	$facebook=$_POST['facebook'];
	$twitter=$_POST['twitter'];
	$instagram=$_POST['instagram'];
}
//VERIFICANDO DUPLICIDAD DE NOMBRE DE LA IMAGEN Y CAMBIANDOLO DE SER NECESARIO
$o=1;
while(file_exists($ruta_destino)==true){
	$foto_name=$o . $foto_name;
	$ruta_destino=$_SERVER['DOCUMENT_ROOT'] . '/FUNDACRYSTAL/IMAGENES/' .  $foto_name;
	$o=$o+1;
}
//VERIFICANDO COHERENCIA DE CORREO INTRODUCIDO
if($correo==$correo_conf){$verf_correo_1="ok";}else{$verf_correo_1="error";}
//VERIFICANDO QUE NO EXISTA EN LA BD EL CORREO INTRODUCIDO
$consulta="SELECT ID FROM `datos_usuarios` WHERE AUTOR_CORREO='$correo'";
$resultado=mysqli_query($conexion,$consulta);
$cta_correo=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$cta_correo=$cta_correo+1;
}
if($cta_correo>0){$verf_correo_2="error";}else{$verf_correo_2="ok";}
//VERIFICANDO COHERENCIA DE CONTRASEÑA INTRODUCIDA
if($contrasena==$contrasena_conf){$verf_contrasena="ok";}else{$verf_contrasena="error";}
//VERIFICANDO COHERENCIA DE PREGUNTA
if($pregunta=='--Elige una Preguna--'){$verf_pregunta="error";}else{$verf_pregunta="ok";}
//VERIFICANDO TAMAÑO DE LA FOTO
if($foto_size>2000000){$verf_foto_1="error";}else{$verf_foto_1="ok";}
//VERIFICANDO FORMATO DE LA FOTO
if($foto_type=='image/jpeg' or $foto_type=='image/jpg' or $foto_type=='image/png' or $foto_type=='image/gif'){$verf_foto_2="ok";}else{$verf_foto_2="error";}
//VERIFICANDO COHERENCIA DE LA FECHA DE NACIMIENTO
if($fecha_nac_ano>date('Y')-1){$verf_fecha_nac_2="error";}else{$verf_fecha_nac_2="ok";}
/*
echo "correo igual=igual: $verf_correo_1<br>";
echo "correo ya existe: $verf_correo_2<br>";
echo "contraseña igual=igual: $verf_contrasena<br>";
echo "pregunta: $verf_pregunta<br>";
echo "foto tamaño: $verf_foto_1<br>";
echo "foto type: $verf_foto_2<br>";
echo "fecha elegida: $verf_fecha_nac_1<br>";
echo "fecha correcta: $verf_fecha_nac_2<br>";
*/
?>

<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<?php
//META CANONICAL PARA INDEX
echo "<link rel='canonical' href='http://www.fundacrystal.tk/index.php' />";
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
<title>Fundación Crystal - Registro de Usuarios</title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
<?php
//header
require ("efecto_entrada.php");
?>
</head>

<body>

<?php
//header
require ("header.php");
?>
<section>

<?php

if($verf_correo_1=='ok' and $verf_correo_2=='ok' and $verf_contrasena=='ok' and $verf_pregunta=='ok' and $verf_foto_1=='ok' and $verf_foto_2=='ok' and $verf_fecha_nac_1=='ok' and $verf_fecha_nac_2=='ok'){
	$consulta="INSERT INTO `datos_usuarios` (NOMBRE, APELLIDO, F_NACIMIENTO, AUTOR_CORREO, FACEBOOK, INSTAGRAM, TWITTER, DESCRIPCION, CONTRASENA, FOTO, NACIONALIDAD, PREGUNTA, RESPUESTA, NIVEL_ACCESO) VALUES ('$nombre', '$apellido', '$fecha_nac_sql', '$correo', '$facebook', '$instagram', '$twitter', '$descripcion', '$contrasena', '$foto_name', '$nacionalidad', '$pregunta', '$respuesta', 'ESCRITOR');";
	$resultado=mysqli_query($conexion,$consulta);
	//MOVIENDO IMAGEN A LA CARPETA DE IMAGENES DEL PROYECTO
	move_uploaded_file($ruta_temporal,$ruta_destino);
	echo "<table style='width:98%; margin:auto; border:#473663 8px ridge; background-color:#376092; color:#fff;'>
		  <tr style='border:#000 2px solid;'>
			<th colspan='4' style='font-size:24px; font-weight:bolder; background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea); border:#000 1px solid; color:#000;'>
				Sus datos Fueron Introducidos Correctamente:
			</th>
		  </tr>
		  <tr style='border:#000 2px solid;'>
			<th style='border:#000 1px solid;'>Nombre:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' disabled name='nombre' id='nombre' value='$nombre'></th>
			<th style='border:#000 1px solid;'>Apellido:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' disabled name='apellido' id='apellido' value='$apellido'></th>
		  </tr>
		  <tr style='border:#000 2px solid;'>
			<th style='border:#000 1px solid;'>Nacionalidad:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' disabled name='nacionalidad' id='nacionalidad' value='$nacionalidad'>
			</th>
			<th style='border:#000 1px solid;'>Fecha de Nacimiento:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' disabled name='fecha_nacimiento' id='fecha_nacimiento' value='$fecha_nacimiento'>
			</th>
		  </tr>
		  <tr style='border:#000 2px solid;'>
			<th style='border:#000 1px solid;'>Correo Electrónico:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='email' disabled name='correo' id='correo' value='$correo'></th>
			<th style='border:#000 1px solid;'>Contraseña de Acceso:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' disabled name='contrasena' id='contrasena' value='$contrasena'></th>
		  </tr>
		  <tr style='border:#000 2px solid;'>
			<th style='border:#000 1px solid;'>Pregunta de Seguridad:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' disabled name='pregunta' id='pregunta' value='$pregunta'>
			</th>
			<th style='border:#000 1px solid;'>Respuesta:</th>
			<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' disabled name='respuesta' id='respuesta' value='$respuesta'></th>
		  </tr>
		  <tr style='border:#000 2px solid;'>
			<th style='border:#000 1px solid;'><img width='170px' height='130px' src='IMAGENES/$foto_name'/></th>
			<th colspan='3' style='border:#000 1px solid;'><textarea name='descripcion' rows='8' style='width:98%; background-color:#ffc;' disabled>$descripcion</textarea></th>
		  </tr>
		  <tr>
			  <th colspan='4' style='border:#000 1px solid;'>
			  FaceBook:<input style='width:230px; background-color:#ffc;' type='text' name='facebook' disabled value='$facebook'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  Twitter:<input style='width:230px; background-color:#ffc;' type='text' name='twitter' disabled value='$twitter'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  Instagram:<input style='width:230px; background-color:#ffc;' type='text' name='instagram' disabled value='$instagram'>
			  </th>
		  </tr>
	  </table>";
}else{
	echo "<form name='registrar_usuario' id='registrar_usuario' method='post' action='registrar_usuario.php' enctype='multipart/form-data'>
		  <table style='width:98%; margin:auto; border:#473663 8px ridge; background-color:#376092; color:#fff;'>
			  <tr style='border:#000 2px solid;'>
				<th colspan='4' style='font-size:24px; font-weight:bolder; background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea); border:#000 1px solid; color:#000;'>
					Por favor verifique la información que está intentando introducir:";
	if($verf_correo_1=='error'){echo "<h5 style='color:red;'>*** El Correo Electrónico que introdujo no coincide con la confirmación ***</h5>";}
	if($verf_correo_2=='error'){echo "<h5 style='color:red;'>*** El Correo Electrónico que introdujo ya existe, por favor intente con uno diferente ***</h5>";}
	if($verf_contrasena=='error'){echo "<h5 style='color:red;'>*** La contraseña que introdujo no coincide con la confirmación ***</h5>";}
	if($verf_pregunta=='error'){echo "<h5 style='color:red;'>*** No eligió una pregunta de seguridad, por favor eliga una ***</h5>";}
	if($verf_fecha_nac_1=='error'){echo "<h5 style='color:red;'>*** No eligió una fecha de nacimiento, por favor eliga una ***</h5>";}
	if($verf_fecha_nac_2=='error'){echo "<h5 style='color:red;'>*** La fecha de nacimiento que introdujo no es válidad, por favor eliga una válida ***</h5>";}
	if($verf_foto_1=='error'){echo "<h5 style='color:red;'>*** La foto que está intentando introducir es muy pesada (más de 2MegaBytes) por favor eliga una de menor tamaño ***</h5>";}
	if($verf_foto_2=='error'){echo "<h5 style='color:red;'>*** La foto que está intentando introducir tiene un formato no permitido, por favor cambie el formato y vuelva a intentarlo (sólo se permite .jpeg, .jpg, .png ó .gif) ***</h5>";}
	echo "</th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th style='border:#000 1px solid;'>Nombre:</th>
				<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' name='nombre' id='nombre' value='$nombre' required></th>
				<th style='border:#000 1px solid;'>Apellido:</th>
				<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' name='apellido' id='apellido' value='$apellido' required></th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th style='border:#000 1px solid;'>Nacionalidad:</th>
				<th style='border:#000 1px solid;'><select style='width:270px; background-color:#ffc;' name='nacionalidad' id='nacionalidad'>
					<option>$nacionalidad</option>
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
				</th>
				<th style='border:#000 1px solid;'>Fecha de Nacimiento:</th>
		
				<!-- AGREGANDO CALENDARIO -->
				<th><!-- calendar stylesheet -->
				  <link rel='stylesheet' type='text/css' media='all' href='calendar-system.css' title='system' />
				
				  <!-- main calendar program -->
				  <script type='text/javascript' src='calendar.js'></script>
				
				  <!-- language for the calendar -->
				  <script type='text/javascript' src='calendar-es.js'></script>
				
				  <!-- the following script defines the Calendar.setup helper function, which makes
					   adding a calendar a matter of 1 or 2 lines of code. -->
				  <script type='text/javascript' src='calendar-setup.js'></script>
					  <table cellspacing='0' cellpadding='0' style='border-collapse:collapse; border:none; box-shadow:none;'><tr>
					   <td><input type='text' style='width:230px; text-align:center; background-color:#ffc;' name='fecha_nacimiento' id='fecha_nacimiento' readonly value='$fecha_nacimiento'/></td>
					   <td><img src='calendario.jpg' id='f_trigger_c' style='cursor: pointer; border: 1px solid red;' title='Haga Click Aqui para Desplegar el Calendario y seleccionar su fecha'
							onmouseover='this.style.background='blue';' onMouseOut='this.style.background=''' /></td></tr>
					  </table>
				<script type='text/javascript'>
					Calendar.setup({
						inputField     :    'fecha_nacimiento',     // id of the input field
						ifFormat       :    '%d-%b-%Y',      // format of the input field
						button         :    'f_trigger_c',  // trigger for the calendar (button ID)
						align          :    'Tl',           // alignment (defaults to 'Bl')
						singleClick    :    true
					});
				</script>
		
				</th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th style='border:#000 1px solid;'>Correo Electrónico:</th>
				<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='email' name='correo' id='correo' value='$correo' required></th>
				<th style='border:#000 1px solid;'>Confirmar Correo Electrónico:</th>
				<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='email' name='correo_conf' id='correo_conf' value='$correo_conf' required></th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th style='border:#000 1px solid;'>Contraseña de Acceso:</th>
				<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' name='contrasena' id='contrasena' value='$contrasena' required></th>
				<th style='border:#000 1px solid;'>Confirmar Contraseña:</th>
				<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' name='contrasena_conf' id='contrasena_conf' value='$contrasena_conf' required></th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th style='border:#000 1px solid;'>Pregunta de Seguridad:</th>
				<th style='border:#000 1px solid;'><select style='width:270px; background-color:#ffc;' type='text' name='pregunta' id='pregunta' value='$pregunta' required>
					<option>$pregunta</option>
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
					<option>Cual es tu actris favorita<</option>
					<option>Cual es tu canción favorita</option>
					<option>Cual es tu película favorita</option>
					<option>Cual es tu deporte favorito</option>
					<option>Cual fue la marca de tu primer celular</option>
					<option>Cual es la marca de tu carro favorito</option>
					<option>Cual es el nombre de tu padrino de bodas</option>
					<option>Cual es el nombre de tu madrina de bodas</option>
					<option>Cual es el nombre de tu mejor amigo</option>
				</select></th>
				<th style='border:#000 1px solid;'>Respuesta:</th>
				<th style='border:#000 1px solid;'><input style='width:270px; background-color:#ffc;' type='text' name='respuesta' id='respuesta' value='$respuesta' required></th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th colspan='2' style='border:#000 1px solid;'>Foto (formato jpg, jpeg, png o gif) (máximo tamaño 2MegaBytes):</th>
				<th colspan='2' style='border:#000 1px solid;'><input type='file' name='foto' id='foto' required></th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th colspan='4' style='border:#000 1px solid;'>Descripción (ingrese su profesión, trabajo actual y cualquier otra información personal que considere pertinente):</th>
			  </tr>
			  <tr>
				<th colspan='4' style='border:#000 1px solid;'><textarea name='descripcion' rows='1' style='width:98%; background-color:#ffc;' required>$descripcion</textarea></th>
			  </tr>
			  <tr>
				  <th colspan='4' style='border:#000 1px solid;'>
				  FaceBook:<input style='width:230px; background-color:#ffc;' type='text' name='facebook' value='$facebook'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  Twitter:<input style='width:230px; background-color:#ffc;' type='text' name='twitter' value='$twitter'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  Instagram:<input style='width:230px; background-color:#ffc;' type='text' name='instagram' value='$instagram'>
				  </th>
			  </tr>
			  <tr style='border:#000 2px solid;'>
				<th colspan='4' style='border:#000 1px solid;'><input type='submit' name='registrar' id='registrar' style='font-size:14px;' value='Registrar Datos' required></th></tr></form>
		  </table>";
}

?>

</section>
<?php
//header
require ("footer.php");
?>
<br><br>
</body>
</html>
<?php
mysqli_close($conexion);
?>