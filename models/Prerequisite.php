<?php
require_once 'Model.php';

class Prerequisite extends Model
{
    protected static $table = 'prerequisites';
    protected static $primary_key = 'course_id';
    
}