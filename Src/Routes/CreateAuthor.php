<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use BookStore\Business\Models\Author;
use BookStore\Presentation\Controllers\AuthorController;
use BookStore\Presentation\ViewModels\CreateAuthorViewModel;

if (isset($_GET['firstName']) && isset($_GET['lastName']))
    {
        $author = Author::createForInsert($_GET['firstName'],$_GET['lastName']);
        $authorController = new AuthorController();
        try {
            $authorController->validateAdd($author);
            $authorController->insert($author);
            $authorController->getAllAuthors();
        }
        catch(Exception $e) {
            $viewModel = new CreateAuthorViewModel($e->getMessage());
            include __DIR__ . '/../Presentation/Views/CreateAuthorView.php';
        }
    }
    else
    {
        $viewModel = new CreateAuthorViewModel(null);
        include __DIR__ . '/../Presentation/Views/CreateAuthorView.php';
    }