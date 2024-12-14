<?php
require_once 'Model.php';
require_once 'Prerequisite.php';

class Course extends Model
{
    protected static $primary_key = 'course_id';
    protected static $table = 'courses';





    /**
     * Finds all prerequisites for the course and returns them as an array.
     * 
     * @return Prerequisite[] An array of Prerequisite objects that belong to the course.
     */
    public function prerequisites()
    {
        try {
            return Prerequisite::findAll($this->attributes['course_id'], 'course_id');
        } catch (ModelNotFoundException $e) {
            return [];
        }
    }


    /**
     * Returns a list of prerequisite course names for this course.
     * 
     * @return array An array of prerequisite course names.
     */
    public function prerequisites_as_list()
    {
        // this will obtain a course->prerequisite object array
        $courses_prerequisite = $this->prerequisites();
        $prerequisites = [];

        // all objects will contain the instantiated course and then the prerequisites
        foreach ($courses_prerequisite as $me)
            $prerequisites[] = $me->prerequisite;

        return $prerequisites;
    }


    /**
     * Returns the course description in BBCode format.
     *
     * This method combines the course description with its prerequisites in a
     * single string. The prerequisites are formatted as a list inside a
     * [list] bbcode tag.
     *
     * @return string The course description in BBCode format.
     */
    public function description_bbcode()
    {
        return toBBCode([
            'unkeyed' => $this->attributes['course_desc'],
            'Prerequisites' => $this->prerequisites_as_list()
        ]);
    }

    /**
     * Adds a prerequisite course to the course.
     * 
     * @param string $prerequisite_id The course code of the prerequisite course.
     * @return bool True if the prerequisite was added, false otherwise.
     * 
     * This method will return false if the prerequisite is empty or if it does not
     * conform to the course code format. It will also return false if the
     * prerequisite is already added to the course.
     */
    public function addPrerequisite($prerequisite_id)
    {

        if (empty($prerequisite_id)) return false;
        if (!is_valid_course_code($prerequisite_id)) return false;

        // validating if already added
        $my_prerequisites = $this->prerequisites_as_list();
        if (in_array($prerequisite_id, $my_prerequisites)) return false;

        return Prerequisite::create([
            'course_id' => $this->course_id,
            'prerequisite' => $prerequisite_id
        ]);
    }


    /**
     * Updates the prerequisites of a course. If a prerequisite is not present
     * in the array passed as argument, it will be removed from the course.
     * If it is present, it will be added if it is not already present.
     * 
     * @param string[] $prerequisites An array of course codes of the
     * prerequisites to be associated with the course.
     * @return void
     */
    public function updatePrerequisites($new_prerequisites)
    {
        $current_prerequisites = $this->prerequisites_as_list();

        $to_add = array_diff($new_prerequisites, $current_prerequisites);
        $to_remove = array_diff($current_prerequisites, $new_prerequisites);

        foreach ($to_add as $add) {
            $this->addPrerequisite($add);
        }

        foreach ($to_remove as $remove) {

            try {
                Prerequisite::findBy(['course_id' => $this->course_id, 'prerequisite' => $remove])
                    ->deleteWhere(['course_id' => $this->course_id, 'prerequisite' => $remove]);
            } catch (ModelNotFoundException $e) {
                // ignore if the prerequisite does not exist
                continue;
            }
        }
    }
}
