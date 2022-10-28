<style>
.div-img_aside {
	border:#aaa 4px ridge;
	margin:auto;
	width: auto;
}
.div-img_aside.hidden {
  overflow: hidden;
}
</style>    
    <!-- Insert to your webpage before the </head> -->
    <script src="sliderengine/jquery.js"></script>
    <script src="sliderengine/amazingslider.js"></script>
    <link rel="stylesheet" type="text/css" href="sliderengine/amazingslider-1.css">
    <script src="sliderengine/initslider-1.js"></script>
    <!-- End of head section HTML codes -->

<aside style='color:#FFF; background-color:transparent;'>

<a href=""><div class='div-img_aside hidden' style="width:300px; height:300px; border-radius:50px; background-color:#000;"><div class='img'>    
    <div id="amazingslider-wrapper-aside1" style="display:block;position:relative;max-width:300px;margin:0px auto 0px;">
        <div id="amazingslider-aside1" style="display:block;position:relative;margin:0 auto;">
            <ul class="amazingslider-slides" style="display:none;">
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/LOGO_QUIENES_SOMOS.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo02.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo03.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo18.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/LOGO_QUIENES_SOMOS.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo05.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo06.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo07.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/LOGO_QUIENES_SOMOS.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo08.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo09.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo10.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/LOGO_QUIENES_SOMOS.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo11.jpg'/></li>
                <li><img style="max-width:100%; height:250px; width:600px; border-radius:50px; border:#473663 2px ridge;" src='IMAGENES/logo_autismo12.jpg'/></li>
            </ul>
        </div>
    </div>
</div></div></a>
<div style=" background-color:#376092; border:#ae433c 8px ridge;">
  <h2 class="aside_titulo" style="color:#000; border-top:0px;">Síguenos</h2>
<br>
<div style="margin:auto; width:300px;">
   <a href="http://www.facebook.com/fundacrystal"><img width="55px" height="55px" src="IMAGENES/FACEBOOK.jpg"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="http://www.twitter.com/fundacrystal"><img width="55px" height="55px" src="IMAGENES/TWITTER.jpg"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="http://www.instagram.com/fundacrystal"><img width="55px" height="55px" src="IMAGENES/INSTAGRAM.jpg"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="http://www.youtube.com/fundacioncrystal"><img width="55px" height="55px" src="IMAGENES/YOUTUBE.jpg"/></a>
</div>
<br>
 <h2 class="aside_titulo" style="color:#000;">Buscar:</h2>
<br>
<div style="margin:5px;">
  <table style="width:auto;">
    <form name="busqueda_like" action="busqueda_like.php" method="post">
    <tr>
      <td colspan="2" style='color:#EE5;'>Buscar en este Sitio:</td>
    </tr>
    <tr>
      <td><input class="input_ir_a" type="text" name="buscar_like" style="width:210px;" required>
      </td>
      <td><input class="ir_a" type="submit" name="buscar" value="Buscar"></td>
    </tr>
    </form>
  </table>
  <table style="width:auto;">
    <form name="busqueda_hemeroteca" action="hemeroteca.php" method="post">
    <tr><td colspan="2" style='color:#EE5;'>Hemeroteca</td></tr>
    <tr>
      <td><select name="hemeroteca" class="input_ir_a">
	    <option>Seleccione un Mes</option>      	    
		<?php
        //OBTENIENDO ARRAY AÑO MESES ARTÍCULOS
        $consulta="SELECT ART_ANO, ART_MES, COUNT(ID) AS ARTICULOS FROM `datos_articulos` GROUP BY ART_ANO, ART_MES ORDER BY ART_ANO DESC, ART_MES DESC";
        $resultado=mysqli_query($conexion,$consulta);
        $cta_meses=0;
		while(($fila=mysqli_fetch_array($resultado))==true){
            $anos[$cta_meses]=$fila['ART_ANO'];
            $meses[$cta_meses]=$fila['ART_MES'];
            $articulos[$cta_meses]=$fila['ARTICULOS'];
			$cta_meses=$cta_meses+1;
		}
		//IMPRIMIENDO HEMEROTECA
		$i=0;
		while($i<$cta_meses){
			echo "<option>Año: $anos[$i] / Mes: $meses[$i] ($articulos[$i] Artículos)</option>";
			$i=$i+1;
		}
        ?>
        </select>
      </td>
      <td><input class="ir_a" type="submit" name="buscar" value="Buscar"></td>
    </tr>
    </form>
  </table>
</div>
<br>
 <h2 class="aside_titulo" style="color:#000;">Índice de Categorías</h2>
