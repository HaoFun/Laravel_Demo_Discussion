<?php
namespace App\Repositories;
use App\User;

class UserRepository
{
    public function confrim($confirm_code)
    {
        return User::where('confirm_code',$confirm_code)->first();
    }

    public function getUserByID($id)
    {
        return User::findOrFail($id);
    }
}