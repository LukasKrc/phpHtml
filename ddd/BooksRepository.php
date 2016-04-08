<?php

/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 16.4.5
 * Time: 17.30
 */
include 'Book.php';

class BooksRepository
{
    public function getById($id)
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=Books;charset=utf8;', 'lukas', 'pass');
        }
        catch (Exception $e) {
            die('Duomenų bazė nepasiekiama '.$e->getMessage());
        }
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

        return $this->parseBook($book);
    }

    private function parseBook($book)
    {
        $bookObject = new Book();
        $bookObject->setId($book['bookId']);
        $bookObject->setTitle($book['title']);
        $bookObject->setAuthors($book['authors']);
        $bookObject->setYear($book['year']);
        $bookObject->setGenre($book['description']);
        return $bookObject;
    }

    public function getAll()
    {
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

        $booksArray = [];
        foreach ($books as $book) {
            $bookObject = new Book();
            $bookObject->setId($book['bookId']);
            $bookObject->setTitle($book['title']);
            $booksArray[] = $bookObject;
        }

        return $booksArray;
    }

}