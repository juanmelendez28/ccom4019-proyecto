<?php
/*
    Require the necessary files to run the application and use on the entire application
*/
    define('CONFIG', require_once('util/config.php'));
    require_once('util/exceptions.php');
    require_once('util/helpers.php');
    require_once('util/auth.php');
    require_once('controllers/CoursesController.php');
    require_once('controllers/DepartmentsController.php');
    require_once('controllers/TermsController.php');
    require_once('controllers/TermOfferingController.php');
    require_once('controllers/UsersController.php');
    require_once('controllers/LoginController.php');
    
    // this will be the page the user lands in, and by default will show the available courses
    // without any ability to modify anything

    //dd($_GET);

    session_start();
    $method = $_SERVER['REQUEST_METHOD'];


    if (isset($_POST['path']) or isset($_GET['courses']) or isset($_GET['login']) or
        isset($_GET['departments']) or isset($_GET['terms']) or isset($_GET['users']))
    {
        if (isset($_POST['path']) && $_POST['path'] == 'login') {
            LoginController::user_login();
        } elseif (isset($_GET['courses'])) {
            CoursesController::index($method);
        } elseif (isset($_GET['departments'])) {
            DepartmentsController::index();
        } elseif (isset($_GET['terms'])) {
            TermsController::index(); 
        } elseif (isset($_GET['users'])) {
            UsersController::index(); 
        } elseif(isset($_GET['login'])) {
            LoginController::index(); 
        }  else {
            TermOfferingController::index();
        }
    }
    else {
        TermOfferingController::index();
    }
    // there will be a login button in the header that will allow users with accounts to log in
    // and they will have certain permissions depending on their role

    // admins can CRUD on any table

    // other users can only CRUD on tables of their department



    // include("router.php"); // we might not need the router at all 
    // if we just use the index as a router/controller
    
?>