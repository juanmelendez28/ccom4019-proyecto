<?php
require_once 'Controller.php';
require_once 'models/Course.php';
require_once 'models/User.php';
require_once 'models/Department.php';

class DepartmentsController extends Controller
{
    public static function index($method)
    { // take the appropiate path depending on the user selected action
        if (isset($_GET['edit'])) {
            DepartmentsController::update();
        } elseif (isset($_GET['create'])) {
            DepartmentsController::create($method);
        } elseif (isset($_GET['delete'])) {
            DepartmentsController::delete($method);
        } else { // when no action is chosen, display the general departments page
            $departments = Department::all();
            require_once 'views/departments.php';
        }
    }

    public static function update()
    {
        if ($_GET['edit'] && $_SERVER['REQUEST_METHOD'] != 'POST') {
            require_once 'models/Department.php';
            if (empty($_GET['edit']) || !Department::exists(['dept_id' => $_GET['edit']])) {
                $_SESSION['error'] = 'Please indicate a department to edit';
                redirect('?departments');
            }
            
            $department_id = $_GET['edit'];
    
    
            try {
                $department = Department::find($department_id);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'Department code does not match any record';
                redirect('?departments');
            }
        require_once 'views/department_edit.php';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $department_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    
            try {
                $department = Department::find($department_id);
            } catch (ModelNotFoundException $e) {
                // this means the input for department code was forcefully changed
                $department = null;
                $_SESSION['error'] = 'Department code does not match any record';
                redirect('?departments');
            }
    
            if (empty($name) || !$department) {
                $_SESSION['error'] = 'All fields are required';
                redirect('?departments&edit=' . $department_id);
            } else {
                // this will update and save the department new information
                $success = $department->update([
                    'dept_name' => $name,
                ]);
    
                $success ? $_SESSION['success'] = 'Changed department information successfully' : $_SESSION['error'] = 'Failed to change department information';
                redirect('?departments');
            }
        }
    }

    public static function editDepartment()
    {
        $user = User::findBy(['username' => 'admin']); // development data
        // after login works
        // $user = User::findBy(['username' => $_SESSION['username']]);
        require_once 'views/departments.php';
    }

    public static function create($method)
    {

        if (!Auth::check()) redirect('?login');

        if ($method === 'POST') {
            // validation rules

            // department_name -> required, string
            // deparment_code -> required. string, 4 uppercase letters

            $department_name = filter_input(INPUT_POST, 'dept_name', FILTER_DEFAULT);
            $department_code = filter_input(INPUT_POST, 'dept_code', FILTER_DEFAULT);

            if (empty($department_name) || empty($department_code)) { 
                $_SESSION['error'] = "Please fill all the fields";
                redirect_back(); // the user will be redirected if any fields are empty
            }

            if (!preg_match('/^[A-Z]{4}$/', $department_code)) { 
                $_SESSION['error'] = "Please create a department code with 4 uppercase letters";
                redirect_back(); // the user will be redirected if the department code is not valid
            }

            if (Department::exists(['dept_id' => $department_code])) {
                $_SESSION['error'] = 'The department already exists';
                redirect_back();
            }

            try {
                // try to create the department
                $success = Department::create([
                    'dept_id' => $department_code,
                    'dept_name' => $department_name
                ]);
            } catch (PDOException $e) {
                // this means the user tried to include an already existing department
                $_SESSION['error'] = "Please use unique values";
                redirect_back();
            }


            $success ?
                $_SESSION['success'] = "Department created successfully"
                : $_SESSION['error'] = 'There was an error while creating the department';

            redirect('?departments');
        } else {
            // method is GET

            require_once 'views/department_create.php';
        }
    }

    public static function delete($method)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $department_id = filter_input(INPUT_POST, 'id', FILTER_DEFAULT);
            $department = $_GET['delete'];

            try {
                $department = Department::find($department); // find the department to be deleted
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'The department does not exist';
                redirect('?departments'); // redirect the user if the department is not found
            }

            if(sizeof($department->courses()) > 0){
                $_SESSION['error'] = 'Cannot delete department with courses';
                redirect('?departments');
            }

            $success = $department->delete();

            $success ? $_SESSION['success'] = 'Department deleted successfully' : $_SESSION['error'] = 'Failed to delete department';
            $departments = Department::all();
            redirect('?departments');
        } else {
            $department = $_GET['delete'];
            try {
                $department = Department::find($department); // find the department to be deleted
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'The department does not exist';
                redirect('?departments'); // redirect the user if the department is not found
            }
            require_once 'views/department_delete.php';
        }
    }
}
