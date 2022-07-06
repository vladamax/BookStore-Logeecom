<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use BookStore\Presentation\Controllers\AuthorController;
use BookStore\Presentation\ViewModels\DeleteAuthorViewModel;


if (isset($_GET['answer']))
{
    $authorController = new AuthorController();
    if($_GET['answer']  == 'Delete')
    {
        try {
            $authorController->delete((int)$_GET["authorId"]);
        }
        catch(Exception $e)
        {
            echo '<script>alert("' . $e->getMessage() . '")</script>';
        }
        finally
        {
            $authorController->getAllAuthors();
        }
    }
    else
    {
        $authorController->getAllAuthors();
    }
}
else
{
    $viewModel = new DeleteAuthorViewModel($_GET['authorId']);
    include __DIR__ .  "/../Presentation/Views/DeleteAuthorView.php";
}