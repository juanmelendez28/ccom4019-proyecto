<?php
require_once 'Model.php';
require_once 'models/Course.php';

class Department extends Model
{
    protected static $primary_key = 'dept_id';
    protected static $table = 'departments';


    /**
     * Finds all courses for the department and returns them as an array.
     * 
     * @return Course[] An array of Course objects that belong to the department.
     */
    public function courses()
    {
        try {
            return Course::findAll($this->attributes['dept_id'], 'dept_id', 'courses');
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }

    /**
     * Retrieves all department codes.
     * 
     * This method fetches all departments from the database and extracts
     * their codes into an array.
     * 
     * @return array An array of department codes.
     */

    public static function allCodes()
    {
        $departments = Department::all();

        $codes = [];
        foreach ($departments as $department)
            $codes[] = $department->dept_id;

        return $codes;
        
    }
}
