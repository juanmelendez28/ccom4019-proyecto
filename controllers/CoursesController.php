<?php
require_once 'Controller.php';
require_once 'models/Department.php';
require_once 'models/User.php';
require_once 'models/Course.php';
class CoursesController extends Controller
{

    public static function index()
    {   
        if(isset($_GET['edit'])) {
            CoursesController::viewEditCourse();
        } elseif(isset($_GET['delete'])) {
            CoursesController::viewDeleteCourse();
        } else {
            $user = User::findBy(['username' => 'admin']); // development data
            // after login works
            // $user = User::findBy(['username' => $_SESSION['username']]);
            $departments = Department::all();
            require_once 'views/courses.php';
        }
    }

    public static function update($method)
    {

        if ($method == "POST") {
            $course_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $credits = filter_input(INPUT_POST, 'credits', FILTER_VALIDATE_INT);
            $desc = filter_input(INPUT_POST, 'desc', FILTER_DEFAULT);
            $course = Course::find($course_id);

            if (empty($name) || empty($credits) || empty($desc || empty($course_id))) {
                $_SESSION['error'] = 'All fields are required';
                redirect_back();
            }

            try {
                $description_bbcode = parseBBCode($desc, ['unkeyed', 'Prerequisites']);
            } catch (MissingKeysException $e) {
                $_SESSION['error'] = 'Missing: ' . implode(', ', $e->missing_keys);
                redirect_back();
            }

            $course->updatePrerequisites($description_bbcode['Prerequisites']);

            // this will update and save the course new information
            $success = $course->update([
                'course_name' => $name,
                'course_credits' => $credits,
                'course_desc' => $description_bbcode['unkeyed'],
                'updated_by' => Auth::user()->username
            ]);

            $success ?
                $_SESSION['success'] = 'Changed course information successfully' :
                $_SESSION['error'] = 'Failed to change course information';

            redirect_back();
        } else {
            $course_id = $_GET['edit'];
            $course = Course::find($course_id);
            require_once 'views/course_edit.php';
        }
    }

    public static function editCourse()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        require_once 'views/courses.php';
        
    } // cuando vaya a hacer la funcion de delete, y en la de edit tambien 
    // hay que anadirlo, hacer lo de post redirect get para que no te pregunte el resubmission

    public static function viewDeleteCourse()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        if (isset($_GET['delete'])) {
        $course = Course::findBy(['course_id' => $_GET['delete']]);
        require_once 'views/course_delete.php';
        }
    }

    public static function deleteCourse()
    {   
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        $departments = Department::all();
        require_once 'views/courses.php';
        
    } 
}
