<?php
require_once 'Model.php';
require_once 'models/Term.php';

class TermOffering extends Model
{
    /* Class  where term offering courses and management is done. */
    protected static $table = 'term_offering';
    protected static $primary_key = ['term_id', 'course_id'];

    public static function courses()
    {
        /* courses() returns a list of the courses that are on the active term */
        $active_term = Term::findBy(['term_is_active' => 1]);
        $active_term_id = $active_term->attributes['term_id'];

        $courses = [];

        try {
            // Query to find all courses on active term
            $courses_in_term = TermOffering::findAll($active_term_id, "term_id", "term_offering");
        } catch (Exception $e) {
            return $courses;
        }
        
        // Creating list of courses
        foreach($courses_in_term as $course)
        {
            $course_id = $course->attributes['course_id'];


            $courses[] = Course::findBy(['course_id' => $course_id]);

        }
        
        $departments = Department::all();
        return $courses;
    }

    public static function delete_course($course)
    {
        /* Function to delete a course on active term */
        try
        {
            $course_to_delete = TermOffering::findBy(['course_id' => $course]);
            $course_to_delete->deleteWhere(['course_id' => $course]);
        }
        catch(ModelNotFoundException $e)
        {
        }
    }
}
?>