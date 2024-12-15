<?php
require_once 'Model.php';

class User extends Model
{
    protected static $primary_key = 'username'; // The primary key of the model
    protected static $hidden = ['password'];
    protected static $table = 'users';

    public static $validRoles = ['admin', 'chair', 'coordinator'];
}