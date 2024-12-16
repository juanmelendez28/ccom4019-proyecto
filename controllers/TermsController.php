<?php
require_once 'Controller.php';
require_once 'models/User.php';
require_once 'models/Department.php';
require_once 'models/Term.php';
require_once 'models/Term_Offering.php';
require_once 'controllers/CoursesController.php';

class TermsController extends Controller
{

    public static function index($method)
    {   
        if(isset($_GET['edit'])) {
            TermsController::update($method);
        } elseif(isset($_GET['delete'])) {
            TermsController::delete($method);
        } elseif(isset($_GET['activate'])) {
            TermsController::activate($method);
        } elseif(isset($_GET['create'])) {
            TermsController::create($method);
        } else {
            $user = User::findBy(['username' => 'admin']); // development data
            // after login works
            // $user = User::findBy(['username' => $_SESSION['username']]);
            $terms = Term::all();
            require_once 'views/terms.php';
        }
    }

    public static function update($method)
    {

        if ($method == "POST") {
            $term_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);

            if (empty($description)) {
                $_SESSION['error'] = 'All fields are required';
                redirect_back();
            }

            // this will update and save the course new information
            $term = Term::find($term_id);
            $success = $term->update([
                'description' => $description,
            ]);

            $success ?
                $_SESSION['success'] = 'Changed term information successfully' :
                $_SESSION['error'] = 'Failed to change term information';

                $terms = Term::all();
                require_once 'views/terms.php';
        } else {
            $term_id = $_GET['edit'];
            $term = Term::find($term_id);
            require_once 'views/term_edit.php';
        }
    }

    public static function delete($method)
    {
        $term = $_GET['delete'];
        $term = Term::find($term);
        require_once 'views/term_delete.php';
    }

    public static function activate($method)
    {
        $term = $_GET['activate'];
        $term = Term::find($term);
        require_once 'views/term_activate.php';
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


?>