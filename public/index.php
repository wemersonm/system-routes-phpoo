<?php
echo "<pre>";
use app\core\Router;
use app\core\RouterFilters;

use Dotenv\Dotenv;

require "../vendor/autoload.php";
session_start();

$dotenv = Dotenv::createImmutable('../');
$dotenv->load();

Router::run();



