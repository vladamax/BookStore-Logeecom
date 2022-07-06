<?php

namespace BookStore\Presentation\ViewModels;

class CreateAuthorViewModel
{
    private ?string $errorMessage;
    private string $action = '/Src/Routes/CreateAuthor.php';

    public function __construct(?string $errorMessage)
    {
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
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}