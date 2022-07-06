<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use BookStore\Business\Models\Author;
use BookStore\Presentation\Controllers\AuthorController;
use BookStore\Presentation\ViewModels\EditAuthorViewModel;

        $authorController = new AuthorController();
try {
    $oldAuthor = $authorController->findById((int)$_GET['authorId']);
}catch (Exception $e)
{
    $authorController->getAllAuthors();
    echo '<script>alert("' . $e->getMessage() . '")</script>';
    return;
}



    if (isset($_GET['firstName']) && isset($_GET['lastName']))
    {
        $newAuthor = Author:: createForUpdate($_GET['firstName'], $_GET['lastName'], $_GET['authorId']);

        try {
            $authorController->validateEdit($oldAuthor, $newAuthor);
            $authorController->update($newAuthor);
            $authorController->getAllAuthors();
        } catch (Exception $e) {
            $viewModel = new EditAuthorViewModel($oldAuthor , $e->getMessage());
            include __DIR__ . '/../Presentation/Views/EditAuthorView.php';
        }
    }
    else {
        $viewModel = new EditAuthorViewModel($oldAuthor , null);
        include __DIR__ . '/../Presentation/Views/EditAuthorView.php';
    }