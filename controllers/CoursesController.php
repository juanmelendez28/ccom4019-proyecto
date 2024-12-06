<?php
require_once 'Controller.php';
require_once 'models/Department.php';
class CoursesController extends Controller
{

    public static function index()
    {
        $departments = Department::all();
        require_once 'views/courses.php';
        
    }
}
