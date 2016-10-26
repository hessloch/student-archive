<?php
$name = $_GET['q'];

$host = '127.0.0.1';
$db = 'studentarchive';
$user = 'andrew';
$pass = 'pass487project';
$charset = 'utf8';

$opt = [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass, $opt);

$sql = "SELECT * FROM Document WHERE class IN (SELECT id FROM Class WHERE name LIKE :name)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $q]);

echo "Hello";
?>
