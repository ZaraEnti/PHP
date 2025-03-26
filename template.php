<?php//template.php
//Si no pass el parametro a "open_html()" el titulo por defecto es ENTIhub
function open_html($title = "ENTIhub"){ 
	
	//Comprovación de la sesión
	$session = false;
	if(isset($_SESSION["id_user"])){//Si esta activa la sesión
		$session = true;
	
	}

//Creamos la variable para el logout para destruir la sesión
	$loginout = "";
	if ($session){
		$loginout = "<a href=\"/logout.php\">Logout</a>";//Sesión ativa mostrará Logout
	}else{
		$loginout = "<a href=\"/login.php\">Login</a>";//Sesión inactiva mostrará Login
	}
		
	echo <<<EOD
<!doctype html>
<html>
<head>	
	<title>{$title}</title>
</head>

<body>
	<header>
		<h1><a href="/index.php">ENTIhub</a></h1>
		<nav>
			<ul>
				<li><a href="/index.php">Home</a></li>
				<li><a href="/profile.php">Perfil</a></li>
				<li><a href="/user.php">Usuarios</a></li>
				<li><a href="/dashboard.php">Dashboard</a></li>
				<li><a href="/config.php">Configuración</a></li>
				<li>{$loginout}</li>
			</ul>
		</nav>
	</header>
	<main>
EOD;
//En el medio del main hacemos el cierre close_html() porque si te fijas con </> cerra las etiquetas abiertas.
function close_html() {
echo <<<EOD
	</main>
	<footer>
		<p>Copyright (c) ENTIhub 2025</p>
	</footer>
</body>
</html>
EOD;
}
?>
			
