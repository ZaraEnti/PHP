<?php

#Primero: Evitar que envien formulario vacio.
if (!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["birthdate"]) || !isset($_POST["password"]) || !isset($_POST["repassword"])){
	echo "Error 1: Formulario no enviado";
	exit();
}

#username
$username = trim($_POST["username"]);

if (strlen($username) <= 2) {
	echo "Error 2a: Nombre de usuario muy corto"; 
	exit();
}

$username = str_replace(" ","", $username); 

if (strlen($username) > 16) {
	echo "Error 2b: Nombre de usuario muy largo"; 
	exit();
}

$username_tmp = addslashes($username);

if ($username_tmp !== $username){
	echo "Error 2c: Nombre con caracters no válidos";
	exit();
}
$username = $username_tmp

#email

$email = trim($_POST["email"]);

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (strlen($email) > 32) {
	echo "Error: Email demasiado largo"; 
	exit();
}

$email_safe = addslashes($email);

if ($email_safe !== $email) {
	echo "Error: Email con caracteres no validos";
	exit();
}
$email = $email_safe

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo "Error 3b: Email no válido";
	exit ();
}

#birthdate

$birthdate = DateTime::createFromFormat('Y-m-d', $_POST["birthdate"]);


if (!$birthdate) {
	echo "Error 4a: Fecha no válida";
	exit();
}

$today = new DateTime();
$age = $birthdate->diff($today)->y;
if ($age < 18){
	echo "Error 4b: Has de ser mayor de edad";
	exit ();
}

#passoword y repassword

$password = trim($_POST["password"]);
$repassword = trim($_POST["repassword"]);

if (strlen($password) < 4) {
	echo "Error 5a: Password muy corto"; 
	exit();
}

$password = str_replace(" ","", $password); 

if (strlen($password) > 16) {
	echo "Error 5b: Password muy largo"; 
	exit();
}

$password_tmp = addslashes($password);

if ($password_tmp != $password){
	echo "Error 5c: Password con caracters no válidos";
	exit();
}

if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
    echo "Error 5d: La contraseña debe contener al menos una letra y un número";
	    exit();
		}

if ($password !== $repassword) {
	echo "Error 5e: Los passwords no coinciden";
	exit();
}


#Comprobación email y user existentes

$query = <<<EOD
SELECT id_user FROM users
WHERE username = "{$username}"
EOD;

$conn = mysqli_connect("localhost", "admin", "enti", "entihub");

$resultado = mysqli_query($conn, $query);

if (!$resultado) {
	echo "Error 6a: Petición incorrecta"; 
	exit;
}

$num_rows = mysqli_num_rows($resultado);
if ($num_rows != 0) {
	echo "Error 6b: Usuario o email no validos";
	exit();
}

$query = <<<EOD
SELECT id_user FROM users
WHERE email = "{$email}" 
EOD;

$conn = mysqli_connect("localhost", "admin", "enti", "entihub");

$resultado = mysqli_query($conn, $query);

if (!$resultado) {
	echo "Error 6a: Petición incorrecta"; 
	exit;
}

$num_rows = mysqli_num_rows($resultado);
if ($num_rows != 0) {
	echo "Error 6b: Email no válido";
	exit();
}

$password = md5($password);

echo "Registrado"
//aqui iria el insert.
?>

