<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use BookStore\Business\Models\Book;
use BookStore\Presentation\Controllers\BookController;
use BookStore\Presentation\ViewModels\EditBookViewModel;

    $bookController = new BookController();
try {
    $oldBook = $bookController->findById((int)$_GET["bookId"] , (int)$_GET['authorId']);
}
catch (Exception $e)
{
    $bookController->getAllBooks();
    echo '<script>alert("' . $e->getMessage() . '")</script>';
    return;
}


    if (isset($_GET['title']) && isset($_GET['year']))
    {
        $newBook = Book::createForUpdate($_GET['title'], (int)$_GET['year'], (int)$_GET['bookId']);

    try {
        $bookController->validateEdit($oldBook, $newBook);
        $bookController->update($newBook);
        $bookController->getAllBooks($_GET['authorId']);
    } catch (Exception $e) {
        $viewModel = new EditBookViewModel($oldBook, $e->getMessage());
        include __DIR__ . '/../Presentation/Views/EditBookView.php';
    }
}
else
    {
        $viewModel = new EditBookViewModel($oldBook,null);
        include __DIR__ . '/../Presentation/Views/EditBookView.php';
    }