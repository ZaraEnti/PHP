<?php
//message_check

//primero debemos comprobar la session
session_start();
if(!isset($_SESSION["id_user"])){
	//pues que se logue
	header("Location: login.php");
	exit();
}

if(!isset($_POST["message"])){
	//internamente es un exho exit i puede hacer alguna otra cosa en el sistema (enviar un email)
	die("Error 1: No se ha enviado el mensaje");
}

//más comprovaciones
$msg = trim($_POST["message"]);

if (strlen($msg) <= 0){
	die("Error 2: Mensaje demasiado corto");
}


if (strlen($msg) > 240){
	die("Error 3: Mensaje demasiado largo");
}

$msg = addslashes($msg);

//comprovar de que por lo menos sea un número entero
$id_user = intval($_SESSION["id_user"]);

//a partir de este punto sabremos como hacer la query

//no haria falta el response porque por defecto no esta respondido 0
$query = <<<EOD
INSERT INTO messages (message, post_time, status, id_user)
VALUES ('{$msg}, now(),{$id_user});
EOD;

require_once("db_conf.php");
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_db);

$resultado = mysqli_query($conn, $query);

if(!$resultado){
	die ("Error 3: Query mal formada.");

}
header("Location : index.php");
exit();

?>
