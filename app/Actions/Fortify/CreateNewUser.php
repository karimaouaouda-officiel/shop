<?php

namespace App\Actions\Fortify;

use App\Models\Adress;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name' => ['bail','required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'age' => ["required", "integer", "max:100"],
            'role' => ["required" , 'in:"seller","customer","admin"'],
            'country' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        if($input['role'] === "seller"){
            Validator::make($input , [
                'city' => ['required'],
                'adress_line_1' => ['required' , 'string' , 'max:255'],
                'adress_line_2' => ['nullable' , 'string' , 'max:255'],
                'code' => ['required' , 'integer']
            ])->validate();
        }

        $user = User::create([
            'first_name' => $input['first_name'] ,
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'age' => $input['age'],
            'role' => $input['role'],
            'password' => Hash::make($input['password']),
        ]);

        $adress = Adress::create([
            'user_id' => $user->id,
            'country' => $input['country'],
            'adress_line_1' => $input['adress_line_1'] ?? "",
            'adress_line_2' => $input['adress_line_2'] ?? "",
            'code' => $input['code'] ?? "",
            'city' => $input['city'] ?? ""
        ]);

        $adress->save();

        return $user;
    }
}


