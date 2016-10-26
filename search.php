<?php
$name = $_GET['q'];
$name = '%' + $name '%';

$host = '127.0.0.1';
$db = 'test';
$user = 'root';
$pass = 'pass487project';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
	PDO:ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATR_EMULATE_PREPARES => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);

$sql = "SELECT * FROM Document WHERE class IN (SELECT id FROM Class WHERE name LIKE :name)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $q]);
