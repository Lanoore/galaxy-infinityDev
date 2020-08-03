<?php

session_start();

require '../config/dev.php'; //changer en online et modifier le fichier pour avoir la config en ligne et remettre en dev pour le local
require '../vendor/autoload.php';

$router = new \App\config\Router();
$router->run();