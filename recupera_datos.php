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
<title>Fundación Crystal - Recupera datos de Usuarios</title>
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
  <table style="width:350px; margin:auto; border:#473663 8px ridge; background-color:#376092;">
  <form name="recupera_usuario" id="recupera_usuario" method="post" action="recupera_datos_read.php">
      <tr style="border:#000 2px solid;"><th style="font-size:19px; font-weight:bolder; 	background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea);">Introduzca su Correo Electrónico</th></tr>
      <tr style="border:#000 2px solid;"><th><input style="width:320px; background-color:#fff;" type="email" name="correo" id="correo" required></th></tr>
      <tr style="border:#000 2px solid;"><th style="font-size:19px; font-weight:bolder; 	background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea);">Introduzca su País de Origen</th></tr>
      <tr style="border:#000 2px solid;"><th><input style="width:320px; background-color:#fff;" type="text" name="nacionalidad" id="nacionalidad" required></th></tr>
      <tr style="border:#000 2px solid;"><th style="font-size:19px; font-weight:bolder; 	background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea);">Introduzca su Fecha de Nacimiento<a style="font-size:16px;"><br>(Use formato AAAA-MM-DD)</a></th></tr>
      <tr style="border:#000 2px solid;"><th><input style="width:320px; background-color:#fff; width:250px; text-align:center;" class="logging_input" type="date" name="fecha_nacimiento" id="fecha_nacimiento" required></th></tr>
      <tr style="border:#000 2px solid;"><th style="font-size:19px; font-weight:bolder; 	background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea);">Seleccione su Pregunta de Seguridad</th></tr>
      <tr style="border:#000 2px solid;"><th>
          <select class="logging_input" style="width:320px; background-color:#fff;" name="pregunta" id="pregunta">
           	<option>¿-------------------------------------------------------?</option>
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
      </th></tr>
      
      <tr style="border:#000 2px solid;"><th style="font-size:19px; font-weight:bolder; 	background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea);">Responda la Pregunta</th></tr>
      <tr style="border:#000 2px solid;"><th><input style="width:320px; background-color:#fff;" type="text" name="respuesta" id="respuesta" required></th></tr>
      <tr style="border:#000 2px solid;"><th><input type="submit" name="recuperar" id="recuperar" style="font-size:14px;" value="Recuperar" required></th></tr></form>
      <tr style="border:#000 2px solid;"><th style="background:-moz-linear-gradient(bottom, #FFF, #c1e2ea); background:-ms-linear-gradient(bottom, #FFF, #c1e2ea); background:-webkit-linear-gradient(bottom, #FFF, #c1e2ea); background:-o-radial-linear(bottom, #FFF, #c1e2ea); font-size:18px;"><a href="autenticacion.php">Volver a la página Anterior</a></th></tr>
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