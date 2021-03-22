<?php

spl_autoload_register(function ($name) {
    $name = str_replace('\\', '/', $name);
//    echo $name . '<br/>';
    include_once   $name . '.php';
});


$router = new \core\RouterClass();
$router->run();