<?php

require "./vendor/autoload.php";

use BookStore\Presentation\Controllers\AuthorController;
use BookStore\PresentationSPA\Controllers\AuthorControllerSpa;

$uri = parse_url($_SERVER['REQUEST_URI']);
$path = $uri['path'];

/**
 * Checks if the url entered is '/index.php/spa' and opens Single Page Application if it is
 */
if ($path == '/index.php/spa')
{
    $authorController = new AuthorControllerSpa();
    include "Src/PresentationSPA/BookListSPA.php";
}
/**
 * Else it opens regular application and lists authors
 */
else
{
    $authorController = new AuthorController();
    $authorController->getAllAuthors();
}































/*
$host = 'localhost';
$user = 'dovla';
$password = 'Vladimir1.';
$dbname = 'probica';

// set DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

// create a PDO instance

$pdo = new PDO($dsn, $user, $password);

// opciono - ako ne zelimo da uvek navodimo
// u zagradi dole na koji nacin hocemo
// da fecujemo podatke - da li kao array kome pristupas sa
// $row['first_name'] ili kao objekat kome pristupas sa
// $row->first_name
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
    PDO::FETCH_ASSOC);

// Ako zelimo LIMIT da radi , ovo moramo da napisemo - videces vec
// dole kad probas LIMIT bez ovoga
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


#PDO QUERY

$stmt = $pdo->query('select * from students');

//while($row = $stmt->fetch(PDO::FETCH_OBJ))
//{
//    echo $row->first_name;
//}

//
//while($row = $stmt->fetch(PDO::FETCH_ASSOC))
//{
//    echo $row['first_name'];
//}


# PREPARED STATEMENTS (prepare & execute)

// UNSAFE
//$sql = "SELECT * FROM students WHERE first_name = '$author'";

$first_name = "Vladimir";
$stud_id = 41;

// FETCH MULTIPLE POSTS

// Positional Params
//$sql = 'SELECT * FROM students WHERE first_name= ?';
//$stmt = $pdo->prepare($sql);
//// ovde stavljamo promenljive koje gore zamenjuju znake pitanja
//// red mora da se postuje !!
//$stmt->execute([$first_name]);
//$posts = $stmt->fetchAll(PDO::FETCH_OBJ);



// Named Params
// umesto ? koristimo :ime
// i dole u execute koristimo to ime za parametar
//$sql = 'SELECT * FROM students WHERE first_name= :first_name';
//$stmt = $pdo->prepare($sql);
//// ovde stavljamo promenljive koje gore zamenjuju znake pitanja
//// red mora da se postuje !!
//$stmt->execute(['first_name' => $first_name]);
//$posts = $stmt->fetchAll(PDO::FETCH_OBJ);



// multiple Named Params

$sql = 'SELECT * FROM students WHERE first_name= :first_name && student_id= :id';
$stmt = $pdo->prepare($sql);
// ovde stavljamo promenljive koje gore zamenjuju znake pitanja
// red mora da se postuje !!
$stmt->execute(['first_name' => $first_name , 'id' =>$stud_id]);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);


// takodje moze i samo fetch i onda dobijemo jedan rezultat


// GET ROW COUNT

$stmt = $pdo->prepare('SELECT * FROM students WHERE first_name= ?');
$stmt->execute([$first_name]);
$postCount = $stmt->rowCount();
echo $postCount;




//var_dump($posts);

foreach ($posts as $post) {
    echo $post->last_name . '<br>';
}



// INSERT DATA
//
//$first_name = 'd';
//$last_name = 'Buljic';
//
//$sql = 'INSERT INTO students (first_name,last_name) VALUES(:fn, :ln)';
//$stmt = $pdo->prepare($sql);
//$stmt->execute(['fn'=>$first_name, 'ln'=>$last_name]);
//echo 'Post Added';



// UPDATE DATA
//
//$first_name = 'd';
//$last_name = 'Buljic';
//
//$sql = 'UPDATE students SET last_name= :ln WHERE first_name= :fn ';
//$stmt = $pdo->prepare($sql);
//$stmt->execute(['fn'=>$first_name, 'ln'=>$last_name]);
//echo 'Post Updated';


// DELETE DATA

//$id = 67;
//
//$sql = 'DELETE FROM students WHERE student_id=:id';
//$stmt = $pdo->prepare($sql);
//$stmt->execute(['id'=>$id]);
//echo 'POST DELETED';


// SEARCH DATA
echo "SEARCH DATA <br>";

$search = "%lad%";
$sql = 'SELECT * FROM students WHERE first_name LIKE ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$search]);
$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach($posts as $post)
{
    echo $post->first_name . '<br>';
}
*/