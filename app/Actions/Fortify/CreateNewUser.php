<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Modules\Main\Http\Logics\UsersLogic;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    public function create(array $input): User
    {
        $validated=Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class),],
            'phone' => ['required', 'numeric', Rule::unique(User::class),],
           'username' => ['required', 'string', 'max:255', Rule::unique(User::class),],


            'password' => $this->passwordRules(),
        ]);
        $validated->validate();
        return (new UsersLogic())->registerUser($validated->validated())->data;
    }
}
