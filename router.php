<?php


// REQUIRE CONTROLLERS HERE
require_once 'controllers/CoursesController.php';

// router.php
$method = $_SERVER['REQUEST_METHOD'];

$absoluteRequest = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptName = parse_url($_SERVER['SCRIPT_NAME'], PHP_URL_PATH);
$projectDir = dirname($scriptName);

$request = str_replace($projectDir, '', $absoluteRequest);

// cleaned UP URI
switch ($request) {
    case '/': // this one should redirect to the login page
        // after the user is logged in it will either redirect to /admin or /student
        CoursesController::index();
        break;
    case '/admin': // this one should redirect to the courses page with admin privileges
        CoursesController::index(); // 
        break;
    default:
        // Showing a custom error page for debug purposes. Remove this line when in production/presentation
        throw new ViewNotFoundException('View not found, check the router.php file for more information.');
        break;
}