<?php
require_once 'Model.php';

require_once 'models/Department.php';

class Course extends Model
{
    protected static $primary_key = 'course_id';
    protected static $table = 'courses';
    
}