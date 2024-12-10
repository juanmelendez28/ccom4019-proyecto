<?php
require_once 'Model.php';

class User extends Model
{
    protected static $primary_key = 'username'; // The primary key of the model
    protected static $hidden = ['password'];
}