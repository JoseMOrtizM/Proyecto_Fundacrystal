<footer style="color:#FFF; background-color:#376092; border-radius:30px 0px 30px 0px;">
<table style='width:100%;'>
<td style='width:17%;'>
  <table>
    <tr><td colspan="4" style='color:#EE5;'>Nuestras Redes Sociales</td></tr>
    <tr>
      <td><a href="http://www.facebook.com/fundacrystal"><img width="35px" height="35px" src="IMAGENES/FACEBOOK.jpg"/></a></td>
      <td><a href="http://www.twitter.com/fundacrystal"><img width="35px" height="35px" src="IMAGENES/TWITTER.jpg"/></a></td>
      <td><a href="http://www.instagram.com/fundacrystal"><img width="35px" height="35px" src="IMAGENES/INSTAGRAM.jpg"/></a></td>
      <td><a href="http://www.youtube.com/fundacioncrystal"><img width="35px" height="35px" src="IMAGENES/YOUTUBE.jpg"/></a></td>
    </tr>
  </table>
</td>
<td style='width:23%;'>
  <table>
    <form name="etiquetas" action="autores.php" method="get">
    <tr><td colspan="2" style='color:#EE5;'>Autores</td></tr>
    <tr>
      <td colspan="2"><select class="input_ir_a" name="autor" id="autor">
      <option>Elige un Autor</option>
  <?php
    //OBTENIENDO ARRAY DE AUTORES
    $consulta="SELECT `datos_usuarios`.NOMBRE AS NOMBRE, `datos_usuarios`.APELLIDO AS APELLIDO, `datos_usuarios`.AUTOR_CORREO AS CORREO, COUNT(`datos_articulos`.ID) AS ARTICULOS FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO GROUP BY CORREO ORDER BY APELLIDO, NOMBRE";
    $resultado=mysqli_query($conexion,$consulta);
    while(($fila=mysqli_fetch_array($resultado))==true){
        $autor_nombre=ucwords(mb_strtolower($fila['NOMBRE'],'UTF-8'));
        $autor_apellido=ucwords(mb_strtolower($fila['APELLIDO'],'UTF-8'));
        $autor_correo=$fila['CORREO'];
        $articulos=$fila['ARTICULOS'];
    echo "<option>$autor_apellido, $autor_nombre ($articulos)</option>";
    }
    ?>
          </select>
         <input class="ir_a" type="submit" name="buscar" value="Buscar"></td>
    </tr>
    </form>
  </table>
</td>
<td style='width:28%;'>
  <table>
    <form name="etiquetas" action="hemeroteca.php" method="post">
    <tr><td colspan="2" style='color:#EE5;'>Hemeroteca</td></tr>
    <tr>
      <td colspan="2"><select class="input_ir_a" name="hemeroteca" id="hemeroteca">
      <option>Elige un mes</option>
    <?php
        //OBTENIENDO ARRAY AÑO MESES ARTÍCULOS
        $consulta="SELECT ART_ANO, ART_MES, COUNT(ID) AS ARTICULOS FROM `datos_articulos` GROUP BY ART_ANO, ART_MES ORDER BY ART_ANO DESC, ART_MES DESC";
        $resultado=mysqli_query($conexion,$consulta);
        $cta_meses=0;
    while(($fila=mysqli_fetch_array($resultado))==true){
            $anos[$cta_meses]=$fila['ART_ANO'];
            $meses[$cta_meses]=$fila['ART_MES'];
            $articulos_i2[$cta_meses]=$fila['ARTICULOS'];
      $cta_meses=$cta_meses+1;
    }
    //IMPRIMIENDO HEMEROTECA
    $i=0;
    while($i<$cta_meses){
      echo "<option>Año: $anos[$i] / Mes: $meses[$i] ($articulos_i2[$i] Artículos)</option>";
      $i=$i+1;
    }
        ?>
          </select>
         <input class="ir_a" type="submit" name="buscar" value="Buscar"></td>
    </tr>
    </form>
  </table>
</td>
<td style='width:22%;'>
  <table>
    <form name="etiquetas" action="categorias.php" method="get">
    <tr><td colspan="2" style='color:#EE5;'>Categorias</td></tr>
    <tr>
      <td colspan="2"><select class="input_ir_a" name="categoria" id="categoria" contextmenu="Eliga una Categoría">
      <option>Elige una categoría</option>          
      <?php
      //OBTENIENDO CATEGORIAS DE LA BD
      $consulta="SELECT CATEGORIA FROM `datos_articulos` GROUP BY CATEGORIA ORDER BY CATEGORIA";
      $resultado=mysqli_query($conexion,$consulta);
      $cta_categoria=0;
      while(($fila=mysqli_fetch_array($resultado))==true){
        $categorias[$cta_categoria]=ucfirst(mb_strtolower($fila['CATEGORIA'],'UTF-8'));
       $cta_categoria=$cta_categoria+1;
      }
      //PONIENDO EL CONTADOR EN SU LUGAR
      $cta_categoria=$cta_categoria-1;
      //IMPRIMIENDO CATEGORIAS
      $i=0;
      while($i<=$cta_categoria){
        echo "<option>$categorias[$i]</option>";
        $i=$i+1;
      }
        ?>
          </select>
		  <input class="ir_a" type="submit" name="buscar" value="Buscar"></td>
    </tr>
    </form>
  </table>
</td>
</table>
</footer>