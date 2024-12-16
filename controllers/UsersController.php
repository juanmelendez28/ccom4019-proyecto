<?php
require_once 'Controller.php';
require_once 'models/Course.php';
require_once 'models/User.php';
require_once 'models/Department.php';
require_once 'models/Term.php';

class UsersController extends Controller
{

    public static function index($method)
    {
        if (isset($_GET['edit'])) {
            UsersController::viewEditUser($method);
        } elseif (isset($_GET['create'])) {
            UsersController::create($method);
        } elseif (isset($_GET['delete'])) {
            UsersController::delete($method);
        } else {
            $currentUser = User::findBy(['username' => 'admin']); // development data
            // after login works
            // $user = User::findBy(['username' => $_SESSION['username']]);
            $users = User::all();
            require_once 'views/users.php';
        }
    }

    public static function viewEditUser($method)
    {

        if ($method === 'POST') {

            $username = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $role = filter_input(INPUT_POST, 'role', FILTER_DEFAULT);
            $dept_id = filter_input(INPUT_POST, 'dept_id', FILTER_DEFAULT);

            try {
                $userToEdit = User::find($username);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'User not found';
                redirect('?users');
            }

            if (empty($name) || empty($role) || empty($dept_id)) {
                $_SESSION['error'] = 'All fields are required';
                redirect('?users');
            } elseif (!Auth::checkAdmin()) {
                $_SESSION['error'] = 'You do not have permission to edit this user';
                redirect('?users');
            } else {
                // this will update and save the user new information
                $success = $userToEdit->update([
                    'name' => $name,
                    'role' => $role,
                    'dept_id' => $dept_id
                ]);

                $success ? $_SESSION['success'] = 'Changed user information successfully' : $_SESSION['error'] = 'Failed to change user information';
                redirect('?users'); // having problems redirecting here (post redirect get???)
            }
        } else {
            // method is get
            if (isset($_GET['edit'])) {
                try {
                    $userToEdit = User::findBy(['username' => $_GET['edit']]);
                } catch (ModelNotFoundException $e) {
                    $_SESSION['error'] = 'User not found';
                    redirect('?users');
                }

                $departments = Department::all();
                $valid_roles = User::$validRoles;
                require_once 'views/user_edit.php';
            } else {
                $_SESSION['error'] = 'Please indicate a user';
                redirect_back();
            }
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
             * username: unique
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


            if (User::exists(['username' => $username])) {
                $_SESSION['error'] = 'The user already exists';
                redirect_back();
            }


            // all tests passed! creating the user

            try {
                $success = User::create([
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'name' => $name,
                    'role'  => $role,
                    'dept_id' => $department,
                    'last_login' => date('Y:m:d H:m:s')
                ]);
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Please enter unique values';
                redirect_back();
            }

            if ($success) {
                $_SESSION['success'] = 'User created successfully';
                redirect('?users');
            } else {
                $_SESSION['error'] = 'There was an error while creating the user';
                redirect_back();
            }
        } else {
            // show the form here
            $valid_roles = User::$validRoles;
            require_once('views/user_create.php');
        }
    }

    public static function delete($method)
    {
        $user = $_GET['delete'];
        try {
            $user = User::find($user);
        } catch (ModelNotFoundException $e) {
            $_SESSION['error'] = 'User not found';
            redirect('?users');
        }
        require_once 'views/user_delete.php';
    }
}
