<?php

namespace BookStore\Presentation\ViewModels;

class DeleteAuthorViewModel
{
    private string $action = "/Src/Routes/DeleteAuthor.php";
    private int $authorId;

    public function __construct(int $authorId)
    {
        $this->authorId = $authorId;
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

}