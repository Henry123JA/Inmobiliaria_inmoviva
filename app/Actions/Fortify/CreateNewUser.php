<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Carbon\Carbon;
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
            'name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:70', 'unique:users'],            
            'password' => $this->passwordRules(),
            'birth_date' => ['required', 'date', function ($attribute, $value, $fail) {
                // Validación para asegurarse de que el usuario tiene al menos 18 años
                $birthDate = Carbon::parse($value);
                if ($birthDate->diffInYears(Carbon::now()) < 18) {
                    return $fail('Debes ser mayor de 18 años para registrarte.');
                }
            }],
            'terms' => ['accepted'], 
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'birth_date' => Carbon::parse($input['birth_date']),
        ]);

        return $user;
    }
}
