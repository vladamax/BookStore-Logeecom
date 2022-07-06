<?php

namespace BookStore\Business\Models;
class Book
{
    public ?int $id;
    private string $title;
    private ?int $authorId;
    private int $year;

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return String $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    public static function createForUpdate(string $title , int $year , int $bookId) : Book
    {
        return new self($title,$year,null, $bookId);
    }

    public static function createForInsert(string $title, int $year, int $authorId)  : Book
    {
        return new self($title, $year, $authorId);
    }

    public static function createCompleteBook(string $title, int $year, int $authorId,  int $id)  : Book
    {
        return new self($title, $year, $authorId,$id );
    }
    private function __construct(string $title, int $year, ?int $authorId = null , ?int $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->authorId = $authorId;
        $this->year= $year;
    }
}