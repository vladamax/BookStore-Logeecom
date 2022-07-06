<?php

namespace BookStore\Presentation\ViewModels;

use BookStore\Business\Models\Book;

class EditBookViewModel
{
    private string $action = "/Src/Routes/EditBook.php";
    private ?string $errorMessage;
    private string $placeHolderFirst;
    private int $placeHolderSecond;
    private int $bookId;
    private int $authorId;

    public function __construct(Book $book , ?string $errorMessage)
    {
        $this->placeHolderFirst = $book->getTitle();
        $this->placeHolderSecond = $book->getYear();
        $this->bookId = $book->getId();
        $this->authorId = $book->getAuthorId();
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return String
     */
    public function getPlaceHolderFirst(): string
    {
        return $this->placeHolderFirst;
    }

    /**
     * @return int
     */
    public function getPlaceHolderSecond(): int
    {
        return $this->placeHolderSecond;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }


    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }


    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }


}