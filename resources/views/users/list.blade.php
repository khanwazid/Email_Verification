<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Profile</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('profiles.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white"> Profile</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('profiles.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control-lg form-control" placeholder="Name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Username</label>
                                <input value="{{ old('username') }}" type="text" class="@error('username') is-invalid @enderror form-control form-control-lg" placeholder="Username" name="username">
                                @error('username')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Email</label>
                                <input value="{{ old('email') }}" type="text" class="@error('email') is-invalid @enderror form-control form-control-lg" placeholder="Email" name="email">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Phone</label>
                                <input value="{{ old('phone') }}" type="text" class="@error('phone') is-invalid @enderror form-control form-control-lg" placeholder="Phone" name="phone">
                                @error('phone')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Password</label>
                                <input value="{{ old('password') }}" type="text" class="@error('password') is-invalid @enderror form-control form-control-lg" placeholder="Password" name="password">
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                           
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
    


  </body>
 

<script src="{{ asset('js/script.js') }}"></script>
</html>


@php
    
{{--  


<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\AddressResource;
use Illuminate\Support\Facades\Validator;
use Exception;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'username' => 'required|string|unique:users|max:255',
                'phone_number' => 'nullable', 'string', 'regex:/^[0-9]{10}$/',
                'gender' => 'nullable', 'integer', 'in:0,1',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->username = $request->username;
            $user->phone_number = $request->phone_number;
            $user->gender = $request->gender;
           

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/profile-photos', $imageName);
                $user->image = 'profile-photos/' . $imageName;
            }

            if ($user->save()) {
                $token = $user->createToken('auth_token')->plainTextToken;
                
                return response()->json([
                    'status' => true,
                    'message' => 'User registered successfully',
                    'data' => new UserResource($user),
                    'token' => $token
                ], 201);
            }

            return response()->json([
                'status' => false,
                'message' => 'Registration failed',
                'errors' => ['Failed to save user to database']
            ], 400);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Registration failed',
                'errors' => [$e->getMessage()]
            ], 500);
        }
    }

  public function login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to authenticate the user
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Generate the authentication token
        $token = $request->user()->createToken('auth_token')->plainTextToken;

        // Retrieve the authenticated user data
        $user = $request->user();
        $user = $request->user()->load('addresses');

        // Return the token and the transformed user data using the UserResource
        return response()->json([
            'token' => $token,
            'user' => new UserResource($user), // Transform the user data using UserResource
            'message' => 'Login successful',
        ]);
    }*/ 

    

     public function login(Request $request)
{
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    // If validation fails, return formatted validation errors
    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
            'message' => 'Validation failedf'
        ], 422);
    }

    // Attempt to authenticate the user
    if (!Auth::attempt($request->only(['email', 'password']))) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Get the authenticated user using $request->user()
    $user = $request->user();

    // Load the user with addresses (ensure the relationship exists in the User model)
    $user->load('addresses');

    // Generate the authentication token
    $token = $user->createToken('auth_token')->plainTextToken;

    // Return the response with the token and transformed user data
    return response()->json([
        'token' => $token,
        'user' => new UserResource($user), // Transform the user data using UserResource
        'addresses' => AddressResource::collection($user->addresses), // Return addresses as a collection of AddressResource
        'message' => 'Login successfully',
    ]);
}


    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        // Revoke all of the user's tokens
        $request->user()->tokens()->delete();

        // Return a success message
        return response()->json(['message' => 'Logged out successfully']);
    }
}
   
    /*public function login(Request $request)
{
    // Validate the incoming request data
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    // Attempt to authenticate the user
    if (!Auth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    // Generate the authentication token
    $token = $request->user()->createToken('auth_token')->plainTextToken;

    // Retrieve the logged-in user data
    $user = $request->user();

    // Return the token and user data in the response
    return response()->json([
        'token' => $token,
        'user' => $user,  // Return user data
        'message' => 'Login successful',
    ]);
}


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}--}}
@endphp