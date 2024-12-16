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
        $currentTerm = Term::findBy(['term_is_active'=>true]);
        if (!$courses)
        {
            $message = "No courses found on term " . $currentTerm->term_id . ".";
        }
        else{
            $message = "Available courses on term " . $currentTerm->term_id . ":";
        }
        require_once 'views/enter_page.php';
    }

}
?>