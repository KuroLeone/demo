<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            /* 'id',
        'username',
        'email',
        'fname',
        'lname',
        'telephone',
        'gender',
        'DOB',
        
    ];*/
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'telephone' =>$input['telephone'],
            'gender' =>$input['gender'],
            'DOB' =>$input['DOB'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
