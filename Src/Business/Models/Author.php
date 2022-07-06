<?php

namespace BookStore\Business\Models;

class Author
{
    public ?int $id;
    public ?string $firstName;
    private ?string $lastName;
    private ?int $numberOfBooks;

    /**
     * @return int
     */
    public function getNumberOfBooks(): int
    {
        return $this->numberOfBooks;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public static function createForUpdate(string $firstNameUpdated, string $lastNameUpdated, int $authorId)  : Author
    {
        return new self($firstNameUpdated, $lastNameUpdated, $authorId);
    }

    public static function createCompleteAuthor( int $id, string $firstName, string $lastName, int $numberOfBooks)  : Author
    {
        return new self($firstName, $lastName,  $id , $numberOfBooks);
    }

    public static function createForInsert(?string $firstName, ?string $lastName) : Author
    {
        return new self($firstName, $lastName);
    }

    private function __construct(?string $firstName, ?string $lastName, ?int $id = null, ?int $numberOfBooks = null)
    {
        $this->id = $id;
        $this->numberOfBooks = $numberOfBooks;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }


}