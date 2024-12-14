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
        if(isset($_GET['edit'])) {
            UsersController::viewEditUser();
        } elseif(isset($_GET['delete'])) {

        } else {
            $currentUser = User::findBy(['username' => 'admin']); // development data
            // after login works
            // $user = User::findBy(['username' => $_SESSION['username']]);
            $users = User::all();
            require_once 'views/users.php';
        }
    }

    public static function viewEditUser()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        if(isset($_GET['edit'])) {
            $userToEdit = User::findBy(['username' => $_GET['edit']]);
            $departments = Department::all();
            require_once 'views/user_edit.php';
        } else {
            // some error message
        }
        
    }

    public static function editUser()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        require_once 'views/users.php';
        
    } 
}
