<?php

echo "hola";
$con = mysqli_connect("127.0.0.1", "admin", "enti", "entihub");

$query = "SELECT * FROM users WHERE username='".$_GET["username"]."'";
$resultado = mysqli_query($con, $query)

if(!$resultado){
	echo "Error: Query mal formada";
	exit();

}
while ($user = $resultado->fetch_assoc()){
	echo "<h1>".$user["name"]."<h1>";
	echo "<p>".$user["username"]."<p>";
	echo "<p>".$user["email"]."<p>";
	echo "<p>".$user["password"]."<p>";
	echo "<p>".$user["status"]."<p>";
}

?>
