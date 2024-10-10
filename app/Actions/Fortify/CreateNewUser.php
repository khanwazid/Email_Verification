<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Storage;
class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
   /* public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone_number' => ['nullable', 'string', 'regex:/^[0-9]{10}$/'],
            'gender' => ['nullable', 'integer', 'in:0,1'],
            'image' => ['nullable', 'image', 'max:2048'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'phone_number' => $input['phone'],
            'gender' => $input['gender'],
            'image' => $input['image'] ? $input['image']->store('images', 'public') : null,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }*/
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone_number' => ['nullable', 'string', 'regex:/^[0-9]{10}$/'],
            'gender' => ['nullable', 'integer', 'in:0,1'],
            'image' => ['nullable', 'image', 'max:2048'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $userData = [
            'name' => $input['name'],
            'username' => $input['username'],
            'phone_number' => $input['phone'] ,
            'gender' => $input['gender'] ,
            'email' => $input['email'],
           
            'password' => Hash::make($input['password']),
        ];

        if (isset($input['image']) && $input['image'] instanceof \Illuminate\Http\UploadedFile) {
            $userData['image'] = $input['image']->store('images', 'public');
        }
        return User::create($userData);
    }
}
