<?php

//para mostrar los mensajes escritos que presenta en la base de datos
function write_message ($message_info){
	echo <<<EOD
<section class="message">
<h3><a href="profile.php?user={$message_info["username"]}">{$message_info["name"]}</a></h3>
<p class="message-text">{$message_info["message"]}</p>
<p class="message-date">{$message_info["post-time"]}</p>
</section>
EOD;
}
//iniciar la sesión en todas las páginas pero no debemos poner esta función en el template
session_start();

//el modelo que hemos creado previamente open_html() close_html() para utilizarlos en nuestras paginas
require_once("template.php");

//por defecto session es false
$session = false;


//comprovación de que si esta inicializado la sessión
if (isset($_SESSION["id_user"])){
	$session = true;
}

open_html();
//informacion para el usuario
if(isset ($_GET["logout"])){
	$user_prev = addslashes($_GET["logout"]);
	echo <<<EOD
	<p id="\"logout_msg\""><strong>Session de usuario {$user_prev} cerrada </strong></p>
	EOD;
}

//session
if ($session) {
	echo <<<EOD
<aside id="message_form">
	<h2>¿Qué está ocurriendo?</h2>	
	<form method="POST" action="message_check.php">
		<p><textarea placeholder="Introduce tu mensaje" name="message"></textarea></p>
		<p><input type="submit" value="Envia mensaje" /></p>
	</form>
</aside>
EOD;
}
else{
	echo <<<EOD
<aside>
	<p><a href="login.php">Identifícate o regístrate para interactuar</a></p>
</aside>
EOD;

}
echo <<<EOD
<section id="message-block">
	<h2>Lo que dice la gente...</h2>

EOD;
// hay una separacion

require_once("db_conf.php");
$conn = mysqli_connect($db_server,$db_pass, $db_db);

//query para que muestre todos los mensajes de los usuarios
$query = <<<EOD
SELECT *
	users.username,
	users.name,
	messages.message,
	messages.post_time
FROM
	users
INNER JOIN
	messasges
ON
	users.id_user=messages.id_user
WHERE
	users.status='1';
ORDER BY
	messages.post_time DESC
EOD;

$resultado = mysqli_query($conn, $query);

if (!$resultado){
	echo "Error al leer el feed de mensajes";
	echo <<<EOD
</section>	
EOD;
	close_html();
	exit();

}
while ($msg = $resultado->fetch_assoc()){
	write_message($msg);
}

echo <<<EOD
</section>
EOD;
?>
			
