<?php

//Iniciar la session
session_start();
require_once("template.php"); // Suponiendo que esta es la página que contiene las funciones open_html() y close_html()

// Verificar si el usuario está logueado
if (!isset($_SESSION["id_user"])) {//Si no activa la session
    // Redirigir al usuario si no está logueado
    header("Location: /login.php");
    exit();
}

// Obtener la id sesion del usuario logueado
$user_profile ="" ;

// Conectar a la base de datos
require_once("db_conf.php");
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_db);


// Consulta para obtener los datos del usuario
$query = <<<EOD
SELECT
	name,
	username, 
	email,
	birthday,
	FROM users 
	WHERE username = '$username_profile';
EOD;

// Ejecutar la consulta
$resultado = mysqli_query($conn, $query);

// Verificar si el usuario existe en la base de datos
if (!$resultado) {
    echo "No se encontró el perfil de usuario.";
    exit();
}

// Cerrar la conexión
mysqli_close($conn);

// Abrir la página HTML
open_html("Perfil de $user_profile");


<<<EOD
<main>
    <section>
        <h2>Mi Perfil</h2>
        <p><strong>Usuario:</strong> <?php echo htmlspecialchars($user_data['username']); ?></p>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($user_data['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['email']); ?></p>
        

        <a href="/edit_profile.php">Editar perfil</a>
    </section>
</main>

EOD;
// Cerrar la página HTML
close_html();
?>
