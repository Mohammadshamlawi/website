<?php

if (
	empty($_POST["name"]) ||
	empty($_POST["username"]) ||
	empty($_POST["email"]) ||
	empty($_POST["number"]) ||
	empty($_POST["password"]) ||
	empty($_POST["confirm_password"]) ||
	empty($_POST["gender"])
) {
	header('Location: register.html');
	exit;
}

if ($_POST["password"] !== $_POST["confirm_password"]) {
	header('Location: register.html');
	exit;
}

$host = 'localhost';
$db_name = 'abu_dayyeh';
$pdo = new PDO("mysql:host=$host;dbname=$db_name", 'root', '');

$s = $pdo->query("SELECT * FROM users WHERE `username` = '" . $_POST["username"] . "'")->fetchAll();

if (!empty($s)) {
	header('Location: register.html');
	exit;
}

$values = "'" . $_POST["name"] . "', '" . $_POST["username"] . "', '" . $_POST["email"] . "', '" . $_POST["number"] . "', '" . $_POST["password"] . "', '" . $_POST["gender"] . "'";
$pdo->exec("INSERT INTO users(`name`,`username`,`email`,`number`,`password`,`gender`) VALUES ($values)");

session_start();

$_SESSION["user"] = $pdo->lastInsertId();

header('Location: home.html');
exit;
