<?php

namespace BookStore\Presentation\ViewModels;

class CreateBookViewModel
{
    private int $authorId;
    private ?string $errorMessage;
    private string $action = '/Src/Routes/CreateBook.php';


    public function __construct(?string $errorMessage , $authorId)
    {
        $this->authorId = $authorId;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return int
     */
    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}