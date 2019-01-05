<?php 

try {
	$db=new PDO("mysql:host=localhost;dbname=isbende;charset=utf8",'root','12345678');
	//echo"basarılı";

} catch (PDOExpection $e) {
	echo $e->getMessage();
}

 ?>