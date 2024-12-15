<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'models/Department.php';
require_once 'models/Term.php';
require_once 'models/Term_Offering.php';
require_once 'controllers/CoursesController.php';

class TermsController extends Controller
{

    public static function index()
    {
        if (isset($_GET['create'])) {
            TermsController::create($_SERVER['REQUEST_METHOD']);
        } else {

            $user = User::findBy(['username' => 'admin']); // development data
            // after login works
            // $user = User::findBy(['username' => $_SESSION['username']]);
            $terms = Term::all();
            require_once 'views/terms.php';
        }
    }

    public static function create($method)
    {
        if ($method === 'POST') {
            // create the term here
            $term = filter_input(INPUT_POST, 'term', FILTER_DEFAULT);
            $description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);

            /**
             * Validation rules:
             * term: required, must consist of one uppercase character and two numbers
             * description: required
             */

            if (empty($term) || empty($description)) {
                $_SESSION['error'] = 'Please fill all the fields';
                redirect_back();
            }

            if(!preg_match('/^[A-Z]{1}[0-9]{2}$/', $term)){
                $_SESSION['error'] = 'Terms must consist of an uppercase letter and two numbers (E.g C41)';
                redirect_back();
            }

            // all validation has passed, creating the term
            $success = Term::create([
                'term_id' => $term,
                'term_desc' => $description,
                'term_is_active' => false
            ]);

            if ($success){
                $_SESSION['success'] = 'Created term successfully';
                redirect('?terms');
            } else {
                $_SESSION['error'] = 'There was an error while creating the term';
                redirect_back();
            }

        } else {
            // show the create form here
            require_once 'views/term_create.php';
        }
    }
}
