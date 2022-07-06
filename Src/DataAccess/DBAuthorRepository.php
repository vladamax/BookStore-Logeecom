<?php

namespace BookStore\DataAccess;

use BookStore\Business\Interfaces\Repositories\AuthorRepositoryInterface;
use BookStore\Business\Models\Author;
use BookStore\PDOConnection;
use Exception;

class DBAuthorRepository implements AuthorRepositoryInterface
{
    private PDOConnection $pdo;

    /** Fetch authors from the database
     * @return array
     */
    public function getAllAuthors(): array
    {
        $authors = array();
        $this->pdo = new PDOConnection();

        $this->pdo->prepareStatement('SELECT Author.first_name as first_name, Author.last_name as last_name ,
       Author.author_id as id , (SELECT COUNT(*) FROM Book WHERE Book.author_id=Author.author_id) as numberOfBooks FROM Author;');

        $this->pdo->executePDO();

        foreach ($this->pdo->fetchAll() as $author)
        {
            $authors [] = Author::createCompleteAuthor($author->id, $author->first_name, $author->last_name, $author->numberOfBooks);
        }
        return $authors;
    }

    /** Inserts an author into the database
     * @param Author $author
     */
    public function insert(Author $author)
    {
        $this->pdo = new PDOConnection();
        $this->pdo->prepareStatement('INSERT INTO Author (first_name,last_name) VALUES (?,?);');
        $this->pdo->executePDO(array($author->getFirstName(),$author->getLastName()));
    }

    /** Deletes the chosen author
     * @param int $authorId
     * @throws Exception
     */
    public function delete(int $authorId)
    {
        $this->pdo = new PDOConnection();

        $this->pdo->prepareStatement('DELETE FROM Book WHERE author_id = ? ;');
        if (!$this->pdo->executePDO(array($authorId)))
        {
            throw new Exception('Delete was not successful');
        }
        $this->pdo->prepareStatement('DELETE FROM Author WHERE author_id = ? ;');
        if (!$this->pdo->executePDO(array($authorId)))
        {
            throw new Exception('Delete was not successful');
        }
    }

    /** Updates the author
     * @param Author $author
     */
    public function update(Author $author)
    {
        $this->pdo = new PDOConnection();
        $this->pdo->prepareStatement('UPDATE Author SET first_name= ? , last_name= ? WHERE author_id = ? ;');
        $this->pdo->executePDO(array($author->getFirstName() , $author->getLastName() , $author->getId()));
    }

    /** Finds the author using his id
     * @param int $authorId
     * @return Author
     * @throws Exception
     */
    public function findById(int $authorId) : Author
    {
        $authors = $this->getAllAuthors();
        foreach ($authors as $author) {
            if ($author->getId() == $authorId) {
                return $author;
            }
        }
        throw new Exception('Author not found');
    }
}