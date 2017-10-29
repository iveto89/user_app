<?php
namespace App;
require_once __DIR__ . '/bootstrap.php';

if(!($_GET && array_key_exists('isAjax', $_GET))) {
    $app = new Bootstrap();
    $app->render();
}

if($_GET && array_key_exists('isAjax', $_GET)){
    $user = new User();
    return $user->getUsers();
}

