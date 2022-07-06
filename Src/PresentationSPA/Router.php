<?php
require_once __DIR__ . "/../../vendor/autoload.php";

use BookStore\Business\Models\Author;
use BookStore\Business\Models\Book;
use BookStore\PresentationSPA\Controllers\BookControllerSpa;
use BookStore\PresentationSPA\Controllers\AuthorControllerSpa;

$bookControllerSpa = new BookControllerSpa();
$authorControllerSpa = new AuthorControllerSpa();
$requestPayload = file_get_contents("php://input");
$request = json_decode($requestPayload, true);


$commands = [
    'authors' => [
        'list' => [new AuthorControllerSpa() , "getAllAuthors"],
        'del' => [new AuthorControllerSpa() , "delete"],
        'update' => [new AuthorControllerSpa() , "update"] ,
        'insert' => [new AuthorControllerSpa() , "insert"]
    ],
    'books' => [
        'list' => [new BookControllerSpa() , "getAllBooks"],
        'del' => [new BookControllerSpa() , "delete"],
        'update' => [new BookControllerSpa() , "update"],
        'insert' => [new BookControllerSpa() , "insert"]
    ]
];

try {
    try {
        if (!isset($commands[$request['entityType'][$request['action']]])) {
            echo json_encode(call_user_func($commands[$request['entityType']][$request['action']], $request));
        } else {
            throw new Exception('There is no such command');
        }
    }catch(Exception $e)
    {
        echo json_encode($e->getMessage());
    }
}
catch(Exception $e)
{
    echo json_encode($e->getMessage());
}