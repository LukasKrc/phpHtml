<!doctype html>
<head>
    <title>Knyga</title>
</head>
<body>
<?php
include 'BooksRepository.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $booksRepository = new BooksRepository();
    $book = $booksRepository->getById($id);
} else {
    die('Nepateiktas knygos id');
}

?>
<h1><?php echo $book->getTitle(); ?></h1>
Autorius (-iai): <?php echo $book->getAuthors(); ?><br/>
Leidimo metai: <?php echo $book->getYear(); ?><br/>
Žanras: <?php echo $book->getGenre(); ?><br/>
</body>