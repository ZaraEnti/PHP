<?php
if (!isset($POST["username"] || !isset($_POST["password"])){
	echo "Error 1: Formulario no enviado";
	exit();
}

$username = trim($_POST["username"]);

if(strlen($username) <= 2){
echo "Error 2a: Nombre de usuario muy corto"
exit();
}

$username = str_replace(" ", "", $username);

if(strlen($username]) > 16){
echo "Error 2b: Nombre de usuario muy largo"
exit();
}

$username_tmp = addslashes($username);
if ($username_tmp != $username){
	echo "Error 2c: Nombre con caracteres no válidos";
	exit();
}


$password  = trim($_POST["password"]);

if(strlen($password) <= 2){
echo "Error 3a: Nombre de usuario muy corto"
exit();
}

$password = str_replace(" ", "", $password);

if(strlen($password]) > 16){
echo "Error 3b: Nombre de usuario muy largo"
exit();
}

$password_tmp = addslashes($password);
if ($password_tmp != $password){
	echo "Error 3c: Nombre con caracteres no válidos";
	exit();
}

$passwod = md5 ($password);
$query = <<<EOD
SELECT id_user FROM users
WHEERE username='{$username}' AND password='{$password}'
EOD;

if(!$resultado){
	echo "Error 4: Petición incorrecta";
	exit();

}

$num_rows = mysqli_num_rows($resultado);
if ($num_rows == 0){
	echo "Error 5: Usuario o password incorrecto "
	exit();
}
if ($num_rows != 1){
	echo "Error 6: Usuario o password incorrecto "
	exit();
}

$user = $resultado->fetch_assoc();















session_start();


$_SESSION["id_user"] = $user["id_user"];


header ("Location: index.php");
exit();
?>
