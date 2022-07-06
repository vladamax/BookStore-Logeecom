<?php

namespace BookStore\Presentation\Controllers;
//require "./vendor/autoload.php";

use BookStore\Business\AuthorService;
use BookStore\Business\Models\Author;
use BookStore\DataAccess\DBAuthorRepository;
use BookStore\Presentation\ViewModels\AuthorListViewModel;
use Exception;

class AuthorController
{
    /**
     * @var AuthorService
     */
    private AuthorService $authorServices;
    /**
     * @var array
     */

     public function __construct()
    {
        $this->authorServices = new AuthorService(new DBAuthorRepository());
    }

    /** Lists authors
     * @return void
     */
    public function getAllAuthors()
    {
        $viewModel = new AuthorListViewModel($this->authorServices->getAllAuthors());
        include __DIR__ . '/../Views/AuthorView.php';
    }

    /** Deletes the chosen author
     * @param int $authorId
     * @return void
     */
    public function delete(int $authorId)
    {
            $this->authorServices->delete($authorId);
    }
    /** Inserts an author into the database
     * @param Author $author
     */
    public function insert(Author $author)
    {
        $this->authorServices->insert($author);
    }

    /** Finds the author using its id
     * @param int $authorId
     * @return Author
     * @throws Exception
     */
    public function findById(int $authorId) : Author
    {
            return $this->authorServices->findById($authorId);
    }

    /** Updates the chosen author
     * @param Author $author
     */
    public function update(Author $author)
    {
        $this->authorServices->update($author);
    }

    /** Validates the input
     * @param Author $oldAuthor
     * @param Author $newAuthor
     * @throws Exception
     */
    public function validateEdit(Author $oldAuthor , Author $newAuthor)
    {
        if (strlen($newAuthor->getFirstName())==0 || strlen($newAuthor->getLastName())==0)
        {
            throw new Exception('Enter the authors first and last name ');
        }
        else if ($oldAuthor->getFirstName() == $newAuthor->getFirstName() && $oldAuthor->getLastName() == $newAuthor->getLastName())
        {
            throw new Exception('You need to enter new first name or last name');
        }
        else if (strlen($newAuthor->getFirstName())>100 || strlen($newAuthor->getLastName())>100)
        {
            throw new Exception('Too long first or last name.');
        }
    }

    /** Validates the input
     * @param Author $author
     * @throws Exception
     */
    public function validateAdd(Author $author)
    {
        if (strlen($author->getFirstName())==0 || strlen($author->getLastName())==0)
        {
            throw new Exception('Both fields are required.');
        }
        else if (strlen($author->getFirstName())>100 || strlen($author->getLastName())>100)
        {
            throw new Exception('Too long name.');
        }
    }
}