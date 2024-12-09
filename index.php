<?php
/*
    Require the necessary files to run the application and use on the entire application
*/
    define('CONFIG', require_once('util/config.php'));
    require_once('util/exceptions.php');
    require_once('util/helpers.php');
    require_once('controllers/CoursesController.php');
    require_once('controllers/DepartmentsController.php');
    require_once('controllers/TermsController.php');
    require_once('controllers/UsersController.php');
    require_once('controllers/LoginController.php');
    
    // this will be the page the user lands in, and by default will show the available courses
    // without any ability to modify anything

    if (isset($_POST['debug']) or isset($_GET))
    {
        if (isset($_GET['departments'])) {
            DepartmentsController::index();
        } elseif (isset($_GET['terms'])) {
            TermsController::index(); 
        } elseif (isset($_GET['users'])) {
            UsersController::index(); 
        } elseif($_POST['debug'] === "login") {
            LoginController::user_login();
        } else {
            CoursesController::index(); 
        }
    }
    else
        LoginController::index();
    // there will be a login button in the header that will allow users with accounts to log in
    // and they will have certain permissions depending on their role

    // admins can CRUD on any table

    // other users can only CRUD on tables of their department



    // include("router.php"); // we might not need the router at all 
    // if we just use the index as a router/controller
    
?>