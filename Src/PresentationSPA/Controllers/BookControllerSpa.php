<?php

namespace BookStore\PresentationSPA\Controllers;

use BookStore\Business\BookService;
use BookStore\DataAccess\DBBookRepository;
use BookStore\Business\Models\Book;
use BookStore\PresentationSPA\ViewModels\BookViewModel;
use Exception;


class BookControllerSpa
{
    /**
     * @var array
     */
    public array $books = array();
    /**
     * @var BookService
     */
    private BookService $bookService;

    /**
     *
     */
    public function __construct()
    {
        $this->bookService = new BookService(new DBBookRepository());
    }

    /** Creates javaScript objects
     * @param array $books
     * @return array
     */
    public function transform(array $books) : array
    {
        $jsonArray[] = array();

        foreach($books as $book)
        {
            $jsonArray [] = new BookViewModel($book->getId() , $book->getTitle() , $book->getYear());
        }
        return $jsonArray;
    }

    /** Lists books
     * @param array $request
     * @return array
     */
    public function getAllBooks(array $request): array
    {
        $this->books = $this->bookService->getAllBooks($request['authorId']);
        return $this->transform($this->books);
    }

    /** Deletes the chosen book
     * @param array $request
     * @return array
     */
    public function delete(array $request) : array
    {
        $this->bookService->delete($request['bookId'][0]);
        return $this->getAllBooks($request);
    }

    /** Inserts a book into database
     * @param array $request
     * @return array
     * @throws Exception
     */
    public function insert(array $request): array
    {
        $this->validateAdd($request['title'], (int)$request['year']);

            $book = Book::createForInsert($request['title'], $request['year'],$request['authorId']);
            $this->bookService->insert($book);

            return $this->getAllBooks($request);
    }

    /** Updates the book
     * @param array $request
     * @return array
     * @throws Exception
     */
    public function update(array $request): array
    {
        $this->validateEdit($request['title'] , $request['titleUpdated'] , $request['year'] , (int)$request['yearUpdated']);

            $book = Book::createForUpdate($request['titleUpdated'],$request['yearUpdated'],(int)$request['bookId'][0]);
            $this->bookService->update($book);

            return $this->getAllBooks($request);
    }

    /** Validates the input
     * @param string $title
     * @param string $titleUpdated
     * @param int $year
     * @param int $yearUpdated
     * @throws Exception
     */
    public function validateEdit(string $title, string $titleUpdated , int $year , int $yearUpdated)
    {
        if (strlen($titleUpdated) == 0) {
            throw new Exception('Both fields are required!');
        } else if ($title == $titleUpdated && $year == $yearUpdated) {
            throw new Exception('You need to enter new title or year');
        } else if (strlen($titleUpdated) > 100) {
            throw new Exception('Too long title.');
        } else if ($yearUpdated < -5000 || $yearUpdated > 999999 || $yearUpdated == 0) {
            throw new Exception('Year value is not acceptable');
        }
    }


    /** Validates the input
     * @param string $title
     * @param int $year
     * @throws Exception
     */
    public function validateAdd(string $title , int $year)
    {
        if (strlen($title)==0 || strlen($year)==0)
        {
            throw new Exception('Both fields are required!');
        }
        else if (strlen($title)>100)
        {
            throw new Exception('Too long title.');
        }
        else if ($year <-5000 || $year > 999999 || $year==0)
        {
            throw new Exception('Year value is not acceptable');
        }
    }
}