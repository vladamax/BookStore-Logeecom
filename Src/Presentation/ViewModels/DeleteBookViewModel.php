<?php

namespace BookStore\Presentation\ViewModels;

class DeleteBookViewModel
{
    private string $action = "/Src/Routes/DeleteBook.php";
    private int $authorId;
    private int $bookId;

    public function __construct(int $authorId , int $bookId)
    {
        $this->authorId = $authorId;
        $this->bookId = $bookId;
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
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }


}