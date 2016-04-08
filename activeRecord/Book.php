<?php

class Book
{
    protected $id;
    protected $title;
    protected $authors;
    protected $year;
    protected $genre;
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function load($id)
    {
        if ($this->db !== null) {
            $book = $this->db->query(
                "SELECT Books.bookId, Books.title, Books.year, Genres.description, GROUP_CONCAT(Authors.name) as authors
					FROM Books
					LEFT JOIN BookAuthors
					ON Books.bookId = BookAuthors.bookId
					LEFT JOIN Authors
					ON BookAuthors.authorId = Authors.authorId
					LEFT JOIN Genres
					ON Books.genreId = Genres.genreId WHERE Books.bookId = $id GROUP BY Books.bookId;"
            )->fetch(PDO::FETCH_ASSOC);

            $this->parseArray($book);
        }
    }

    public function parseArray($array)
    {
        if (isset($array['bookId'])) {
            $this->setId($array['bookId']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['authors'])) {
            $this->setAuthors($array['authors']);
        }
        if (isset($array['year'])) {
            $this->setYear($array['year']);
        }
        if (isset($array['description'])) {
            $this->setGenre($array['description']);
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param array $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    
}
