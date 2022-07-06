<?php

namespace BookStore\PresentationSPA\ViewModels;

use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class BookViewModel implements JsonSerializable
{
    private int $id;
    private string $title;
    private int $year;

    public function __construct(int $id , string $title , int $year)
    {
        $this->id=$id;
        $this->title=$title;
        $this->year=$year;
    }

    #[ArrayShape(['id' => "int", 'title' => "string", 'year' => "int"])]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year
        ];
    }
}