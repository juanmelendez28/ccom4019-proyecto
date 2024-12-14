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



/**
 * Parse a BBCode-like string and return an associative array of the values
 *
 * The string is expected to be split into lines, where each line is either
 * - a title, prefixed with a '#'
 * - a subtitle, prefixed with a '-'
 * - a description, which is not prefixed with either. 
 * The description will be the first unkeyed value detected (without a prefixing '#').
 *
 * @param string $text the string to parse
 * @param array $required the keys that must be present in the output
 * @return array the associative array of values, or false if any of the
 *  required keys were missing
 * @throws MissingKeysException if any of the required keys were missing, you can access the missing keys with $e->missing_keys
 * 
 * Example
 * ```php
 * $text = " 
 * My daily shopping list today
 * # Shopping List
 * - Tomato
 * - Lettuce
 * ";
 * 
 * parseBBCode($text, ['Shopping List']);
 * 
 * // returns: ['Shopping List' => ['Tomato', 'Lettuce'], 'unkeyed' => 'My daily shopping list today']
 * ```
 */
function parseBBCode($text, $required)
{
    // it is expected that the text is split into lines
    $lines = preg_split('/\r?\n/', $text);


    $result = []; // the result array which will contain all keys and unkeyed values
    $currentTitle = false; // keep track of the previous title for listing items (prefixed with '-')

    foreach ($lines as $line) {
        // Remove trailing and leading spaces
        $line = trim($line);

        if (empty($line)) {
            continue;
        }

        if (strpos($line, '#') === 0) {
            // the line is a title:
            $currentTitle = trim(substr($line, 1)); // keep track of the current title
            $result[$currentTitle] = []; // create an empty array for the current title

        } elseif (strpos($line, '-') === 0) {
            // the line is a list item:
            if ($currentTitle === false) {
                continue; // skip the line if there is no current title
            }

            $result[$currentTitle][] = trim(substr($line, 1)); // append the list item to the current title
        } else {
            // if the line is not keyed or prefixed with any special key:
            if (!isset($result['unkeyed'])) {
                // this will only store the first occurrence of this unkeyed value, everything else will be ignored.
                $result['unkeyed']  = $line;
            }
        }
    }

    // validate the output to contain necessary keys
    $missing_keys = array_diff($required, array_keys($result));

    if (count($missing_keys) > 0) {
        throw new MissingKeysException('The following keys are missing: ' . implode(', ', $missing_keys), 400, null, $missing_keys);
        return false;
    }

    return $result;
}


/**
 * Converts an associative array to a BBCode-like string.
 *
 * The input array is expected to have the following structure:
 * - The key 'unkeyed' is allowed and will be treated as a single string.
 * - Each other key represents a title, and its value is an array of strings,
 *   which will be treated as list items under that title.
 *
 * The function will return a string in the following format:
 * Title
 * - item 1
 * - item 2
 * Unkeyed value
 *
 * @param array $content The associative array to convert.
 * @return string The BBCode-like string representation of the input array.
 */
function toBBCode(array $content) {

    $output = '';


    foreach ($content as $key => $value) {
        if ($key === 'unkeyed') {
            $output .= $value . "\n";
        } else {
            $output .= '#' . $key . "\n";
            foreach ($value as $item) {
                $output .= '- ' . $item . "\n";
            }
        }
        $output .= "\n";
    }

    return $output;
}

/**
 * Redirect to a given path.
 *
 * @param string $path The path to redirect to.
 * @return void
 */
function redirect($path)
{
    header('Location: ' . $path);
    exit;
}


/**
 * Redirect to the referring URL.
 *
 * @return void
 */
function redirect_back()
{
    redirect($_SERVER['HTTP_REFERER']);
}


/**
 * Validates a course code format.
 *
 * The course code is expected to consist of exactly four uppercase letters
 * followed by four digits.
 *
 * @param string $code The course code to validate.
 * @return bool Returns true if the course code matches the expected format, false otherwise.
 */
function is_valid_course_code($code)
{
    return preg_match('/^[A-Z]{4}\d{4}$/', $code);
}