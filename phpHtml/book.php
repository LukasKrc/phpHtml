<!doctype html>
<head>
<title>Knyga</title>
</head>
<body>
<?php
	if (isset($_GET['id'])) {
	 	try {
			$db = new PDO('mysql:host=localhost;dbname=Books;charset=utf8;', 'lukas', 'pass');
	  	}	
	  	catch (Exception $e) {
			die('Duomenų bazė nepasiekiama '.$e->getMessage());
	  	}
		$id = $_GET['id'];
		$book = $db->query(
					"SELECT Books.bookId, Books.title, Books.year, Genres.description, GROUP_CONCAT(Authors.name) as authors
					FROM Books
					LEFT JOIN BookAuthors
					ON Books.bookId = BookAuthors.bookId
					LEFT JOIN Authors
					ON BookAuthors.authorId = Authors.authorId
					LEFT JOIN Genres
					ON Books.genreId = Genres.genreId WHERE Books.bookId = $id GROUP BY Books.bookId;"
		)->fetch(PDO::FETCH_ASSOC);
	} else {
		die('Nepateiktas knygos id');
	}

?>
<h1><?php echo $book['title']; ?></h1>
Autorius (-iai): <?php echo $book['authors']; ?><br/>
Leidimo metai: <?php echo $book['year']; ?><br/>
Žanras: <?php echo $book['description']; ?><br/>
</body>
