<?php

namespace BookStore\Presentation\Controllers;

use BookStore\Business\BookService;
use BookStore\Business\Models\Book;
use BookStore\DataAccess\DBBookRepository;
use BookStore\Presentation\ViewModels\BookListViewModel;
use Exception;


class BookController
{
    /**
     * @var BookService
     */
    private BookService $bookService;


    public function __construct()
    {
        $this->bookService = new BookService(new DBBookRepository());
    }

    /** Lists books
     * @param int $authorId
     */
    public function getAllBooks(int $authorId)
    {
        $viewModel = new BookListViewModel($this->bookService->getAllBooks($authorId));
        include __DIR__ . '/../Views/authorBooksView.php';
    }

    /** Deletes the chosen book
     * @param int $bookId
     */
    public function delete(int $bookId)
    {
        $this->bookService->delete($bookId);
    }

    /** Inserts a book into database
     * @param Book $book
     */
    public function insert(Book $book)
    {
        $this->bookService->insert($book);
    }

    /** Finds the book using its id
     * @param int $bookId
     * @param int $authorId
     * @return Book
     */
    public function findById(int $bookId , int $authorId) : Book
    {
       return $this->bookService->findById($bookId , $authorId);
    }

    /** Updates the book
     * @param Book $book
     */
    public function update(Book $book)
    {
        $this->bookService->update($book);
    }

    /** Validates the input
     * @param Book $oldBook
     * @param Book $newBook
     * @throws Exception
     */
    public function validateEdit(Book $oldBook , Book $newBook)
    {
        // if there was a change
        if (strlen($newBook->getTitle()) == 0 || strlen($newBook->getYear()) == 0) {
            throw new Exception('Both fields are required!');
        } else if ($oldBook->getTitle() == $newBook->getTitle() && $oldBook->getYear() == $newBook->getYear()) {
            throw new Exception('You need to enter new title or year');
        } else if (strlen($newBook->getTitle()) > 100) {
            throw new Exception('Too long title.');
        } else if ($newBook->getYear() < -5000 || $newBook->getYear() > 999999 || $newBook->getYear() == 0) {
            throw new Exception('Year value is not acceptable');
        }
    }

    /** Validates the input
     * @param Book $book
     * @throws Exception
     */
    public function validateAdd(Book $book)
    {
        if (strlen($book->getTitle()) == 0 || strlen($book->getYear()) == 0) {
            throw new Exception('Both fields are required!');
        } else if (strlen($book->getTitle()) > 100) {
            throw new Exception('Too long title.');
        } else if ($book->getYear() < -5000 || $book->getYear()> 999999 || $book->getYear() == 0) {
            throw new Exception('Year value is not acceptable');
        }
    }
}