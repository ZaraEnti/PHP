<?php
//hay una session entonces cargo las variables. si no hay un estar no sabe que session destruir. cargar la sesion
session_start();

//tanto como servir como el cliente ya no ahy session entonces sale.
session_destroy();

//en muchas paginas hay idex.php?logout=true" .$name $name = "manolo"
header("Location: index.php");

exit();

?>
