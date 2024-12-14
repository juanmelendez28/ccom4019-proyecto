<?php

final class Auth
{

    // prevent instantiation
    private function __construct() {}

    /**
     * Check if the user is not logged in.
     *
     * This method verifies if the session does not have a user_id set,
     * indicating that the user is not logged in.
     *
     * @return bool True if the user is not logged in, false otherwise.
     */
    public static function check()
    {
        if (!isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }

    /**
     * Log in a user.
     *
     * This method sets the user in the session, indicating that the user is logged in.
     *
     * @param User $user The user to log in.
     */
    public static function login(User $user)
    {
        $_SESSION['user'] = $user;
    }


    /**
     * Refresh the user in the session.
     *
     * This method verifies if a user is set in the session, and if so, it refreshes the user
     * by retrieving it from the database and setting it again in the session.
     *
     * @return bool True if the user was refreshed, false if the user was not logged in.
     */
    public static function refresh()
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }
        $user = User::findBy(['username' => $_SESSION['username']]);
        $_SESSION['user'] = $user;

        return true;
    }


    /**
     * Return the user logged in.
     *
     * This method returns the user set in the session.
     *
     * @return User The user logged in.
     */
    public static function user()
    {
        if (!isset($_SESSION['user'])) {
            return null;
        }
        return $_SESSION['user'];
    }

    /**
     * Log out the user.
     *
     * This method unsets the user set in the session, effectively logging out the user.
     */
    public static function logout()
    {
        if (!isset($_SESSION['user'])) {
            return;
        }
        
        unset($_SESSION['user']);
    }
}
