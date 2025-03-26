<?php
$status=$_GET["stauts"];

//manera doble
if(!isset("status"){
	echo "Error: el usuario tiene estado"	
}

if(isset("status")=='3')){
<<<EOD
UPDATE users SET status=3
WHERE id_message='$id_message';
EOD;
}

if(isset("status")=='1')){
<<<EOD
UPDATE users SET status=3
WHERE id_message='$id_message';
EOD;
}
?>

