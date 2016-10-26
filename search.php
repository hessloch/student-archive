<?php
$name = $_GET['q'];
$name = '%' . $name . '%';
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
$stmt->execute(['name' => $name]);

while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{

	$sql = "SELECT name FROM Class WHERE id = :id";
	$varstmt = $pdo->prepare($sql);
	$varstmt->execute(['id'=>$row['class']]);
	$class = $varstmt->fetch(PDO::FETCH_ASSOC)['name'];
	
	$sql = "SELECT name FROM Teacher WHERE id = :id";
	$varstmt = $pdo->prepare($sql);
	$varstmt->execute(['id'=>$row['teacher']]);
	$teacher = $varstmt->fetch(PDO::FETCH_ASSOC)['name'];

	$sql = "SELECT name FROM Semester WHERE id = :id";
	$varstmt = $pdo->prepare($sql);
	$varstmt->execute(['id'=>$row['semester']]);
	$semester = $varstmt->fetch(PDO::FETCH_ASSOC)['name'];

	$sql = "SELECT name FROM DocType WHERE id = :id";
	$varstmt = $pdo->prepare($sql);
	$varstmt->execute(['id'=>$row['doctype']]);
	$doctype = $varstmt->fetch(PDO::FETCH_ASSOC)['name'];

	$file = $doctype . "_" . $row['num'] . "-" . $row['iteration'];
	echo "\\" . $class . "<br/>";
	echo str_repeat('&nbsp;',2) . "\\" . $teacher . "<br/>";
	echo str_repeat('&nbsp;',4) . "\\" . $semester . "<br/>";
	echo str_repeat('&nbsp;', 6) .
	"<a href=\"files/$class/$teacher/$semester/$file\" download>" . 
	$file . "<br/>";

}
$pdo = null;

?>
