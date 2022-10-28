<?php
session_start();
if(!isset($_SESSION["usuario_adm"])){header("location:Salir.php");}
//conexion
require ("conexion.php");
//RESCATANDO EL USUARIO Y OBTENIENDO FOTO
$user=$_SESSION["usuario_adm"];
$consulta="SELECT FOTO, NOMBRE, APELLIDO FROM `datos_usuarios` WHERE AUTOR_CORREO='$user'";
$resultado=mysqli_query($conexion,$consulta);
$fila=mysqli_fetch_array($resultado);
$foto=$fila['FOTO'];
$autor_nombre=$fila['NOMBRE'];
$autor_apellido=$fila['APELLIDO'];

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Fundación Crystal - RUD/Update Articulo</title>
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

<section>
<?php
//rescatando datos del formulario
$titulo=htmlentities(addslashes($_POST['titulo']));
	// VALIDANDO TITULO DE MENOS DE 150 CARACTERES
	if(strlen($titulo)>150){
		$ver_tit_long="error";
	}else{
		$ver_tit_long="ok";
	}
//continua rescatando datos del formulario
$categoria=htmlentities(addslashes($_POST['categoria']));
$i=1;
$e=0;
while($i<=20){
	if($_FILES['imagen_' . $i]['name']<>true){
		$img_name[$e]=$_POST['nombre_imagen_' . $i];
		$img_type[$e]='';
		$img_size[$e]=0;
		$ruta_temporal[$e]='';
		$ruta_destino[$e]='';
		$ver_img_type[$e]="ok";
		$ver_img_size[$e]="ok";
	}else{
		$img_name[$e]=$_FILES['imagen_' . $i]['name'];
		$img_type[$e]=$_FILES['imagen_' . $i]['type'];
		$img_size[$e]=$_FILES['imagen_' . $i]['size'];
		$ruta_temporal[$e]=$_FILES['imagen_' . $i]["tmp_name"];
		$ruta_destino[$e]=$_SERVER['DOCUMENT_ROOT'] . '/FUNDACRYSTAL/IMAGENES/' . $img_name[$e];
		//VERIFICANDO DUPLICIDAD DE NOMBRE DE LA IMAGEN Y CAMBIANDOLO DE SER NECESARIO
		$o=1;
		while(file_exists($ruta_destino[$e])==true){
			$img_name[$e]=$o . $img_name[$e];
			$ruta_destino[$e]=$_SERVER['DOCUMENT_ROOT'] . '/FUNDACRYSTAL/IMAGENES/' .  $img_name[$e];
			$o=$o+1;
		}
		//VERIFICANDO TIPO DE IMAGEN
		if($img_type[$e]=='image/jpeg' or $img_type[$e]=='image/jpg' or $img_type[$e]=='image/png' or $img_type[$e]=='image/gif'){$ver_img_type[$e]="ok";}else{$ver_img_type[$e]="error";}
		//VERIFICANDO TAMAÑO DE IMAGEN
		if($img_size[$e]>2000000){$ver_img_size[$e]="error";}else{$ver_img_size[$e]="ok";}
	}
	//VERIFICANDO SUB-TITULOS
	if($_POST['subtitulo_' . $i]<>true){
		$subtitulos[$e]='';
	}else{
		$subtitulos[$e]=htmlentities(addslashes($_POST['subtitulo_' . $i]));
	}
	if(strlen($subtitulos[$e])>150){
		$ver_subtit_long[$e]="error";
	}else{
		$ver_subtit_long[$e]="ok";
	}
	//VERIFICANDO PÁRRAFOS
	if($_POST['parrafo_' . $i]<>true){
		$parrafos[$e]='';
	}else{
		$parrafos[$e]=htmlentities(addslashes($_POST['parrafo_' . $i]));
	}
	if(strlen($parrafos[$e])<400 and $parrafos[$e]<>''){
		$ver_parr_long[$e]="error";
	}else{
		$ver_parr_long[$e]="ok";
	}
	$i=$i+1;
	$e=$e+1;
}

