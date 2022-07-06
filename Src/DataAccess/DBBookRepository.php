<?php

namespace BookStore\DataAccess;

use BookStore\Business\Interfaces\Repositories\BookRepositoryInterface;
use BookStore\Business\Models\Book;
use BookStore\PDOConnection;
use Exception;

class DBBookRepository implements BookRepositoryInterface
{
    private PDOConnection $pdo;

    public function __construct()
    {
        $this->pdo = new PDOConnection();
    }

    /** Fetch the books from the database
     * @param int $authorId
     * @return array
     */
    public function getAllBooks(int $authorId): array
    {
        $books = array();
        $this->pdo->prepareStatement('SELECT title,book_id,year,author_id FROM Book WHERE author_id= ?');
        $this->pdo->executePDO(array($authorId));

        foreach ($this->pdo->fetchAll() as $book)
        {
            $books [] = Book::createCompleteBook($book->title, $book->year, $book->author_id , $book->book_id);
        }
        return $books;
    }

    /** Inserts a book into database
     * @param Book $book
     */
    public function insert(Book $book)
    {
        $this->pdo->prepareStatement('INSERT INTO Book (title,year,author_id) VALUES (?,?,?);');
        $this->pdo->executePDO(array($book->getTitle(),$book->getYear(),$book->getAuthorId()));
    }

    /** Deletes the chosen book
     * @param int $bookId
     * @throws Exception
     */
    public function delete(int $bookId)
    {
        $this->pdo = new PDOConnection();
        $this->pdo->prepareStatement('DELETE FROM Book WHERE book_id = ?;');
        if (!$this->pdo->executePDO(array($bookId)))
        {
            throw new Exception('Delete was not successful');
        }
    }

    /** Updates the book
     * @param Book $book
     */
    public function update(Book $book)
    {
        $pdo = new PDOConnection();
        $pdo->prepareStatement('UPDATE Book SET title= ? , year= ? WHERE book_id = ? ;');
        $response = $pdo->executePDO(array($book->getTitle() , $book->getYear() , $book->getId()));
        $response = 0;
    }

    /** Finds the book using its id
     * @param int $bookId
     * @param int $authorId
     * @return Book
     * @throws Exception
     */
    public function findById(int $bookId , int $authorId): Book
    {
        $books = $this->getAllBooks($authorId);
        foreach($books as $book)
        {
            if ($book->getId() == $bookId)
            {
                return $book;
            }
        }
        throw new Exception('Book not found.');
    }

}