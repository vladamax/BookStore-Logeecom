<?php

namespace BookStore\PresentationSPA\Controllers;
//require "./vendor/autoload.php";

use BookStore\PresentationSPA\ViewModels\AuthorViewModel;
use BookStore\Business\AuthorService;
use BookStore\Business\Models\Author;
use BookStore\DataAccess\DBAuthorRepository;
use Exception;

class AuthorControllerSpa
{
    /**
     * @var array
     */
    public array $authors = array();
    /**
     * @var AuthorService
     */
    private AuthorService $authorServices;


    public function __construct()
    {
        $this->authorServices = new AuthorService(new DBAuthorRepository());
    }

    /** Creates javaScript objects
     * @param array $authors
     * @return array
     */
    public function transform(array $authors) : array
    {
        $jsonArray[] = array();

        foreach($authors as $author)
        {
            $jsonArray[] = new AuthorViewModel($author->getId() , $author->getFirstName() , $author->getLastName() , $author-> getNumberOfBooks());
        }
        return $jsonArray;
    }

    /** Lists authors
     * @param array $request
     * @return array
     */
    public function getAllAuthors(array $request) : array
    {
        $this->authors = $this->authorServices->getAllAuthors();
        return $this->transform($this->authors);
    }

    /** Deletes the chosen author
     * @param array $request
     * @return array
     */
    public function delete(array $request) : array
    {
        $this->authorServices->delete($request['authorId'][0]);
        return $this->getAllAuthors($request);
    }

    /** Inserts an author into the database
     * @param array $request
     * @return array
     * @throws Exception
     */
    public function insert(array $request) : array
    {
        $this->validateAdd($request['firstName'], $request['lastName']);

            $author = Author::createForInsert($request['firstName'], $request['lastName']);
            $this->authorServices->insert($author);
            return $this->getAllAuthors($request);
    }

    /** Finds the author using its id
     * @param int $authorId
     * @return void
     * @throws Exception
     */

    /** Updates the chosen author
     * @param array $request
     * @return array
     * @throws Exception
     */
    public function update(array $request): array
    {
        $this->validateEdit($request['firstName'], $request['lastName'], $request['firstNameUpdated'], $request['lastNameUpdated']);

        $author = Author::createForUpdate($request['firstNameUpdated'], $request['lastNameUpdated'], $request['authorId'][0]);
        $this->authorServices->update($author);

        return $this->getAllAuthors($request);
    }


    /** Validates the input
     * @param string $firstName
     * @param string $lastName
     * @param string $firstNameUpdated
     * @param string $lastNameUpdated
     * @throws Exception
     */
    public function validateEdit(string $firstName, string $lastName, string $firstNameUpdated, string $lastNameUpdated)
    {
        if (strlen($firstNameUpdated)==0 || strlen($lastNameUpdated)==0)
        {
            throw new Exception('Both fields are required!');
        }
        else if ($firstName == $firstNameUpdated && $lastName == $lastNameUpdated)
        {
            throw new Exception('You need to enter new first name or last name');
        }
        else if (strlen($firstNameUpdated)>100 || strlen($lastNameUpdated)>100)
        {
            throw new Exception('Too long first or last name!');
        }
    }

    /** Validates the input
     * @param string $firstName
     * @param string $lastName
     * @throws Exception
     */
    public function validateAdd(string $firstName , string $lastName)
    {
        if (strlen($firstName)==0 || strlen($lastName)==0)
        {
            throw new Exception('Both fields are required!');
        }
        else if (strlen($firstName)>100 || strlen($lastName)>100)
        {
            throw new Exception('Too long first or last name!');
        }
    }
}