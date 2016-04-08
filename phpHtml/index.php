<!doctype html>
<head>
	<title>Knygos</title>
	<meta charset="UTF-8">
</head>
<body>
<?php 
 	try {
		$db = new PDO('mysql:host=localhost;dbname=Books;charset=utf8;', 'lukas', 'pass');
  	}	
  	catch (Exception $e) {
		die('Duomenų bazė nepasiekiama '.$e->getMessage());
  	}

	$books = $db->query(
				"SELECT Books.bookId, Books.title
				FROM Books;"
	);
?>

<?php foreach ($books as $book): ?>
	<a href="book.php?id=<?php echo $book['bookId']; ?>"><h4><?php echo $book['title']; ?></h4></a>
	<hr/>	
<?php endforeach; ?>
</body>
