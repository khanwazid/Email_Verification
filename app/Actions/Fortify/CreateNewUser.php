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
    }*/
  



    /*public function create(array $input): User
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
        'selected_file_name' => ['nullable', 'string'], // Add this line
    ])->validate();

    $userData = [
        'name' => $input['name'],
        'username' => $input['username'],
        'phone_number' => $input['phone'],
        'gender' => $input['gender'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ];

    if (isset($input['image']) && $input['image'] instanceof \Illuminate\Http\UploadedFile) {
        $userData['image'] = $input['image']->store('images', 'public');
    }

    return User::create($userData);
}*/
public function create(array $input): User
{
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255', 'unique:users'],
        'phone_number' => ['nullable', 'string', 'regex:/^[0-9]{10}$/'],
        'gender' => ['nullable', 'integer', 'in:0,1'],
        'uploaded_file_path' => ['nullable', 'string'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();

    $userData = [
        'name' => $input['name'],
        'username' => $input['username'],
        'phone_number' => $input['phone'],
        'gender' => $input['gender'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ];

    if (isset($input['uploaded_file_path'])) {
        $tempPath = $input['uploaded_file_path'];
        $newPath = 'images/' . basename($tempPath);
        Storage::disk('public')->move($tempPath, $newPath);
        $userData['image'] = $newPath;
    }

    return User::create($userData);
}



}
