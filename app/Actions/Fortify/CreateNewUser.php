<?php

namespace App\Actions\Fortify;

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
    // Validate the input
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone_number' => ['required', 'string', 'max:15', 'unique:users'],
        'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif|max:2048'],
        'gender' => ['required', 'integer', 'in:0,1'],

        'password' => $this->passwordRules(),
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
    ])->validate();

    $path = null;
    if (isset($input['image']) && $input['image']) {
        $path = $input['image']->store('images', 'public');
    }

    return User::create([
        'name' => $input['name'],
        'username' => $input['username'],
        'email' => $input['email'],
        'phone_number' => $input['phone_number'],
        'gender' => $input['gender'],
        'image' => $path,
        'password' => Hash::make($input['password']),
    ]);
}
}