<?php
/*
    Require the necessary files to run the application and use on the entire application
*/
    require_once('database/connector.php');
    require_once('models/User.php');
    require_once('util/exceptions.php');
    require_once('util/helpers.php');
    define('CONFIG', require_once('util/config.php'));

    include("./courses.html");

    echo '<h1>Printing All Users</h1>';
    dd(User::all());
    
?>