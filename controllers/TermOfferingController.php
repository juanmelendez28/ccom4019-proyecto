<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'models/Department.php';
require_once 'models/Term.php';
require_once 'models/Term_Offering.php';
require_once 'controllers/CoursesController.php';

class TermOfferingController extends Controller
{

    public static function index()
    {   
        $courses = TermOffering::courses();
        if (!$courses)
        {
            echo "No courses found on active term.";
        }
        else
            require_once 'views/enter_page.php';
    }

}
?>