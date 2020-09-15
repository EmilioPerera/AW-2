<?php

		$host 		= 'localhost';
		$db			= 'aw-examen';
		$username 	= 'root';
		$password 	= '';
		$charset 	= 'utf8mb4';

	try{
		$conn = new PDO("mysql:host=$host;dbname=$db;charset=$charset;", $username, $password);
	} catch (PDOException $e){
		die('Connection Failed: ' . $e->getMessage());
	}

?>