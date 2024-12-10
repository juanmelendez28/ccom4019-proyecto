<?php
require_once 'Controller.php';
require_once 'models/Department.php';
require_once 'models/User.php';
class CoursesController extends Controller
{

    public static function index()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        require_once 'views/courses.php';
        
    }

    public static function viewEditCourse()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        require_once 'views/course_edit.php';
        
    }

    public static function editCourse()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        require_once 'views/courses.php';
        
    }
}
