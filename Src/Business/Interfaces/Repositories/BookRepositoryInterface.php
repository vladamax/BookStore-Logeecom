<?php

namespace BookStore\Business\Interfaces\Repositories;

use BookStore\Business\Models\Book;

interface BookRepositoryInterface
{
    /**
     * Retrieves all books from a certain author.
     */
    public function getAllBooks(int $authorId);

    /**
     * Inserts a new book to the database
     * @param Book $book
     */
    public function insert(Book $book);

    /**
     * Deletes a book from the database
     * @param int $bookId
     */
    public function delete(int $bookId);

    /**
     * Updates a book from the database
     * @param Book $book
     */
    public function update(Book $book);

    /**
     * Searches for a book using her ID
     * @param int $bookId
     * @param int $authorId
     * @return Book
     */
    public function findById(int $bookId , int $authorId): Book;

}