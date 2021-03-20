<?php

$host = 'localhost';
$dbName = 'test_migration';
$user = 'root';
$pass = 'denis123';

include_once 'MigrationClass.php';
$migration = new MigrationClass($host, $dbName, $user, $pass);
$migration->run();