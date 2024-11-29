<?php
require_once 'Model.php';

class User extends Model
{
    
    protected static $hidden = ['password'];
}