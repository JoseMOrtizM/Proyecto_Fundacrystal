<header style="background-color:#FFF; border:#473663 8px ridge; width:96%; height:auto; margin-left:auto; margin-right:auto; margin-top:5px; margin-bottom:5px; height:145px; border-radius:30px 0px 30px 0px;">
<table>
	<tr>
    	<td rowspan="2" style="width:20%; padding:auto; margin:auto;">
        	<figure style='margin:0px; height:120px; width:160px; margin-left:15px; border:0px;'><img width="80%" height="100%" src="IMAGENES/LOGO01.jpg"/></figure>
    	</td>
   	    <td style="width:80%; vertical-align:top; padding:0px; margin:0px;">
          <table style="width:100%; padding-top:0px; margin-top:0px; background:-moz-linear-gradient(top, #FFF, #376092); background:-ms-linear-gradient(top, #FFF, #376092); background:-webkit-linear-gradient(top, #FFF, #376092); background:-o-radial-linear(top, #FFF, #c1e2ea); border-bottom:#473663 7px ridge; border-left:#473663 7px ridge;">
           <tr>
            <td style="width:70%;">Últimos Artículos Publicados</td>
            <td colspan="2" rowspan="2" style="border-left:#473663 1px ridge; border-bottom:#473663 1px solid; width:20%;">Queremos Conocer<br style='margin-bottom: 0px;'>Tu Historia</td>
           </tr>
           <tr>
              <?php
                //OBTENIENDO ULTIMOS ARTICULOS
                $consulta="SELECT `datos_articulos`.ART_TITULO AS ART_TITULO FROM `datos_articulos` ORDER BY ID DESC";
                $resultado=mysqli_query($conexion,$consulta);
                echo "<td rowspan='2' style='border-top:#473663 1px ridge; background-color:#fff; text-align:justify; padding:0px; padding-left:30px; margin:0px;'>";
				$i=0;
				while($i<=2){
					$e=$i+1;
					$fila=mysqli_fetch_array($resultado);
					$ultimo_articulo_titulo=$fila['ART_TITULO'];
    	            echo "$e) <a href='articulos.php?art_titulo=$ultimo_articulo_titulo' style='padding:0px; margin:0px;'>$ultimo_articulo_titulo</a><br style='margin-bottom: 0px;'>";
					$i=$i+1;
				}
				echo "</td>";
              ?>
            </tr>
            <tr>
            <td style="padding:9px; border-left:#473663 1px ridge; border-right:#473663 1px ridge; background-color:#fff;"><a id="ingreso" href="registro_usuarios.php" class="ingreso">Regístrate</a></td>
            <td style="padding:9px; background-color:#fff;"><a href="autenticacion.php" class="ingreso">&nbsp;Ingresa&nbsp;</a></td>
           </tr>
          </table>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
          <nav id="header" style="width:auto; margin-left:0%;">
            <ul class="nav">
              <li><a href="index.php">Inicio</a></li>
              <li><a href="articulos_destacados.php">Destacados</a></li>
              <li><a href="eventos.php?tipo_de_servicio=<?php $var="Nuestros Servicios"; echo "$var"; ?>">Nuestros Servicios</a>
                  <ul>
<?php
$consulta="SELECT ACT, SUB_ACT, COUNT(SUB_ACT) FROM `datos_servicios` WHERE ACT='Nuestros Servicios' GROUP BY ACT, SUB_ACT ORDER BY FECHA DESC, SUB_ACT";
$resultado=mysqli_query($conexion,$consulta);
$i=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$act1[$i]=$fila['ACT'];
	$sub_act1[$i]=$fila['SUB_ACT'];
	$i=$i+1;
}
$i=0;
while(isset($act1[$i])==true){
	echo "<li><a href='eventos.php?tipo_de_servicio=$act1[$i]#$sub_act1[$i]'>$sub_act1[$i]</a></li>";
	$i=$i+1;
}
?>
                  </ul>
               </li>
               <li><a href="eventos.php?tipo_de_servicio=<?php $var="Formación"; echo "$var"; ?>">Formación</a>
                  <ul>
<?php
$consulta="SELECT ACT, SUB_ACT, COUNT(SUB_ACT) FROM `datos_servicios` WHERE ACT='Formación' GROUP BY ACT, SUB_ACT ORDER BY FECHA DESC, SUB_ACT";
$resultado=mysqli_query($conexion,$consulta);
$i=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$act2[$i]=$fila['ACT'];
	$sub_act2[$i]=$fila['SUB_ACT'];
	$i=$i+1;
}
$i=0;
while(isset($act2[$i])==true){
	echo "<li><a href='eventos.php?tipo_de_servicio=$act2[$i]#$sub_act2[$i]'>$sub_act2[$i]</a></li>";
	$i=$i+1;
}
?>
                  </ul>
               </li>
               <li><a href="eventos.php?tipo_de_servicio=<?php $var="Eventos"; echo "$var"; ?>">Eventos</a>
                  <ul>
<?php
$consulta="SELECT ACT, SUB_ACT, COUNT(SUB_ACT) FROM `datos_servicios` WHERE ACT='Eventos' GROUP BY ACT, SUB_ACT ORDER BY FECHA DESC, SUB_ACT";
$resultado=mysqli_query($conexion,$consulta);
$i=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$act3[$i]=$fila['ACT'];
	$sub_act3[$i]=$fila['SUB_ACT'];
	$i=$i+1;
}
$i=0;
while(isset($act3[$i])==true){
	echo "<li><a href='eventos.php?tipo_de_servicio=$act3[$i]#$sub_act3[$i]'>$sub_act3[$i]</a></li>";
	$i=$i+1;
}
?>
                  </ul>
               </li>
              <li><a href="eventos.php?tipo_de_servicio=<?php $var="Conócenos"; echo "$var"; ?>">Conócenos</a>
                  <ul>
<?php
$consulta="SELECT ACT, SUB_ACT, COUNT(SUB_ACT) FROM `datos_servicios` WHERE ACT='Conócenos' GROUP BY ACT, SUB_ACT ORDER BY FECHA DESC, SUB_ACT";
$resultado=mysqli_query($conexion,$consulta);
$i=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$act4[$i]=$fila['ACT'];
	$sub_act4[$i]=$fila['SUB_ACT'];
	$i=$i+1;
}
$i=0;
while(isset($act4[$i])==true){
	echo "<li><a href='eventos.php?tipo_de_servicio=$act4[$i]#$sub_act4[$i]'>$sub_act4[$i]</a></li>";
	$i=$i+1;
}
?>
                  </ul>
               </li>
            </ul>
          </nav>
       </td>
    </tr>
</table>
</header>