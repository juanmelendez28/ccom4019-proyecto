<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'models/Model.php';
require_once 'controllers/CoursesController.php';

class LoginController extends Controller
{

    public static function index()
    {
        if (Auth::check()) {
            // user is already logged in:
            redirect('?courses');
        }

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
        // dd('HASHED');



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Collect data from the form
            $username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
            $password = filter_input(INPUT_POST, 'pass', FILTER_DEFAULT);

            // Validate the data
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Please fill in all fields';
                redirect_back();
            }
        }

        if (LoginController::validate_password($username, $password)) {

            $loggedUser = User::findBy(['username' => $username]);
            $loggedUser->update([
                'last_login' => date('Y-m-d H:i:s')
            ]);

            Auth::login($loggedUser);

            CoursesController::index($_SERVER['REQUEST_METHOD']);
        } else {
            // CoursesController::index();
            $_SESSION['error'] = 'Invalid username or password';
            redirect_back();
        }
    }

    // method validate user
    public static function validate_password($username, $password)
    {

        try {
            $user = User::findBy(['username' => $username]);
        } catch (ModelNotFoundException $e) {
            $_SESSION['error'] = 'Invalid username or password';
            redirect_back();
        }
        $stored_pass = $user->__get('password');
        return password_verify($password, $stored_pass);
    }
}
