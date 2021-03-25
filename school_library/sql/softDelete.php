<?php

include_once 'connectApplications.php';

try {
    //connect
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    // command delete rows in books table and relation table
    $command = "DELETE books, relation " .
        "FROM books JOIN relation ON relation.book_id = books.book_id " .
        "WHERE books.is_delete = 1;";
    //run command
    $pdo->exec($command);
} catch (PDOException $e){
    echo 'error!';
}
