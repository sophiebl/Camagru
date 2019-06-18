<?php
class UserManager extends Model
{
    public function getUsers()
    {
        echo '  User manager  ';
        return $this->getAll('users', 'User');
    }
}