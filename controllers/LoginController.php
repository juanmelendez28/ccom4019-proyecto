<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'models/Model.php';
require_once 'controllers/CoursesController.php';

class LoginController extends Controller
{

    public static function index()
    {   
        // $users = User::all(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        // $departments = Department::all();
        // require_once 'views/departments.php';
        
        require_once 'views/login.php';
    }
    public static function user_login()
    {   
        // get method post

        // $users = User::all(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        // $departments = Department::all();

        // Check if the form is submitted
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect data from the form
            $username = $_POST['username'];
            $password = $_POST['pass'];

            // Validate the data
            if (empty($username) || empty($password)) {
                die("All fields are required.");
                LoginController::index();
            }
        }

        if(LoginController::validate_password($username, $password)) 
        {
            $_SESSION['user'] = User::findBy(['username' => $username]);
            CoursesController::index();
        }
        
        else
            LoginController::index();
        
    }

    // method validate user
    public static function validate_password($username, $password)
    {
        // $pass_hashed = password_hash($password, PASSWORD_DEFAULT);

        $user = User::findBy(['username' => $username, 'password' => $password]);

        // Validating if got the user and password correct
        //TODO: Check what $user returns if empty
        if (isset($user))
            return true;
        else
            return false;
    }


}
