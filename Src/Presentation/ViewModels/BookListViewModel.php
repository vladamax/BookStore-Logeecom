<?php

namespace BookStore\Presentation\ViewModels;

use BookStore\Business\Models\Book;

class BookListViewModel
{
    private array $books;
    private string $actionDelete = '/Src/Routes/DeleteBook.php';
    private string $actionEdit = '/Src/Routes/EditBook.php';
    private string $actionCreate = '/Src/Routes/CreateBook.php';

    public function __construct(array $books)
    {
        $this->books = $books;
    }

    /**
     * @return array
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    /**
     * @return string
     */
    public function getActionDelete(): string
    {
        return $this->actionDelete;
    }

    /**
     * @return string
     */
    public function getActionEdit(): string
    {
        return $this->actionEdit;
    }

    /**
     * @return string
     */
    public function getActionCreate(): string
    {
        return $this->actionCreate;
    }

    public function getLongTitle(Book $book) : string
    {
        return "{$book->getTitle()} ({$book->getYear()})";
    }


}