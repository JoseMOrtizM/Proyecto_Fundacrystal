<?php
//conexion
require ("conexion.php");
?>
<!DOCTYPE HTML>
<html>
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
  <table style="width:98%; margin:auto; border:#473663 8px ridge; background-color:#376092; color:#fff;">
  <form name="registrar_usuario" id="registrar_usuario" method="post" action="registrar_usuario.php" enctype="multipart/form-data">
      <tr style="border:#000 2px solid;">
      	<th colspan="4" style="font-size:24px; font-weight:bolder; background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea); border:#000 1px solid; color:#000;">
        	Introduzca sus Datos Personales:
        </th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th style="border:#000 1px solid;">Nombre:</th>
      	<th style="border:#000 1px solid;"><input style="width:270px; background-color:#fff;" type="text" name="nombre" id="nombre" required autofocus></th>
      	<th style="border:#000 1px solid;">Apellido:</th>
      	<th style="border:#000 1px solid;"><input style="width:270px; background-color:#fff;" type="text" name="apellido" id="apellido" required></th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th style="border:#000 1px solid;">País:</th>
      	<th style="border:#000 1px solid;"><select style="width:275px; background-color:#fff;" type="text" name="nacionalidad" id="nacionalidad">
            <option>---Elige un País---</option>
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
      	<th style="border:#000 1px solid;">Fecha de Nacimiento:</th>
        <!-- AGREGANDO CALENDARIO -->
        <th><!-- calendar stylesheet -->
          <link rel="stylesheet" type="text/css" media="all" href="calendar-system.css" title="system" />
        
          <!-- main calendar program -->
          <script type="text/javascript" src="calendar.js"></script>
        
          <!-- language for the calendar -->
          <script type="text/javascript" src="calendar-es.js"></script>
        
          <!-- the following script defines the Calendar.setup helper function, which makes
               adding a calendar a matter of 1 or 2 lines of code. -->
          <script type="text/javascript" src="calendar-setup.js"></script>
              <table cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:none; box-shadow:none;"><tr>
               <td><input type="text" style="width:250px; text-align:center; background-color:#fff;" name="fecha_nacimiento" id="fecha_nacimiento" readonly  value="Eliga una fecha del Calendario"/></td>
               <td><img src="calendario.jpg" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Haga Click Aqui para Desplegar el Calendario y seleccionar su fecha"
                    onmouseover="this.style.background='blue';" onMouseOut="this.style.background=''" /></td></tr>
              </table>
        <script type="text/javascript">
            Calendar.setup({
                inputField     :    "fecha_nacimiento",     // id of the input field
                ifFormat       :    "%d-%b-%Y",      // format of the input field
                button         :    "f_trigger_c",  // trigger for the calendar (button ID)
                align          :    "Tl",           // alignment (defaults to "Bl")
                singleClick    :    true
            });
        </script>
        </th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th style="border:#000 1px solid;">Correo Electrónico:</th>
      	<th style="border:#000 1px solid;"><input style="width:270px; background-color:#fff;" type="email" name="correo" id="correo" required></th>
      	<th style="border:#000 1px solid;">Confirmar Correo Electrónico:</th>
      	<th style="border:#000 1px solid;"><input style="width:270px; background-color:#fff;" type="email" name="correo_conf" id="correo_conf" required></th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th style="border:#000 1px solid;">Contraseña de Acceso:</th>
      	<th style="border:#000 1px solid;"><input style="width:270px; background-color:#fff;" type="text" name="contrasena" id="contrasena" required></th>
      	<th style="border:#000 1px solid;">Confirmar Contraseña:</th>
      	<th style="border:#000 1px solid;"><input style="width:270px; background-color:#fff;" type="text" name="contrasena_conf" id="contrasena_conf" required></th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th style="border:#000 1px solid;">Pregunta de Seguridad:</th>
      	<th style="border:#000 1px solid;"><select style="width:270px; background-color:#fff;" type="text" name="pregunta" id="pregunta">
        	<option>--Elige una Preguna--</option>
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
        </select></th>
      	<th style="border:#000 1px solid;">Respuesta:</th>
      	<th style="border:#000 1px solid;"><input style="width:270px; background-color:#fff;" type="text" name="respuesta" id="respuesta" required></th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th colspan="2" style="border:#000 1px solid; color:#ee5;">Foto (formato jpg, jpeg, png o gif) (máximo tamaño 2MegaBytes):</th>
      	<th colspan="2" style="border:#000 1px solid;"><input type='file' name='foto' id='foto' style="background-color:transparent;" required></th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th colspan="4" style="border:#000 1px solid; color:#ee5;">Descripción (ingrese su profesión, trabajo actual y cualquier otra información personal que considere pertinente):</th>
      </tr>
      <tr>
      	<th colspan="4" style="border:#000 1px solid;"><textarea name='descripcion' rows='1' style="width:98%; background-color:#fff;" required></textarea></th>
      </tr>
      <tr>
          <th colspan="4" style="border:#000 1px solid;">
          FaceBook:&nbsp;<input style="width:200px; background-color:#fff;" type="text" name="facebook">&nbsp;&nbsp;&nbsp;&nbsp;
          Twitter:&nbsp;<input style="width:200px; background-color:#fff;" type="text" name="twitter">&nbsp;&nbsp;&nbsp;&nbsp;
          Instagram:&nbsp;<input style="width:200px; background-color:#fff;" type="text" name="instagram">
          </th>
      </tr>
      <tr style="border:#000 2px solid;">
      	<th colspan="4" style="border:#000 1px solid;"><input type="submit" name="registrar" id="registrar" style="font-size:14px;" value="Registrar Datos" required></th>
      </tr></form>
  </table>
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