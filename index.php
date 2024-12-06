<?php
/*
    Require the necessary files to run the application and use on the entire application
*/
    define('CONFIG', require_once('util/config.php'));
    require_once('util/exceptions.php');
    require_once('util/helpers.php');
    

    include("router.php");
    
?>