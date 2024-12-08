<?php

/**
 * Custom Exceptions File
 * 
 * This is a file that contains custom exceptions for the application in order to handle errors.
 */

class NotImplementedException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class ModelNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class ViewNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class DatabaseConnectionException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class MissingKeysException extends Exception
{
    public $missing_keys;
    
    public function __construct($message = "", $code = 0, Throwable $previous = null , $missing_keys = [])
    {
        $this->missing_keys = $missing_keys;
        parent::__construct($message, $code, $previous);
    }
}


/**
 * Custom exception handler to catch and display errors in a user-friendly way.
 *
 * This function will take an exception object, stylize the error message, and
 * show it in a view.
 *
 * @param Exception $exception The exception object to be handled.
 */
function exceptionHandler($exception)
{

    // Stylize the error message
    $exception_name = get_class($exception);
    $exception_message = $exception->getMessage();
    $exception_trace = $exception->getTrace();
    $exception_file = $exception->getFile();
    $exception_line = $exception->getLine();


    // getting the file contents to show at the view

    //    $exception_file_contents = file_get_contents($exception_file);

    // save only 15 lines between the error line

    require_once('views/debug_error.php');
}

// Set the custom exception handler
set_exception_handler('exceptionHandler');
