<?php
/**
 * Dumps the given variables and ends the script.
 *
 * This function is useful for debugging purposes. It prints the contents
 * of the given variables in a readable format using `var_dump`, then 
 * terminates the script execution.
 *
 * @param mixed ...$args One or more variables to dump.
 */
function dd(...$args)
{
    echo '<pre style="font-size: 1.2em; background-color: black; color: white; padding: 15px">';
    var_dump(...$args);
    echo '</pre>';
    die();
}

/**
 * Encloses a string within single quotes.
 *
 * If the input is a string, it will be enclosed within single quotes,
 * otherwise, the input is returned unchanged.
 *
 * @param mixed $string The value to quote.
 * @return mixed The quoted string if the input is a string, otherwise the original input.
 */
function quote($string)
{
    if (gettype($string) !== 'string') {
        return $string;
    }
    return '\'' . $string . '\'';
}