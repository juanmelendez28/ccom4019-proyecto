<?php


// REQUIRE CONTROLLERS HERE
require_once 'controllers/CoursesController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];



switch ($request) {
    case '/':
        CoursesController::index();
        break;
    default:
        // Showing a custom error page for debug purposes. Remove this line when in production/presentation
        throw new ViewNotFoundException('View not found, check the router.php file for more information.');
        break;
}