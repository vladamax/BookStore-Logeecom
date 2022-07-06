<?php

namespace BookStore\Business;

use BookStore\Business\Interfaces\Repositories\AuthorRepositoryInterface;
use BookStore\Business\Models\Author;
use Exception;

class AuthorService
{
    private AuthorRepositoryInterface $authorRepository;

    /**
     * @param AuthorRepositoryInterface $repository
     */
    public function __construct(AuthorRepositoryInterface $repository)
    {
        $this->authorRepository = $repository;
    }

    /** Fetch authors from the database
     * @return array
     */
    public function getAllAuthors() : array
    {
        return $this->authorRepository->getAllAuthors();
    }

    /** Deletes the chosen author
     * @param int $authorId
     */
    public function delete(int $authorId)
    {
        $this->authorRepository->delete($authorId);
    }

    /** Inserts an author into the database
     * @param Author $author
     */
    public function insert(Author $author)
    {
        $this->authorRepository->insert($author);
    }

    /** Updates the author
     * @param Author $author
     */
    public function update(Author $author)
    {
        $this->authorRepository->update($author);
    }

    /**
     * Finds the author using its id
     * @param int $authorId
     * @return Author|null
     * @throws Exception
     */
    public function findById(int $authorId) : ?Author
    {
        return $this->authorRepository->findById($authorId);
    }


}