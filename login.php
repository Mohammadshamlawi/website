<?php

if (
	empty($_POST["username"]) ||
	empty($_POST["password"])
) {
	header('Location: index.html');
	exit;
}

$host = 'localhost';
$db_name = 'abu_dayyeh';
$pdo = new PDO("mysql:host=$host;dbname=$db_name", 'root', '');
$s = $pdo->query("SELECT * FROM users WHERE `username` = '" . $_POST["username"] . "'")->fetchAll();

if (!empty($s) && $s[0]["password"] === $_POST["password"]) {
	header('Location: home.html');
	exit;
}

$_SESSION["user"] = $s[0]["id"];

header('Location: index.html');
exit;
