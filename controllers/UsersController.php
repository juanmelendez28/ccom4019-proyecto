<?php
require_once 'Controller.php';
require_once 'models/Course.php';
require_once 'models/User.php';
require_once 'models/Department.php';
require_once 'models/Term.php';

class UsersController extends Controller
{

    public static function index()
    {   
        $currentUser = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $users = User::all();
        require_once 'views/users.php';
        
    }
}