//DEFINIENDO AÑO, MES Y FECHA ACTUAL
$ano_actual=date("Y");
$mes_actual=date("m");
$fecha_y_m_d=date("Y-m-d");
//VERIFICANDO QUE TODOS LOS DATOS ESTÁN CORRECTOS
if($ver_tit_long=='ok' and $ver_img_type[0]=='ok' and $ver_img_type[1]=='ok' and $ver_img_type[2]=='ok' and $ver_img_type[3]=='ok' and $ver_img_type[4]=='ok' and $ver_img_type[5]=='ok' and $ver_img_type[6]=='ok' and $ver_img_type[7]=='ok' and $ver_img_type[8]=='ok' and $ver_img_type[9]=='ok' and $ver_img_type[10]=='ok' and $ver_img_type[11]=='ok' and $ver_img_type[12]=='ok' and $ver_img_type[13]=='ok' and $ver_img_type[14]=='ok' and $ver_img_type[15]=='ok' and $ver_img_type[16]=='ok' and $ver_img_type[17]=='ok' and $ver_img_type[18]=='ok' and $ver_img_type[19]=='ok' and $ver_img_size[0]=='ok' and $ver_img_size[1]=='ok' and $ver_img_size[2]=='ok' and $ver_img_size[3]=='ok' and $ver_img_size[4]=='ok' and $ver_img_size[5]=='ok' and $ver_img_size[6]=='ok' and $ver_img_size[7]=='ok' and $ver_img_size[8]=='ok' and $ver_img_size[9]=='ok' and $ver_img_size[10]=='ok' and $ver_img_size[11]=='ok' and $ver_img_size[12]=='ok' and $ver_img_size[13]=='ok' and $ver_img_size[14]=='ok' and $ver_img_size[15]=='ok' and $ver_img_size[16]=='ok' and $ver_img_size[17]=='ok' and $ver_img_size[18]=='ok' and $ver_img_size[19]=='ok' and $ver_subtit_long[0]=='ok' and $ver_subtit_long[1]=='ok' and $ver_subtit_long[2]=='ok' and $ver_subtit_long[3]=='ok' and $ver_subtit_long[4]=='ok' and $ver_subtit_long[5]=='ok' and $ver_subtit_long[6]=='ok' and $ver_subtit_long[7]=='ok' and $ver_subtit_long[8]=='ok' and $ver_subtit_long[9]=='ok' and $ver_subtit_long[10]=='ok' and $ver_subtit_long[11]=='ok' and $ver_subtit_long[12]=='ok' and $ver_subtit_long[13]=='ok' and $ver_subtit_long[14]=='ok' and $ver_subtit_long[15]=='ok' and $ver_subtit_long[16]=='ok' and $ver_subtit_long[17]=='ok' and $ver_subtit_long[18]=='ok' and $ver_subtit_long[19]=='ok' and $ver_parr_long[0]=='ok' and $ver_parr_long[1]=='ok' and $ver_parr_long[2]=='ok' and $ver_parr_long[3]=='ok' and $ver_parr_long[4]=='ok' and $ver_parr_long[5]=='ok' and $ver_parr_long[6]=='ok' and $ver_parr_long[7]=='ok' and $ver_parr_long[8]=='ok' and $ver_parr_long[9]=='ok' and $ver_parr_long[10]=='ok' and $ver_parr_long[11]=='ok' and $ver_parr_long[12]=='ok' and $ver_parr_long[13]=='ok' and $ver_parr_long[14]=='ok' and $ver_parr_long[15]=='ok' and $ver_parr_long[16]=='ok' and $ver_parr_long[17]=='ok' and $ver_parr_long[18]=='ok' and $ver_parr_long[19]=='ok'){
	//MOVIENDO IMAGENES A LA CARPETA DE IMAGENES DEL PROYECTO
	$e=0;
	while($e<20){
		if($ruta_destino[$e]==''){
		}else{
			move_uploaded_file($ruta_temporal[$e],$ruta_destino[$e]);
		}
		$e=$e+1;
	}
	// COLOCANDO LOS DATOS DEL ARTICULO A MODIFICAR
	$i=1;
	$e=0;
	while($i<=20){
		$consulta="UPDATE `datos_articulos` SET 
		FOTO_$i='$img_name[$e]',
		SUB_TITULO_$i='$subtitulos[$e]',
		PARRAFO_$i='$parrafos[$e]',
		ART_ANO='$ano_actual',
		ART_MES='$mes_actual',
		ART_FECHA='$fecha_y_m_d',
		CATEGORIA='$categoria',
		AUTOR_CORREO='$user'
		WHERE ART_TITULO='$titulo';";
		$resultado=mysqli_query($conexion,$consulta);
			
		//MOVIENDO IMAGEN A LA CARPETA DE IMAGENES DEL PROYECTO
		move_uploaded_file($ruta_temporal[$e],$ruta_destino[$e]);		

		$i=$i+1;
		$e=$e+1;
	}
	
	echo "<table style='border: solid #333 1px; width:40%; margin:auto; background-color:#dfdfdf;'>
		<tr style='border: solid #333 1px;'>
			<td style='border: solid #333 1px; width:15%; text-align:center; padding:5px; background-color:#FFF; color:#F00;'>
				El Artículo fue Modificado exitosamente:
			</td>
		</tr>
		</table>";

	//CREANDO ARRAY DE ESTILO PARA LAS IMÁGENES
	$posicion[0]='float:left; width:30%; margin:1%;';
	$posicion[1]='float:right; width:30%; margin:1%;';
	$posicion[2]='float:left; width:30%; margin:1%;';
	//OBTENIENDO DATOS DEL ARTICULO
	$sql_total1="SELECT 
				`datos_articulos`.ART_FECHA AS FECHA,
				`datos_usuarios`.NOMBRE AS NOMBRE,
				`datos_usuarios`.APELLIDO AS APELLIDO,
				`datos_articulos`.CATEGORIA AS CATEGORIA,
				`datos_articulos`.ART_TITULO AS ART_TITULO,
				`datos_articulos`.VISITAS AS VISITAS,
				`datos_articulos`.ME_GUSTA AS ME_GUSTA,
				`datos_articulos`.FOTO_1 AS FOTO_1,
				`datos_articulos`.SUB_TITULO_1 AS SUB_TITULO_1,
				`datos_articulos`.PARRAFO_1 AS PARRAFO_1,
				`datos_articulos`.FOTO_2 AS FOTO_2,
				`datos_articulos`.SUB_TITULO_2 AS SUB_TITULO_2,
				`datos_articulos`.PARRAFO_2 AS PARRAFO_2,
				`datos_articulos`.FOTO_3 AS FOTO_3,
				`datos_articulos`.SUB_TITULO_3 AS SUB_TITULO_3,
				`datos_articulos`.PARRAFO_3 AS PARRAFO_3,
				`datos_articulos`.FOTO_4 AS FOTO_4,
				`datos_articulos`.SUB_TITULO_4 AS SUB_TITULO_4,
				`datos_articulos`.PARRAFO_4 AS PARRAFO_4,
				`datos_articulos`.FOTO_5 AS FOTO_5,
				`datos_articulos`.SUB_TITULO_5 AS SUB_TITULO_5,
				`datos_articulos`.PARRAFO_5 AS PARRAFO_5,
				`datos_articulos`.FOTO_6 AS FOTO_6,
				`datos_articulos`.SUB_TITULO_6 AS SUB_TITULO_6,
				`datos_articulos`.PARRAFO_6 AS PARRAFO_6,
				`datos_articulos`.FOTO_7 AS FOTO_7,
				`datos_articulos`.SUB_TITULO_7 AS SUB_TITULO_7,
				`datos_articulos`.PARRAFO_7 AS PARRAFO_7,
				`datos_articulos`.FOTO_8 AS FOTO_8,
				`datos_articulos`.SUB_TITULO_8 AS SUB_TITULO_8,
				`datos_articulos`.PARRAFO_8 AS PARRAFO_8,
				`datos_articulos`.FOTO_9 AS FOTO_9,
				`datos_articulos`.SUB_TITULO_9 AS SUB_TITULO_9,
				`datos_articulos`.PARRAFO_9 AS PARRAFO_9,
				`datos_articulos`.FOTO_10 AS FOTO_10,
				`datos_articulos`.SUB_TITULO_10 AS SUB_TITULO_10,
				`datos_articulos`.PARRAFO_10 AS PARRAFO_10,
				`datos_articulos`.FOTO_11 AS FOTO_11,
				`datos_articulos`.SUB_TITULO_11 AS SUB_TITULO_11,
				`datos_articulos`.PARRAFO_11 AS PARRAFO_11,
				`datos_articulos`.FOTO_12 AS FOTO_12,
				`datos_articulos`.SUB_TITULO_12 AS SUB_TITULO_12,
				`datos_articulos`.PARRAFO_12 AS PARRAFO_12,
				`datos_articulos`.FOTO_13 AS FOTO_13,
				`datos_articulos`.SUB_TITULO_13 AS SUB_TITULO_13,
				`datos_articulos`.PARRAFO_13 AS PARRAFO_13,
				`datos_articulos`.FOTO_14 AS FOTO_14,
				`datos_articulos`.SUB_TITULO_14 AS SUB_TITULO_14,
				`datos_articulos`.PARRAFO_14 AS PARRAFO_14,
				`datos_articulos`.FOTO_15 AS FOTO_15,
				`datos_articulos`.SUB_TITULO_15 AS SUB_TITULO_15,
				`datos_articulos`.PARRAFO_15 AS PARRAFO_15,
				`datos_articulos`.FOTO_16 AS FOTO_16,
				`datos_articulos`.SUB_TITULO_16 AS SUB_TITULO_16,
				`datos_articulos`.PARRAFO_16 AS PARRAFO_16,
				`datos_articulos`.FOTO_17 AS FOTO_17,
				`datos_articulos`.SUB_TITULO_17 AS SUB_TITULO_17,
				`datos_articulos`.PARRAFO_17 AS PARRAFO_17,
				`datos_articulos`.FOTO_18 AS FOTO_18,
				`datos_articulos`.SUB_TITULO_18 AS SUB_TITULO_18,
				`datos_articulos`.PARRAFO_18 AS PARRAFO_18,
				`datos_articulos`.FOTO_19 AS FOTO_19,
				`datos_articulos`.SUB_TITULO_19 AS SUB_TITULO_19,
				`datos_articulos`.PARRAFO_19 AS PARRAFO_19,
				`datos_articulos`.FOTO_20 AS FOTO_20,
				`datos_articulos`.SUB_TITULO_20 AS SUB_TITULO_20,
				`datos_articulos`.PARRAFO_20 AS PARRAFO_20
				FROM `datos_articulos` INNER JOIN `datos_usuarios` ON `datos_articulos`.AUTOR_CORREO=`datos_usuarios`.AUTOR_CORREO WHERE 
				`datos_articulos`.ART_TITULO = '$titulo'";
	$resultado1=mysqli_query($conexion,$sql_total1);

	//IMPRIMIENDO ARTICULO COMPLETO
	$filas=mysqli_fetch_array($resultado1);

	$art_fec=$filas['FECHA'];
	$art_nom=ucwords(mb_strtolower($filas['NOMBRE'],'UTF-8'));	
	$art_ape=ucwords(mb_strtolower($filas['APELLIDO'],'UTF-8'));	
	$art_cat=ucfirst(mb_strtolower($filas['CATEGORIA'],'UTF-8'));	
	$art_tit=ucfirst(mb_strtolower($filas['ART_TITULO'],'UTF-8'));	
	$art_vis=$filas['VISITAS'];	
	$art_gus=$filas['ME_GUSTA'];	
	$art_subt[0]=ucfirst(mb_strtolower($filas['SUB_TITULO_1'],'UTF-8'));	
	$art_parr[0]=$filas['PARRAFO_1'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[0]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[0]=$reemplazo_enter;
	$art_foto[0]=$filas['FOTO_1'];	
	$art_subt[1]=ucfirst(mb_strtolower($filas['SUB_TITULO_2'],'UTF-8'));	
	$art_parr[1]=$filas['PARRAFO_2'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[1]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[1]=$reemplazo_enter;
	$art_foto[1]=$filas['FOTO_2'];	
	$art_subt[2]=ucfirst(mb_strtolower($filas['SUB_TITULO_3'],'UTF-8'));	
	$art_parr[2]=$filas['PARRAFO_3'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[2]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[2]=$reemplazo_enter;
	$art_foto[2]=$filas['FOTO_3'];	
	$art_subt[3]=ucfirst(mb_strtolower($filas['SUB_TITULO_4'],'UTF-8'));	
	$art_parr[3]=$filas['PARRAFO_4'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[3]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[3]=$reemplazo_enter;
	$art_foto[3]=$filas['FOTO_4'];	
	$art_subt[4]=ucfirst(mb_strtolower($filas['SUB_TITULO_5'],'UTF-8'));	
	$art_parr[4]=$filas['PARRAFO_5'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[4]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[4]=$reemplazo_enter;
	$art_foto[4]=$filas['FOTO_5'];	
	$art_subt[5]=ucfirst(mb_strtolower($filas['SUB_TITULO_6'],'UTF-8'));	
	$art_parr[5]=$filas['PARRAFO_6'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[5]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[5]=$reemplazo_enter;
	$art_foto[5]=$filas['FOTO_6'];	
	$art_subt[6]=ucfirst(mb_strtolower($filas['SUB_TITULO_7'],'UTF-8'));	
	$art_parr[6]=$filas['PARRAFO_7'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[6]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr_7=$reemplazo_enter;
	$art_foto[6]=$filas['FOTO_7'];	
	$art_subt[7]=ucfirst(mb_strtolower($filas['SUB_TITULO_8'],'UTF-8'));	
	$art_parr[7]=$filas['PARRAFO_8'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[7]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[7]=$reemplazo_enter;
	$art_foto[7]=$filas['FOTO_8'];	
	$art_subt[8]=ucfirst(mb_strtolower($filas['SUB_TITULO_9'],'UTF-8'));	
	$art_parr[8]=$filas['PARRAFO_9'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[8]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[8]=$reemplazo_enter;
	$art_foto[8]=$filas['FOTO_9'];	
	$art_subt[9]=ucfirst(mb_strtolower($filas['SUB_TITULO_10'],'UTF-8'));	
	$art_parr[9]=$filas['PARRAFO_10'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[9]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[9]=$reemplazo_enter;
	$art_foto[9]=$filas['FOTO_10'];	
	$art_subt[10]=ucfirst(mb_strtolower($filas['SUB_TITULO_11'],'UTF-8'));	
	$art_parr[10]=$filas['PARRAFO_11'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[10]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[10]=$reemplazo_enter;
	$art_foto[10]=$filas['FOTO_11'];	
	$art_subt[11]=ucfirst(mb_strtolower($filas['SUB_TITULO_12'],'UTF-8'));	
	$art_parr[11]=$filas['PARRAFO_12'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[11]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[11]=$reemplazo_enter;
	$art_foto[11]=$filas['FOTO_12'];	
	$art_subt[12]=ucfirst(mb_strtolower($filas['SUB_TITULO_13'],'UTF-8'));	
	$art_parr[12]=$filas['PARRAFO_13'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[12]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[12]=$reemplazo_enter;
	$art_foto[12]=$filas['FOTO_13'];	
	$art_subt[13]=ucfirst(mb_strtolower($filas['SUB_TITULO_14'],'UTF-8'));	
	$art_parr[13]=$filas['PARRAFO_14'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[13]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[13]=$reemplazo_enter;
	$art_foto[13]=$filas['FOTO_14'];	
	$art_subt[14]=ucfirst(mb_strtolower($filas['SUB_TITULO_15'],'UTF-8'));	
	$art_parr[14]=$filas['PARRAFO_15'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[14]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[14]=$reemplazo_enter;
	$art_foto[14]=$filas['FOTO_15'];	
	$art_subt[15]=ucfirst(mb_strtolower($filas['SUB_TITULO_16'],'UTF-8'));	
	$art_parr[15]=$filas['PARRAFO_16'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[15]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[15]=$reemplazo_enter;
	$art_foto[15]=$filas['FOTO_16'];	
	$art_subt[16]=ucfirst(mb_strtolower($filas['SUB_TITULO_17'],'UTF-8'));	
	$art_parr[16]=$filas['PARRAFO_17'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[16]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[16]=$reemplazo_enter;
	$art_foto[16]=$filas['FOTO_17'];	
	$art_subt[17]=ucfirst(mb_strtolower($filas['SUB_TITULO_18'],'UTF-8'));	
	$art_parr[17]=$filas['PARRAFO_18'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[17]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[17]=$reemplazo_enter;
	$art_foto[17]=$filas['FOTO_18'];	
	$art_subt[18]=ucfirst(mb_strtolower($filas['SUB_TITULO_19'],'UTF-8'));	
	$art_parr[18]=$filas['PARRAFO_19'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[18]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[18]=$reemplazo_enter;
	$art_foto[18]=$filas['FOTO_19'];	
	$art_subt[19]=ucfirst(mb_strtolower($filas['SUB_TITULO_20'],'UTF-8'));	
	$art_parr[19]=$filas['PARRAFO_20'];	
		//REEMPLAZANDO "." Y ":" POR ".<BR>" Y ":<BR>" / Y <BR>MIN POR <BR>MAY
		$reemplazo_enter=str_replace(".",".<br>",$art_parr[19]);
		$reemplazo_enter=str_replace(":",":<br>",$reemplazo_enter);
		$art_parr[19]=$reemplazo_enter;
	$art_foto[19]=$filas['FOTO_20'];	
	echo "<article style='width:95%; margin:auto;'>";
	echo "<div class='articulo_titulo'><h2>$art_tit</h2>";
	echo "<table style='font-size:14px; background-color:#fff;'><td style='text-align:justify; padding-left:0.5%;'>
		  <img width='20px' src='IMAGENES/AUTOR.jpg'/> $art_nom $art_ape
		  <img width='20px' src='IMAGENES/FECHA.jpg'/> $art_fec
		  <img width='20px' src='IMAGENES/CATEGORIA.jpg'/> $art_cat
		  </td></table></div>";
	$cta_2=0;
	while($cta_2<20){
		if($art_foto[$cta_2]==true){
		$e=rand(0,2);
		echo "<figure class='div-img hidden' style='$posicion[$e]'><img class='img' src='IMAGENES/$art_foto[$cta_2]'/></figure>";}else{}
		if($art_subt[$cta_2]==true){
		echo "<h3>$art_subt[$cta_2]</h3>";}else{}
		if($art_parr[$cta_2]==true){
		echo "<p>$art_parr[$cta_2]</p>";}else{}
		$cta_2=$cta_2+1;
	}
	echo "</article>";

}else{

	echo "<form action='rud_update_articulo.php' method='post' enctype='multipart/form-data'>
		<table style='border: solid #333 1px; width:97%; margin:auto; background-color:#dfdfdf;'>
		<tr style='border: solid #333 1px;'>
			<td colspan='4' style='border: solid #333 1px; width:15%; text-align:justify; padding:5px; background-color:#FFF; color:#F00;'>
		";
		//AQUI VA EL COMENTARIO DE ERROR
		if($ver_tit_long=='error'){echo "<h3>ERROR (TÍTULO MUY LARGO): El Título que escogió es muy Largo, escriba un título con menos de 150 caracteres.</h3>";}else{}
		if($ver_img_type[0]=='error' or $ver_img_type[1]=='error' or $ver_img_type[2]=='error' or $ver_img_type[3]=='error' or $ver_img_type[4]=='error' or $ver_img_type[5]=='error' or $ver_img_type[6]=='error' or $ver_img_type[7]=='error' or $ver_img_type[8]=='error' or $ver_img_type[9]=='error' or $ver_img_type[10]=='error' or $ver_img_type[11]=='error' or $ver_img_type[12]=='error' or $ver_img_type[13]=='error' or $ver_img_type[14]=='error' or $ver_img_type[15]=='error' or $ver_img_type[16]=='error' or $ver_img_type[17]=='error' or $ver_img_type[18]=='error' or $ver_img_type[19]=='error'){
			echo "<h3>ERROR (TIPO DE IMAGEN): Una o varias de las imágenes que intentó subir no presentan el formato admitido (.jpeg, jpg, gif o png) por favor verifique el formato de las imagenes y vuelva a adjuntarlas.</h3>";
			echo "<h4>(Las Imágenes con problemas son: ";
			$u=0;
			$u1=1;
			while($u<20){
				if($ver_img_type[$u]=='error'){echo " $u1 ";}else{}
				$u=$u+1;
				$u1=$u1+1;
			}
			echo ").";
		}else{}
		if($ver_img_size[0]=='error' or $ver_img_size[1]=='error' or $ver_img_size[2]=='error' or $ver_img_size[3]=='error' or $ver_img_size[4]=='error' or $ver_img_size[5]=='error' or $ver_img_size[6]=='error' or $ver_img_size[7]=='error' or $ver_img_size[8]=='error' or $ver_img_size[9]=='error' or $ver_img_size[10]=='error' or $ver_img_size[11]=='error' or $ver_img_size[12]=='error' or $ver_img_size[13]=='error' or $ver_img_size[14]=='error' or $ver_img_size[15]=='error' or $ver_img_size[16]=='error' or $ver_img_size[17]=='error' or $ver_img_size[18]=='error' or $ver_img_size[19]=='error'){echo "<br>ERROR (TAMAÑO DE IMAGEN): Una o varias de las imágenes que intentó subir superan el tamaño admitido (máximo: 2 MegaBytes) por favor verifique el tamaño de las imagenes y vuelva a adjuntarlas.<br>";
			echo "(Las Imágenes con problemas son: ";
			$u=0;
			$u1=1;
			while($u<20){
				if($ver_img_size[$u]=='error'){echo " $u1 ";}else{}
				$u=$u+1;
				$u1=$u1+1;
			}
			echo ").</h4>";
		}else{}
		if($ver_subtit_long[0]=='error' or $ver_subtit_long[1]=='error' or $ver_subtit_long[2]=='error' or $ver_subtit_long[3]=='error' or $ver_subtit_long[4]=='error' or $ver_subtit_long[5]=='error' or $ver_subtit_long[6]=='error' or $ver_subtit_long[7]=='error' or $ver_subtit_long[8]=='error' or $ver_subtit_long[9]=='error' or $ver_subtit_long[10]=='error' or $ver_subtit_long[11]=='error' or $ver_subtit_long[12]=='error' or $ver_subtit_long[13]=='error' or $ver_subtit_long[14]=='error' or $ver_subtit_long[15]=='error' or $ver_subtit_long[16]=='error' or $ver_subtit_long[17]=='error' or $ver_subtit_long[18]=='error' or $ver_subtit_long[19]=='error'){echo "<h3>ERROR (SUBTITULO): Uno o Varios de los Sub-Títulos que ingresó son muy Largos, escriba Sub-Títulos con menos de 150 caracteres.</h3>";
			echo "<h4>(Los Subtítulos con problemas son: ";
			$u=0;
			$u1=1;
			while($u<20){
				if($ver_subtit_long[$u]=='error'){echo " $u1 ";}else{}
				$u=$u+1;
				$u1=$u1+1;
			}
			echo ").</h4>";
		}else{}
		if($ver_parr_long[0]=='error' or $ver_parr_long[1]=='error' or $ver_parr_long[2]=='error' or $ver_parr_long[3]=='error' or $ver_parr_long[4]=='error' or $ver_parr_long[5]=='error' or $ver_parr_long[6]=='error' or $ver_parr_long[7]=='error' or $ver_parr_long[8]=='error' or $ver_parr_long[9]=='error' or $ver_parr_long[10]=='error' or $ver_parr_long[11]=='error' or $ver_parr_long[12]=='error' or $ver_parr_long[13]=='error' or $ver_parr_long[14]=='error' or $ver_parr_long[15]=='error' or $ver_parr_long[16]=='error' or $ver_parr_long[17]=='error' or $ver_parr_long[18]=='error' or $ver_parr_long[19]=='error'){echo "<h3>ERROR (PÁRRAFO): Uno o Varios de los Párrafos que ingresó son muy Cortos, escriba Párrafos con más de 400 caracteres.</h3>";
			echo "<h4>(Los Párrafos con problemas son: ";
			$u=0;
			$u1=1;
			while($u<20){
				if($ver_parr_long[$u]=='error'){echo " $u1 ";}else{}
				$u=$u+1;
				$u1=$u1+1;
			}
			echo ").</h4>";
		}else{}
	echo "
			</td>
		</tr>
		<tr style='border: solid #333 1px;'>
			<td colspan='1' style='border: solid #333 1px; width:15%;'>Título del Artículo:<br>(max: 150 Caracteres)</td>
			<td colspan='2' style='border: solid #333 1px; width:65%;'><textarea name='titulo' rows='1' style='width:98%; background-color:#ffffee;' required>$titulo</textarea></td>
			<td colspan='1' style='border: solid #333 1px; width:20%;'>
				<table style='margin:0px; padding:0px;'>
				<tr>
					<td style='border: solid #333 1px; width:95%;'>Defina una Categoría:</td>
				</tr>
				<tr>
					<td style='border: solid #333 1px; width:95%;'><input type='text' name='categoria' required style='background-color:#ffffee;' value='$categoria'></td>
				</tr>
				</table>
			</td>
		</tr>
	";
	$e=0;
	$i=1;
	echo"
		<tr style='border: solid #333 1px;'>
			<td style='border: solid #333 1px; width:15%;'>Sub-Título $i:<br>(max: 150 Caracteres)</td>
			<td style='border: solid #333 1px; width:45%;'><textarea name='subtitulo_$i' rows='1' style='width:96%; background-color:#ffffee;'>$subtitulos[$e]</textarea></td>
			<td colspan='2' style='border: solid #333 1px; width:40%;'>
			  <table>
				<td><input type='hidden' name='nombre_imagen_$i' value='$img_name[$e]'><img src='IMAGENES/$img_name[$e]' width='80px' height='50px'/></td>
				<td><div style='width:310px; overflow:hidden;'>Modificar Imagen $i<input type='file' name='imagen_$i' value='IMAGENES/$img_name[$e]'></div></td>
			  </table>
			</td>
		</tr>
		<tr style='border: solid #333 1px;'>
			<td colspan='1' style='border: solid #333 1px; width:15%;'>Parrafo $i:<br>(mín: 400 Caracteres)</td>
			<td colspan='3' style='border: solid #333 1px; width:85%;'><textarea name='parrafo_$i' rows='7' style='width:98%; background-color:#ffffee;' required>$parrafos[$e]</textarea></td>
		</tr>
	";
	$e=$e+1;
	$i=$i+1;
	while($i<=20){
		echo"
		<tr style='border: solid #333 1px;'>
			<td style='border: solid #333 1px; width:15%;'>Sub-Título $i:<br>(max: 150 Caracteres)</td>
			<td style='border: solid #333 1px; width:45%;'><textarea name='subtitulo_$i' rows='1' style='width:96%; background-color:#ffffee;'>$subtitulos[$e]</textarea></td>
			<td colspan='2' style='border: solid #333 1px; width:40%;'>
			  <table>
				<td><input type='hidden' name='nombre_imagen_$i' value='$img_name[$e]'><img src='IMAGENES/$img_name[$e]' width='80px' height='50px'/></td>
				<td><div style='width:310px; overflow:hidden;'>Modificar Imagen $i<input type='file' name='imagen_$i' value='IMAGENES/$img_name[$e]'></div></td>
			  </table>
			</td>
		</tr>
		<tr style='border: solid #333 1px;'>
			<td colspan='1' style='border: solid #333 1px; width:15%;'>Parrafo $i:<br>(mín: 400 Caracteres)</td>
			<td colspan='3' style='border: solid #333 1px; width:85%;'><textarea name='parrafo_$i' rows='7' style='width:98%; background-color:#ffffee;'>$parrafos[$e]</textarea></td>
		</tr>
		";
		$e=$e+1;
		$i=$i+1;
	}
	echo "<tr>
		<td colspan='4'><input type='submit' name='subir' value='Modificar Artículo'></td>
		</tr>
		</table>
		</form>
	";
}
?>
</section>
</body>
</html>
<?php
mysqli_close($conexion);
?>