<?php

namespace BookStore\Business;

use BookStore\Business\Interfaces\Repositories\BookRepositoryInterface;
use BookStore\Business\Models\Book;

class BookService
{
    /**
     * @var BookRepositoryInterface
     */
    private BookRepositoryInterface $bookRepository;

    /**
     * @param BookRepositoryInterface $repository
     */
    public function __construct(BookRepositoryInterface $repository)
    {
        $this->bookRepository = $repository;
    }

    /** Fetch the books from the database
     * @param int $authorId
     * @return array
     */
    public function getAllBooks(int $authorId) : array
    {
        return $this->bookRepository->getAllBooks($authorId);
    }

    /** Deletes the chosen book
     * @param int $bookId
     */
    public function delete(int $bookId)
    {
        $this->bookRepository->delete($bookId);
    }
    /** Inserts a book into database
     * @param Book $book
     */
    public function insert(Book $book)
    {
        $this->bookRepository->insert($book);
    }

    /** Finds the book using its id
     * @param int $bookId
     * @param int $authorId
     * @return Book
     */
    public function findById(int $bookId , int $authorId) : Book
    {
        return $this->bookRepository->findById($bookId , $authorId);
    }

    /** Updates the book
     *
     * @param Book $book
     */
    public function update(Book $book)
    {
        $this->bookRepository->update($book);
    }
}