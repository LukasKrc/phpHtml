<!doctype html>
<head>
	<title>Knygos</title>
	<meta charset="UTF-8">
</head>
<body>
<?php
include 'BooksList.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	try {
		$db = new PDO('mysql:host=localhost;dbname=Books;charset=utf8;', 'lukas', 'pass');
	} catch (Exception $e) {
		die('Duomenų bazė nepasiekiama '.$e->getMessage());
	}
	$books = new BooksList($db);
	$books->loadAll();
?>

<?php foreach ($books as $book): ?>
	<a href="details.php?id=<?php echo $book->getId();; ?>"><h4><?php echo $book->getTitle(); ?></h4></a>
	<hr/>	
<?php endforeach; ?>
</body>
