<?php
require_once 'Controller.php';
require_once 'models/Course.php';
require_once 'models/User.php';
require_once 'models/Department.php';

class DepartmentsController extends Controller
{

    public static function index()
    {   
        if(isset($_GET['edit'])) {
            DepartmentsController::viewEditDepartment();
        } elseif(isset($_GET['delete'])) {

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
}
