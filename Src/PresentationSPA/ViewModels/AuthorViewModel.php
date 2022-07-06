<?php

namespace BookStore\PresentationSPA\ViewModels;

use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class AuthorViewModel implements JsonSerializable
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private int $numberOfBooks;

    public function __construct(int $id , string $firstName , string $lastName , int $numberOfBooks)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->numberOfBooks = $numberOfBooks;
    }

    #[ArrayShape(['id' => "int", 'firstName' => "string", 'lastName' => "string", 'numberOfBooks' => "int"])]
    public function jsonSerialize() : array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'numberOfBooks' => $this->numberOfBooks
        ];
    }
}