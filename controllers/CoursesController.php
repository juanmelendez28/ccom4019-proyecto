<?php
require_once 'Controller.php';
require_once 'models/Department.php';
require_once 'models/User.php';
class CoursesController extends Controller
{

    public static function index()
    {   
        $user = User::findBy(['username' => 'rebeca.franqui']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        require_once 'views/courses.php';
        
    }
}
