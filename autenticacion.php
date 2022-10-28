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
<title>Fundación Crystal - Autenticacion</title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
<?php
//header
require ("efecto_entrada.php");
?>
<script src="jquery-1.2.3.js"></script>
<script src="jquery.innerfade.js"></script>
<script type="text/javascript">
   $(document).ready(
			function(){
				$('ul#portfolio').innerfade({
				speed: 3000,
				timeout: 4000,
				type: 'sequence',
				containerheight: '220px'
			});
	});
</script>

</head>
<body>
<?php
//header
require ("header.php");
?>
<section>
  <form name="inicio_usuario" id="inicio_usuario" method="post" action="comprueba_usuario.php">
    <table style="width:350px; margin:auto; border:#473663 8px ridge; box-shadow:#333 10px 5px 10px; color:#FFF; background-color:#376092;">
        <tr style="border:#000 2px solid;">	
            <th colspan="2" style="font-size:24px; font-weight:bolder; 	background:-moz-linear-gradient(top, #FFF, #c1e2ea); background:-ms-linear-gradient(top, #FFF, #c1e2ea); background:-webkit-linear-gradient(top, #FFF, #c1e2ea); background:-o-radial-linear(top, #FFF, #c1e2ea); color:#000;">Datos de Autenticación</th>
        </tr>
        <tr style="border:#000 2px solid;">
            <th>Correo Electrónico:</th>
            <th><input style="width:185px;" type="text" name="nombre_usuario" id="nombre_usuario" required autofocus></th>
        </tr>	
        <tr style="border:#000 2px solid;">	
            <th>Contraseña:</th>
            <th><input style="width:185px;" type="password" name="contrasena" id="contrasena" required></th>
        </tr>
        <tr style="border:#000 2px solid;">	
            <th colspan="2"><input  type="submit" name="ingresar" id="ingresar" value="Ingresar" required></th>
        </tr>
        <tr style="border:#000 2px solid;">	
            <th colspan="2" style="background:-moz-linear-gradient(bottom, #FFF, #c1e2ea); background:-ms-linear-gradient(bottom, #FFF, #c1e2ea); background:-webkit-linear-gradient(bottom, #FFF, #c1e2ea); background:-o-radial-linear(bottom, #FFF, #c1e2ea); font-size:18px;"><a href="recupera_datos.php">Olvide mis datos</a> &nbsp;&nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp; <a href="registro_usuarios.php">Regístrate</a></th>
        </tr>
    </table>
  </form>

  <div style="height:180px; width:350px; margin:auto; margin-top:5px; border:#4fa7d7 8px ridge; box-shadow:#333 10px 5px 10px;	border-radius:40px; background-color:#333333; padding:0px;">
      <ul id="portfolio" style=" padding:0px; margin:0px">
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo01.jpg" alt="logo_autismo01" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo02.jpg" alt="logo_autismo02" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo03.jpg" alt="logo_autismo03" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo04.jpg" alt="logo_autismo04" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo05.jpg" alt="logo_autismo05" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo06.jpg" alt="logo_autismo06" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo07.jpg" alt="logo_autismo07" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo08.jpg" alt="logo_autismo08" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo09.jpg" alt="logo_autismo09" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo10.jpg" alt="logo_autismo10" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo11.jpg" alt="logo_autismo11" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo12.jpg" alt="logo_autismo12" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo13.jpg" alt="logo_autismo13" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo14.jpg" alt="logo_autismo14" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo15.jpg" alt="logo_autismo15" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo16.jpg" alt="logo_autismo16" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo17.jpg" alt="logo_autismo17" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo18.jpg" alt="logo_autismo18" /></a>
              </li>
              <li>
                  <a href="FUNDACRYSTAL/index.php"><img style="height:180px; width:350px; margin:auto; border-radius:30px; background-color:#333333;" width="400px" height="220px" src="IMAGENES/logo_autismo19.jpg" alt="logo_autismo19" /></a>
              </li>
      </ul>  
  </div>
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