<?php
try
{
	$bdd=new PDO('mysql:host=localhost;dbname=projetgbaf;charset=utf8','root','');
	array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
die('erreur:'.$e->getMessage());
}

?>

