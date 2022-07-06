<?php

namespace BookStore\Presentation\ViewModels;

use BookStore\Business\Models\Author;

class EditAuthorViewModel
{
    private string $action = "/Src/Routes/EditAuthor.php";
    private ?string $errorMessage;
    private string $placeHolderFirst;
    private string $placeHolderSecond;
    private int $authorId;

    public function __construct(Author $author , ?string $errorMessage)
    {
        $this->placeHolderFirst = $author->getFirstName();
        $this->placeHolderSecond = $author->getLastName();
        $this->authorId = $author->getId();
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
     * @return string|null
     */
    public function getPlaceHolderFirst(): ?string
    {
        return $this->placeHolderFirst;
    }

    /**
     * @return string|null
     */
    public function getPlaceHolderSecond(): ?string
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
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

}