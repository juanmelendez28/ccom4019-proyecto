<?php
require_once 'Controller.php';
require_once 'models/Course.php';
require_once 'models/User.php';
require_once 'models/Department.php';

class DepartmentsController extends Controller
{
    public static function index($method)
    {
        if (isset($_GET['edit'])) {
            DepartmentsController::viewEditDepartment();
        } elseif (isset($_GET['create'])) {
            DepartmentsController::create($method);
        } elseif (isset($_GET['delete'])) {
            DepartmentsController::delete($method);
        } else {
            $user = User::findBy(['username' => 'admin']); // development data
            // after login works
            // $user = User::findBy(['username' => $_SESSION['username']]);
            $departments = Department::all();
            require_once 'views/departments.php';
        }
    }

    public static function viewEditDepartment()
    {
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        require_once 'views/department_edit.php';
    }

    public static function editDepartment()
    {
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        require_once 'views/departments.php';
    }

    public static function create($method)
    {

        if (!Auth::check()) redirect('?login');

        if ($method === 'POST') {
            // validation rules

            // department_name -> required, string
            // deparment_code -> required. string, 4 uppercase letters

            $department_name = filter_input(INPUT_POST, 'dept_name', FILTER_DEFAULT);
            $department_code = filter_input(INPUT_POST, 'dept_code', FILTER_DEFAULT);

            if (empty($department_name) || empty($department_code)) {
                $_SESSION['error'] = "Please fill all the fields";
                redirect_back();
            }

            if (!preg_match('/^[A-Z]{4}$/', $department_code)) {
                $_SESSION['error'] = "Please create a department code with 4 uppercase letters";
                redirect_back();
            }
            
            if (Department::exists(['dept_id' => $department_code])) {
                $_SESSION['error'] = 'The department already exists';
                redirect_back();
            }

            try {
                // try to create the department
                $success = Department::create([
                    'dept_id' => $department_code,
                    'dept_name' => $department_name
                ]);
            } catch (PDOException $e) {
                // this means the user tried to include an already existing department
                $_SESSION['error'] = "Please use unique values";
                redirect_back();
            }


            $success ?
                $_SESSION['success'] = "Department created successfully"
                : $_SESSION['error'] = 'There was an error while creating the department';

            redirect('?departments');
        } else {
            // method is GET

            require_once 'views/department_create.php';
        }
    }

    public static function delete($method)
    {
        $department = $_GET['delete'];
        $department = Department::find($department);
        require_once 'views/department_delete.php';
    }
}
