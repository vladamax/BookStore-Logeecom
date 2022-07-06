<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use BookStore\Business\Models\Book;
use BookStore\Presentation\Controllers\BookController;
use BookStore\Presentation\ViewModels\CreateBookViewModel;

if (isset($_GET['title']) && isset($_GET['year']))
{
    $book = Book::createForInsert($_GET['title'],(int)$_GET['year'] , $_GET['authorId']);
    $bookController = new BookController();
    try {
        $bookController->validateAdd($book);
        $bookController->insert($book);
        $bookController->getAllBooks($_GET['authorId']);
    }
    catch(Exception $e) {
        $viewModel = new CreateBookViewModel($e->getMessage(), $_GET['authorId']);
        include __DIR__ . '/../Presentation/Views/CreateBookView.php';
    }
}
else
{
    $viewModel = new CreateBookViewModel(null , $_GET['authorId']);
    include __DIR__ . '/../Presentation/Views/CreateBookView.php';
}


