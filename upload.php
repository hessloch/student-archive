<?php
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


if(isset($_FILES['uploaded'])){
	$file_upload = $_FILES['uploaded'];
}
if(isset($_POST['class']) && isset($_POST['teacher']) && isset($_POST['semester']) && isset($_POST['doctype']) && isset($_POST['number'])){
	$class = $_POST['class'];
	$teacher = $_POST['teacher'];
	$semester = $_POST['semester'];
	$doctype = $_POST['doctype'];
	$number = $_POST['number'];


	$sql = "SELECT name FROM Class WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':id' => $class]);
	$className = $stmt->fetchColumn();

	$sql = "SELECT name FROM Teacher WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':id' => $teacher]);
	$teacherName = $stmt->fetchColumn();

	$sql = "SELECT name FROM Semester WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':id' => $semester]);
	$semesterName = $stmt->fetchColumn();

	$sql = "SELECT name FROM DocType WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':id' => $doctype]);
	$doctypeName = $stmt->fetchColumn();
}


if(isset($file_upload) && isset($class) && isset($teacher) && isset($semester) && isset($doctype) && isset($number)){
	$finalDir = "files/$className/$teacherName/$semesterName/";	
	$name = $file_upload['name'];
	$name = strtolower($name);
	$suffix = 1;

	preg_match('/^(.*?)(\.\w+)?$/', $name, $matches);

	$extension = isset($matches[2]) ? $matches[2] : '';
	$name = "$doctypeName $number";
	
	while(file_exists("$finalDir$name-$suffix$extension")){
		$suffix = $suffix + 1;
	}
	if(!file_exists("$finalDir")){
		mkdir("$finalDir", 0777, true);
	}
	$name = "$name-$suffix$extension";
	move_uploaded_file($_FILES['uploaded']['tmp_name'], "$finalDir$name");
	$sql = "SELECT id FROM Extension WHERE name LIKE :name";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([':name' => "%$extension%"]);
	$extension = $stmt->fetchColumn();

	$sql = "INSERT INTO Document (num, iteration, class, teacher, semester, doctype, extension, uploader) VALUES (:num, :iteration, :class, :teacher, :semester, :doctype, :extension, :uploader)";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(
		[':num' => $number,
		':iteration' => $suffix,
		':class' => $class,
		':teacher' => $teacher,
		':semester' => $semester,
		':doctype' => $doctype,
		':extension' => $extension,
		':uploader' => 1]);
}


$sql = "SELECT * FROM Class";
$stmt = $pdo->prepare($sql);
$stmt->execute();

echo "<form method='POST' enctype='multipart/form-data' action='upload.php'>";
echo "<select name='class'>";
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
}
echo "</select>";
$sql = "SELECT * FROM Teacher";
$stmt = $pdo->prepare($sql);
$stmt->execute();
echo "<select name='teacher'>";
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
}
echo "</select>";
$sql = "SELECT * FROM Semester";
$stmt = $pdo->prepare($sql);
$stmt->execute();
echo "<select name='semester'>";
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
}
echo "</select>";
$sql = "SELECT * FROM DocType";
$stmt = $pdo->prepare($sql);
$stmt->execute();
echo "<select name='doctype'>";
while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
	echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
}
echo "</select>";
echo "<select name='number'>";
$i = 1;
while($i < 30){
	echo "<option value=\"$i\">$i</option>";
	$i = $i + 1;
}
echo "</select>";
echo "<input type='file' name='uploaded'>";
echo "<br/>";
echo "<input type='submit' name='submit' value='Upload'>";
echo "</form>";
echo "<p>Can't find what the appropriate fields? Look <a href=uploadnew.php>here</a></p>";
?>
