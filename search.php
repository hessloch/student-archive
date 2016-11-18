<?php
$search = $_GET['q']; 
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

$searchterms = explode(" ", $search);
$sql = "SELECT * FROM Document WHERE id IN ";
$morethanoneterm = false;
foreach ($searchterms as $term){
	if($morethanoneterm == true){
		$sql = $sql . " AND id IN ";
	}
	$sql = $sql . "(SELECT id FROM Document WHERE class IN (SELECT id FROM Class WHERE name LIKE ?) OR teacher IN (SELECT id FROM Teacher WHERE name LIKE ?) OR semester IN (SELECT id FROM Semester WHERE name LIKE ?) OR doctype IN (SELECT id FROM DocType WHERE name LIKE ?) OR extension IN (SELECT id FROM Extension WHERE name LIKE ?) OR uploader IN (SELECT id FROM Users WHERE name LIKE ?))";
	$morethanoneterm = true;
}

$executeterms = array();
foreach ($searchterms as $term){
	for($i = 0; $i < 6; $i++){
		array_push($executeterms, "%" . $term . "%");
	}
}

$stmt = $pdo->prepare($sql);
$stmt->execute($executeterms);

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

	$sql = "SELECT name FROM Users WHERE id = :id";
	$varstmt = $pdo->prepare($sql);
	$varstmt->execute(['id'=>$row['uploader']]);
	$uploader = $varstmt->fetch(PDO::FETCH_ASSOC)['name'];

	$sql = "SELECT name FROM Extension WHERE id = :id";
	$varstmt = $pdo->prepare($sql);
	$varstmt->execute(['id'=>$row['uploader']]);
	$extension = $varstmt->fetch(PDO::FETCH_ASSOC)['name'];

	$file = $doctype . " " . $row['num'] . "-" . $row['iteration'] . $extension;
 	
	echo	"<a href=\"files/$class/$teacher/$semester/$file\" download>" . 
	$file . "</a>" . "&nbsp;&nbsp;($class/$teacher/$semester) &nbsp;&nbsp;&nbsp;&nbsp; uploaded by $uploader" . "<br/>";

}

$pdo = null;

?>
