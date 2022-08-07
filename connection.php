<?php

function connect(){
	try{
	$host = "mysql:host=localhost;dbname=mydb;charset=utf8";
	$db_user = "root";
	$db_password = "admin";
	$pdo = new PDO($host,$db_user,$db_password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}
?>
