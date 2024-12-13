<?php
require_once 'Model.php';
require_once 'models/Term.php';

class TermOffering extends Model
{
    protected static $table = 'term_offering';

    public static function courses()
    {
        echo "Entered courses function.";
        $active_term = Term::findBy(['term_is_active' => 1]);
        $active_term_id = $active_term->attributes['term_id'];
        // echo $active_term_id;
        // dd($active_term); 
        // echo "After active term";
        $courses_in_term = TermOffering::findAll($active_term_id, "term_id", "term_offering");
        // dd($courses_in_term);  
        // echo "After terms";

        $courses = [];
        foreach($courses_in_term as $course)
        {
            // dd($term);
            $course_id = $course->attributes['course_id'];
            echo $course_id;
            $courses[] = Course::find($course_id, 'course_id');
            echo "In for";
            // dd($courses);  
        }
        
        $departments = Department::all();
        return $courses;
    }
}
?>