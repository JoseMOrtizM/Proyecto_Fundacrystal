<?php
	$login=htmlentities(addslashes($_POST["nombre_usuario"]));
	$password=htmlentities(addslashes($_POST["contrasena"]));
	require ("conexion.php");
	$consulta="SELECT NIVEL_ACCESO FROM `datos_usuarios` WHERE AUTOR_CORREO='$login' AND CONTRASENA='$password'";
	$resultados=mysqli_query($conexion,$consulta);
	$cuenta=0;
	while(($fila=mysqli_fetch_array($resultados))==true){
		$nivel_acceso=$fila["NIVEL_ACCESO"];
		$cuenta=1;
	}
	if($cuenta==1 and $nivel_acceso=='ESCRITOR'){
		session_start();// iniciando sesion de usuario ESCRITURA
		$_SESSION["usuario_write"]=$login;
		header("location:zona_adm.php");
	}else{if($cuenta==1 and $nivel_acceso=='ADMINISTRADOR'){
		session_start();// iniciando sesion de usuario ADMINISTRADOR
		$_SESSION["usuario_adm"]=$login;
		header("location:zona_adm.php");
	}else{if($cuenta==1 and $nivel_acceso=='DESABILITADO'){
		session_start();// iniciando sesion de usuario DESABILITADO
		$_SESSION["usuario_desabilitado"]=$login;
		header("location:zona_adm.php");
	}else{
		header("location:index.php");
	}}}
	mysqli_close($conexion);
?>