<?php

namespace BookStore\Business\Interfaces\Repositories;

use BookStore\Business\Models\Author;

interface AuthorRepositoryInterface
{
    /**
     * Retrieves all authors.
     * @return Author[]
     */
    public function getAllAuthors() : array;

    /** Inserts a new author to the database
     * @param Author $author
     */
    public function insert(Author $author);

    /**
     * Delete an author from the database
     * @param int $authorId
     */
    public function delete(int $authorId);

    /**
     * Updates an author in the database
     * @param Author $author
     */
    public function update(Author $author);
}