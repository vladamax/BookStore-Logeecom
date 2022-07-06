<?php

namespace BookStore\Presentation\ViewModels;

use BookStore\Business\Models\Author;

class AuthorListViewModel
{
    private array $authors;
    private string $actionBooks = '/Src/Routes/BookIndex.php';
    private string $actionDelete = '/Src/Routes/DeleteAuthor.php';
    private string $actionEdit = '/Src/Routes/EditAuthor.php';
    private string $actionCreate = '/Src/Routes/CreateAuthor.php';

    public function __construct(array $authors)
    {
        $this->authors = $authors;
    }

    /**
     * @return array
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    /**
     * @return string
     */
    public function getActionBooks(): string
    {
        return $this->actionBooks;
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

    public function getLongTitle(Author $author) : string
    {
        return "{$author->getFirstName()} {$author->getLastName()}";
    }

}