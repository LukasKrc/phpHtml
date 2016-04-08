<!doctype html>
<head>
    <title>Knyga</title>
</head>
<body>
<?php
include 'Book.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $db = new PDO('mysql:host=localhost;dbname=Books;charset=utf8;', 'lukas', 'pass');
    } catch (Exception $e) {
        die('Duomenų bazė nepasiekiama '.$e->getMessage());
    }
    $book = new Book($db);
    $book->load($id);
} else {
    die('Nepateiktas knygos id');
}

?>
<h1><?php echo $book->getTitle(); ?></h1>
Autorius (-iai): <?php echo $book->getAuthors(); ?><br/>
Leidimo metai: <?php echo $book->getYear(); ?><br/>
Žanras: <?php echo $book->getGenre(); ?><br/>
</body>