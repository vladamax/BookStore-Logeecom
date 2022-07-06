<?php
require_once __DIR__ . "/../../vendor/autoload.php";
use BookStore\Presentation\Controllers\BookController;

// Creates a new book controller and lists books
$bookController = new BookController();
$bookController->getAllBooks((int)$_GET['authorId']);