<br>
<div style="margin:5px;">
<?php
//OBTENIENDO CATEGORIAS DE LA BD
$consulta="SELECT CATEGORIA, COUNT(ID) AS CANTIDAD FROM `datos_articulos` GROUP BY CATEGORIA ORDER BY CATEGORIA";
$resultado=mysqli_query($conexion,$consulta);
$cta_categoria=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$categorias[$cta_categoria]=ucfirst(mb_strtolower($fila['CATEGORIA'],'UTF-8'));
	$cantidad[$cta_categoria]=$fila['CANTIDAD'];
	$cta_categoria=$cta_categoria+1;
}
//PONIENDO EL CONTADOR EN SU LUGAR
$cta_categoria=$cta_categoria-1;
//IMPRIMIENDO CATEGORIAS
$i=0;
while($i<=$cta_categoria){
	echo "<li style='margin-left:20px; margin-right:20px; margin-top:4px; text-align:justify;'><a href='categorias.php?categoria=$categorias[$i]' style='color:#FFF; background-color:#376092;'>$categorias[$i]</a> <ins style='color:#EE5; text-decoration:none;'>($cantidad[$i] artículos)</ins></li>";
	$i=$i+1;
}
?>
</div>
<br>
 <h2 class="aside_titulo" style="color:#000;">Últimos Artículos</h2>
<br>
<div style="margin:5px;">
	<?php
    //OBTENIENDO ARRAY DE TÍTULOS
    $consulta="SELECT ART_TITULO, ART_FECHA FROM `datos_articulos` ORDER BY ART_FECHA DESC LIMIT 0,10";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $art_titulo=ucfirst(mb_strtolower($fila['ART_TITULO'],'UTF-8'));
		echo "<li style='margin-left:20px; margin-right:20px; margin-top:4px; text-align:justify;'><a href='articulos.php?art_titulo=$art_titulo'style='color:#FFF; background-color:#376092;'>$art_titulo</a></li>";
    }
    ?>
</div>
<br>
 <h2 class="aside_titulo" style="color:#000;">Lo más leido</h2>
<br>
<div style="margin:5px;">
	<?php
    //OBTENIENDO ARRAY DE TÍTULOS
    $consulta="SELECT ART_TITULO, ART_FECHA, VISITAS FROM `datos_articulos` ORDER BY VISITAS DESC, ART_FECHA DESC LIMIT 0,10";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $art_titulo=ucfirst(mb_strtolower($fila['ART_TITULO'],'UTF-8'));
		echo "<li style='margin-left:20px; margin-right:20px; margin-top:4px; text-align:justify;'><a href='articulos.php?art_titulo=$art_titulo'style='color:#FFF; background-color:#376092;'>$art_titulo</a></li>";
    }
    ?>
</div>
<br>
 <h2 class="aside_titulo" style="color:#000;">Los lectores comentan</h2>
<br>
<div style="margin:5px;">
	<?php
    //OBTENIENDO ARRAY DE TÍTULOS
    $consulta="SELECT ART_TITULO, COMENTARIO, FECHA FROM `datos_comentarios` ORDER BY FECHA DESC LIMIT 0,5";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $art_titulo=ucfirst(mb_strtolower($fila['ART_TITULO'],'UTF-8'));
		$art_comentario=ucfirst(mb_strtolower($fila['COMENTARIO'],'UTF-8'));
		echo "<li style='margin-left:20px; margin-right:20px; margin-top:4px; text-align:justify;'><ins style='color:#EE5;'>Artículo:</ins> <a href='articulos.php?art_titulo=$art_titulo' style='color:#FFF; background-color:#376092;'>$art_titulo</a>: <br><ins style='color:#EE5;'>Comentario:</ins> <b style='font-size:14px; font-style:normal; font-weight:lighter; color:#EE5; background-color:#376092;'>$art_comentario</b></li>";
    }
    ?>
</div>
<br>
 <h2 class="aside_titulo" style="color:#000;">Nuestros Autores</h2>
<br>
<div style="margin:5px;">
	<?php
    //OBTENIENDO ARRAY DE AUTORES
    $consulta="SELECT `datos_usuarios`.NOMBRE AS NOMBRE, `datos_usuarios`.APELLIDO AS APELLIDO, `datos_usuarios`.AUTOR_CORREO AS CORREO, COUNT(`datos_articulos`.ID) AS ARTICULOS FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO GROUP BY CORREO ORDER BY APELLIDO, NOMBRE";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $autor_nombre=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
        $autor_apellido=ucwords(mb_strtolower($fila['APELLIDO'],'UTF-8'));
        $autor_correo=$fila['CORREO'];
        $articulos=$fila['ARTICULOS'];
		$autor_i=$autor_apellido . ", " . $autor_nombre . " ()";
		echo "<li style='margin-left:20px; margin-right:20px; margin-top:4px; text-align:justify;'><a href='autores.php?autor=$autor_i' style='color:#FFF; background-color:#376092;'>$autor_apellido, $autor_nombre</a> <ins style='color:#EE5; text-decoration:none;'>($articulos publicaciones)</ins></li>";
    }
    ?>
</div>
<br>
 <h2 class="aside_titulo" style="color:#000;">Aviso Importante:</h2>
<br>
<div style="margin:5px;">
	<h4 style='color:#EE5;'>"La información proporcionada en este sitio está dirigida a complementar, no a reemplazar, la relación que existe entre un paciente o visitante y su médico o terapeuta actual."</h4>
</div>
<br>
</div>
</aside>