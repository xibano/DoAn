<?php

try {
	$pdo = new PDO('mysql:host=localhost;dbname=qtdl', 'root', '123456789');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	
	exit();
}
