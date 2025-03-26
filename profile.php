<?php
//Iniciar la session
session_start();

require_once("template.php"); // Suponiendo que esta es la página que contiene las funciones open_html() y close_html()

//1.Si sessión va al login--> Verificar si el usuario está logueado
if (!isset($_SESSION["id_user"])) {//Si no activa la session
	
	// Redirigir al usuario si no está logueado
	header("Location: /login.php");
    	exit();
}


//2.Si hay session y quiere comprovar el perfil de usuario
//Obtener la id sesion del usuario logueado
$userame=$_GET["username"];


// Conectar a la base de datos
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_db);


$query = <<<EOD
SELECT 
	id_user,
	FROM users
	WHERE username = 'username'
EOD;

// Ejecutar la consulta
$resultado = mysqli_query($conn, $query);


	if(!isset($query)){
		echo "Error: Usuario no registrado"
	}


$user_id=$query;//Actual sessión

// Ejecutar la consulta
if($_SESSION["id_user"]==$user_id){


// Consulta para obtener los datos del usuario
$query = <<<EOD
SELECT
	name,
	username, 
	email,
	birthday,
	FROM users 
	WHERE username = '$user_id';
EOD;

// Ejecutar la consulta
$resultado = mysqli_query($conn, $query);

// Cerrar la conexión
mysqli_close($conn);
}

if($_SESSION["id_user"]!=$username){
	
	// Consulta para obtener los datos del usuario
$query = <<<EOD
SELECT
	name,
	username, 
	email,
	birthday,
	FROM users 
	WHERE username = '$user_id';
EOD;

// Ejecutar la consulta
$resultado = mysqli_query($conn, $query);

// Cerrar la conexión
mysqli_close($conn);
}

// Abrir la página HTML
open_html("Perfil de $user_profile");


<<<EOD
<main>
    <section>
        <h2>Mi Perfil</h2>
        <p><strong>Usuario:</strong></p>
        <p><strong>Nombre:</strong></p>
        <p><strong>Email:</strong></p>
       
    </section>
</main>

EOD;

// Cerrar la página HTML
close_html();
?>
