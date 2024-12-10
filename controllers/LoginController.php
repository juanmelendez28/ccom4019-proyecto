<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'models/Model.php';
require_once 'controllers/CoursesController.php';

class LoginController extends Controller
{

    public static function index()
    {   
        require_once 'views/login.php';
    }
    public static function user_login()
    {   
        // get method post

        // CHANGING PASSWORD WITH HASHING //

        // $users = User::all();
        // foreach($users as $user){
        //     $hashed = password_hash("password", PASSWORD_DEFAULT);
        //     print($hashed);
        //     $user->update(['password' => $hashed]);
        // }

        
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
        {
            // CoursesController::index();
            LoginController::index();
        }
        
    }

    // method validate user
    public static function validate_password($username, $password)
    {

        $user = User::findBy(['username' => $username]);
        $stored_pass = $user->__get('password');

        return password_verify($password, $stored_pass);

        // Validating if got the user and password correct
        //TODO: Check what $user returns if empty
        if (isset($user))
            return true;
        else
            return false;
    }


}
