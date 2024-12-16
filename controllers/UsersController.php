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
        if (isset($_GET['edit'])) {
            UsersController::viewEditUser();
        } elseif (isset($_GET['create'])) {
            UsersController::create($_SERVER['REQUEST_METHOD']);
        } elseif (isset($_GET['delete'])) {
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
        if (isset($_GET['edit'])) {
            $userToEdit = User::findBy(['username' => $_GET['edit']]);
            $departments = Department::all();
            $valid_roles = User::$validRoles;
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
        $departments = Department::all();;
        require_once 'views/users.php';
    }

    public static function create($method)
    {
        $departments = Department::all();
        if ($method === 'POST') {
            // create the user here

            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
            $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
            $role = filter_input(INPUT_POST, 'role', FILTER_DEFAULT);
            $department = filter_input(INPUT_POST, 'dept_id', FILTER_DEFAULT);

            

            if (empty($name) || empty($username) || empty($password) || empty($role) || empty($department)) {
                $_SESSION['error'] = "Please fill all the fields";
                redirect_back();
            }

            /*
             * validation rules:
             * password: required, 8 characters minimum
             * role: either chair or coordinator
             * department: must exist on the database
             */


            if (strlen($password) < 8) {
                $_SESSION['error'] = 'Password must be 8 characters or more';
            }

            if (!in_array($role, User::$validRoles)) {
                $_SESSION['error'] = "Unknown role: $role";
                redirect_back();
            }

            if (!in_array($department, Department::allCodes())) {
                $_SESSION['error'] = "Unknown department: $department";
            }


            // all tests passed! creating the user

            $success = User::create([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'name' => $name,
                'role'  => $role,
                'dept_id' => $department,
                'last_login' => date('Y:m:d H:m:s')
            ]);

            if($success){
                $_SESSION['success'] = 'User created successfully';
                redirect('?users');
            } else{
                $_SESSION['error'] = 'There was an error while creating the user';
                redirect_back();
            }


        } else {
            // show the form here
            $valid_roles = User::$validRoles;
            require_once('views/user_create.php');
        }
    }
}
