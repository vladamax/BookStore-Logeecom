<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use BookStore\Presentation\Controllers\BookController;
use BookStore\Presentation\ViewModels\DeleteBookViewModel;

if (isset($_GET['answer']))
{        $bookController = new BookController();
    if ($_GET['answer']  == 'Delete')
    {
        try {
            $bookController->delete((int)$_GET["bookId"]);
        }
        catch(Exception $e)
        {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
        }
        finally
        {
            $bookController->getAllBooks((int)$_GET['authorId']);
        }
    }
    else
    {
        $bookController->getAllBooks((int)$_GET['authorId']);
    }
}
else
{
    $viewModel = new DeleteBookViewModel($_GET['authorId'] , $_GET['bookId']);
    include __DIR__ . "/../Presentation/Views/DeleteBookView.php";
}


