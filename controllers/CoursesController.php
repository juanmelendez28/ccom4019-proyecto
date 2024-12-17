<?php
require_once 'Controller.php';
require_once 'models/Department.php';
require_once 'models/User.php';
require_once 'models/Course.php';
require_once 'models/Term_Offering.php';
class CoursesController extends Controller
{

    public static function index($method)
    { // take the appropiate path depending on the user selected action
        if (isset($_GET['edit'])) {
            CoursesController::update($method);
        } elseif (isset($_GET['delete'])) {
            CoursesController::delete($method);
        } elseif (isset($_GET['create'])) {
            CoursesController::create($method);
        } else { // when no action is chosen, display the general courses page
            $active_term_courses = TermOffering::courses();
            $active_courses = [];
            foreach ($active_term_courses as $course) { // get the courses on the currently active term
                $active_courses[] = $course->values['course_id'];
            }
            $departments = Department::all(); // get all departments
            require_once 'views/courses.php';
        }
    }

    public static function get_courses()
    {
        $courses = Course::all(); // get all courses
        return $courses;
    }

    public static function update($method)
    {

        if ($method == "POST") { // if the page loads from a form, process the received information
            $course_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $credits = filter_input(INPUT_POST, 'credits', FILTER_VALIDATE_INT);
            $desc = filter_input(INPUT_POST, 'desc', FILTER_DEFAULT);
            $course = Course::find($course_id);

            if (empty($name) || empty($credits) || empty($desc || empty($course_id))) {
                $_SESSION['error'] = 'All fields are required';
                redirect_back(); // when inputs are empty the user will be redirected
            }

            if ($credits < 1) {
                $_SESSION['error'] = 'Credits must be higher or equal than 1';
                redirect_back(); // if credits are invalid the user will be redirected
            }

            try { // BBCode will parse the prerequisites from the description input and process them
                $description_bbcode = parseBBCode($desc, ['unkeyed', 'Prerequisites']);
            } catch (MissingKeysException $e) {
                $_SESSION['error'] = 'Missing: ' . implode(', ', $e->missing_keys);
                redirect_back();
            }



            $failed = $course->updatePrerequisites($description_bbcode['Prerequisites']);

            if (sizeof($failed) > 0) { 
                $_SESSION['error'] = 'Failed to add prerequisite(s) ' .
                    implode(', ', $failed) .
                    ' must be 4 uppercase letters followed by 4 numbers';
                redirect_back(); // the user will be redirected if any prerequisites are invalid
            }

            // this will update and save the course new information
            $success = $course->update([
                'course_name' => $name,
                'course_credits' => $credits,
                'course_desc' => $description_bbcode['unkeyed'],
                'updated_by' => Auth::user()->username
            ]);

            $success ? // a success or error message will display depending on the outcome
                $_SESSION['success'] = 'Changed course information successfully' :
                $_SESSION['error'] = 'Failed to change course information';

            redirect('?courses');
        } else { // if the page doesn't load from a form, load the editing form
            $course_id = $_GET['edit']; // receive the id of the course to be edited
            try {
                $course = Course::find($course_id); // find the course information
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'The course does not exist';
                redirect('?courses'); // redirect the user if the course is not found
            }

            if (!Auth::checkAdmin() && Auth::user()->dept_id !== $course->dept_id) {
                // if the user is NOT admin or shares the course department
                $_SESSION['error'] = 'You don\'t have permissions to edit this course.';
                redirect('?courses');
            }

            require_once 'views/course_edit.php'; // display the page to edit a course
        }
    }

    public static function create($method)
    {
        if (!Auth::check()) { // if the user is not authenticated display an error
            $_SESSION['error'] = 'View not found';
            redirect('index.php?courses');
        }

        if ($method === "POST") { // if the page loads from a form, process the received information
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
            $code = filter_input(INPUT_POST, 'code', FILTER_DEFAULT); // this must be unique
            $credits = filter_input(INPUT_POST, 'credits', FILTER_VALIDATE_INT);
            $description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
            $department = filter_input(INPUT_POST, 'department', FILTER_DEFAULT);

            // validate here the specific inputs

            // validating for required fields
            if (empty($name) || empty($code) || empty($credits) || empty($description) || empty($department)) {
                $_SESSION['error'] = 'All fields are required';
                redirect_back();
            }

            if (Course::exists(['course_id' => $code])) {
                $_SESSION['error'] = 'The course already exists';
                redirect_back();
            }

            if ($credits < 1) {
                $_SESSION['error'] = 'Credits must be higher or equal than 1';
                redirect_back();
            }

            // validating for department code
            if (!is_valid_course_code($code)) {
                $_SESSION['error'] = 'The course code must be 4 uppercase letters followed by 4 digits';
                redirect_back();
            }

            if (!Auth::checkAdmin() && Auth::user()->dept_id !== $department) {
                $_SESSION['error'] = 'You are not allowed to create a course in this department';
                redirect_back();
            }

            try {
                $department = Department::find($department);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'The department does not exist';
                redirect_back();
            }

            // reading the description as BBC
            try {
                $bbc_description = parseBBCode($description, ['unkeyed']);
            } catch (MissingKeysException $e) {
                $_SESSION['error'] = 'Missing keys: ' . implode(', ', $e->missing_keys);
                redirect_back();
            }



            // Creating the course

            try {
                $newCourse = Course::create([
                    'course_name' => $name,
                    'course_id' => $code,
                    'course_credits' => $credits,
                    'course_desc' => $bbc_description['unkeyed'],
                    'dept_id' => $department->dept_id,
                    'updated_by' => Auth::user()->username,
                ]);
            } catch (PDOException $e) {
                $_SESSION['error'] = "Please enter unique values";
                redirect_back();
            }


            // Adding the prerequisite

            if (in_array('Prerequisites', array_keys($bbc_description))) {
                $prerequisites = $bbc_description['Prerequisites'];
                foreach ($prerequisites as $prerequisite) {
                    $newCourse->addPrerequisite($prerequisite);
                }
            }

            $_SESSION['success'] = 'Course created successfully';
            redirect('?courses');
        } else {

            // check if the user can create the course of the department
            if (empty($_GET['create']) && !Auth::checkAdmin()) {
                $_SESSION['error'] = 'Specify a department to create a course';
                redirect('?courses');
            }

            if (!Auth::checkAdmin() && Auth::user()->dept_id !== $_GET['create']) {
                $_SESSION['error'] = 'You don\'t have permissions to create a course of this department';
                redirect('?courses');
            }
            $departments = Department::all();
            require_once 'views/course_create.php';
        }
    }

    public static function delete($method)
    {
        $course = $_GET['delete']; // receive the course id to be deleted
        try {
            $course = Course::find($course); // find the course informatoin
        } catch (ModelNotFoundException $e) {
            $_SESSION['error'] = 'The course does not exist';
            redirect('?courses'); // redirect the user if the course is not found
        }
        $result = TermOffering::delete_course($course->values['course_id']); // delete course
        require_once 'views/course_delete.php';
    }
}
