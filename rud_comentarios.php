<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO EL USUARIO Y OBTENIENDO FOTO
$user=$_SESSION["usuario_adm"];
$consulta="SELECT FOTO FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
//INICIO DEL PAGINADO
$registros_filtrados=20;
if(isset($_GET["pagina"])){
	if($_GET["pagina"]==1){
		?><META HTTP-EQUIV="Refresh" CONTENT="0; URL=rud_comentarios.php"><?php
		//header("location:rud_comentarios.php");
	}else{
		$pagina=$_GET["pagina"];
	}
}else{
	$pagina=1;
}
$empesar_desde=($pagina-1)*$registros_filtrados;
$sql_total="SELECT ID FROM `datos_comentarios`";
$resultado=mysqli_query($conexion,$sql_total);
$numero_filas=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$numero_filas=$numero_filas+1;
}
$total_paginas=ceil($numero_filas/$registros_filtrados);

//DATOS A IMPRIMIR EN EL FORMULARIO
$consulta="SELECT `datos_comentarios`.ID AS ID, `datos_comentarios`.NOMBRE AS NOMBRE_COMENTARISTA, `datos_comentarios`.CORREO AS CORREO_COMENTARISTA, `datos_comentarios`.ART_TITULO AS ARTICULO, `datos_comentarios`.FECHA AS FECHA_COMENTARIO, `datos_comentarios`.LEIDO AS LEIDO, `datos_comentarios`.COMENTARIO AS COMENTARIO, `datos_usuarios`.NOMBRE AS NOMBRE_AUTOR, `datos_usuarios`.APELLIDO AS APELLIDO_AUTOR, `datos_articulos`.ART_FECHA AS FECHA_ARTICULO FROM `datos_comentarios` INNER JOIN `datos_articulos` ON `datos_comentarios`.ART_TITULO = `datos_articulos`.ART_TITULO INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO = `datos_usuarios`.AUTOR_CORREO ORDER BY NOMBRE_AUTOR ASC, APELLIDO_AUTOR ASC, ARTICULO ASC, FECHA_COMENTARIO ASC LIMIT $empesar_desde,$registros_filtrados";
$resultado=mysqli_query($conexion,$consulta);
$i=0;
while(($fila=mysqli_fetch_array($resultado))==true){
	$id[$i]=$fila['ID'];
	$nombre_comentarista[$i]=$fila['NOMBRE_COMENTARISTA'];
	$correo_comentarista[$i]=$fila['CORREO_COMENTARISTA'];
	$articulo[$i]=$fila['ARTICULO'];
	$fecha_comentario[$i]=$fila['FECHA_COMENTARIO'];
	$comentario[$i]=$fila['COMENTARIO'];
	$nombre_autor[$i]=$fila['NOMBRE_AUTOR'];
	$apellido_autor[$i]=$fila['APELLIDO_AUTOR'];
	$leido[$i]=$fila['LEIDO'];
	$i=$i+1;
}

?>

<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - RUT Comentarios</title>
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
<section style="width:98%; margin:auto; background-color:#ddd; border:#4fa7d7 8px ridge;">
    <table>
        <tr>
            <td colspan='5' style='border:#000 1px solid; font-size:30px;'>Estos son los comentarios que han realizado hasta ahora:</td>
        </tr>
            <?php
            $e=0;
			if(isset($nombre_autor[$e])){
			echo "<tr><td colspan='5' style='border:#000 1px solid; background-color:#FFF;' class='articulo_titulo'><h3 style='text-align:center;'>Autor: $nombre_autor[$e] $apellido_autor[$e] / Artículo: $articulo[$e]</h3></td></tr><tr><td style='border:#000 1px solid;'>Comentarista</td><td style='border:#000 1px solid;'>Comentario</td><td colspan='3' style='border:#000 1px solid;'>Acciones</td></tr>";
			}else{}
            while($e<$i){
				if($e>0){
					$o=$e-1;
					if($articulo[$e]<>$articulo[$o]){
						echo "<tr><td colspan='5' style='border:#000 1px solid; background-color:#FFF;' class='articulo_titulo'><h3 style='text-align:center;'>Autor: $nombre_autor[$e] $apellido_autor[$e] / Artículo: $articulo[$e]</h3></td></tr><tr><td style='border:#000 1px solid;'>Comentarista</td><td style='border:#000 1px solid;'>Comentario</td><td colspan='3' style='border:#000 1px solid;'>Acciones</td></tr>";
					}
				}
                echo "<tr>";
				if($leido[$e]=='SI'){
					echo "<td style='border:#000 1px solid; width:15%; background-color:#999; text-align:justify;'>$nombre_comentarista[$e]</td>";
					echo "<td style='border:#000 1px solid; width:69%; background-color:#999; text-align:justify;'>$comentario[$e]</td>";
                	echo "<td style='border:#000 1px solid; width:10%;'><form action='rud_marcar_no_leido.php' method='post'><input type='hidden' name='id' value='$id[$e]'><input type='hidden' name='pagina' value='$pagina'><input type='submit' name='leido' style='background-color:#f88;' value='Marcar como No Leido'></form></td>";
				}else{
					echo "<td style='border:#000 1px solid; width:15%; background-color:#FFF; text-align:justify;'>$nombre_comentarista[$e]</td>";
					echo "<td style='border:#000 1px solid; width:69%; background-color:#FFF; text-align:justify;'>$comentario[$e]</td>";
					echo "<td style='border:#000 1px solid; width:10%;'><form action='rud_marcar_leido.php' method='post'><input type='hidden' name='id' value='$id[$e]'><input type='hidden' name='pagina' value='$pagina'><input type='submit' name='leido' style='background-color:#8f8;' value='Marcar como Leido'></form></td>";
				}
                echo "<td style='border:#000 1px solid; width:8%;'><form action='rud_responder_comentario.php' method='post'><input type='hidden' name='id' value='$id[$e]'><input type='hidden' name='pagina' value='$pagina'><input type='submit' name='responder' value='Responder'></form></td>";
                echo "<td style='border:#000 1px solid; width:8%;'><form action='delete_rud_comentarios.php' method='post'><input type='hidden' name='id' value='$id[$e]'><input type='submit' name='borrar' value='Borrar'></form></td>";
                echo "</tr>";
                $e=$e+1;
            }
            ?>
    	<!--PAGINACIÓN-->
        <tr>
        <td colspan='5'>
        <?php
        echo "Páginas disponibles:  ";
        for($i=1; $i<=$total_paginas; $i++){
            echo "<a href='?pagina=" . $i . "'>" . $i . "</a> ";
        }
        echo "<br>Esta es la Página: $pagina (Se Muestran: $registros_filtrados Comentarios por Página / de un total de $numero_filas Comentarios).";
        ?>
        </td>
    
    </table>
</section>

</body>
</html>

<?php
mysqli_close($conexion);
?>