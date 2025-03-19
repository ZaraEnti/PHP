<?php 
require_once("template.php");

//como que tenemos temple indicando de que le pasamos un parametro title si escribimos tendremos la pestaña del navegador Login y registro de usuarios si no le ponemos por defecto es ENTIhub.
open_html("Login y registro de usuarios");
echo <<<EOD
<form method="POST" action="login_check.php">
<h2>Login</h2>

<p><label for="username=login">Usuario:</label>
<input type="text" id="username=login" name="username" /></p>

<p><label for="password=login">Password:</label>
<input type="password" id="password=login" name="password" /></p>

<p><input type="submit" value="Entrar" /></p>
</form>


<form method="POST" action="register_check.php">
<h2>Register</h2>

<p><label for="name=register">Nombre:</label>
<input type="text" id="name=register" name="name" /></p>

<p><label for="username=register">Usuario:</label>
<input type="text" id="username=register" name="username" /></p>

<p><label for="email=register">Email:</label>
<input type="text" id="email=register" name="email" /></p>

<p><label for="birth=register">Fecha de nacimiento:</label>
<input type="date" id="birth=register" name="birthdate" /></p>

<p><label for="password=register">Password:</label>
<input type="password" id="password=register" name="password" /></p>

<p><label for="repassword=register">Repeat password:</label>
<input type="password" id="repassword=register" name="repassword" /></p>

<p><input type="submit" value="Registrarse" /></p>
</form>
EOD;
close_html();

?>
