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
           

           /* if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/profile-photos', $imageName);
               //$image->storeAs('public/profile-images', $imageName);
                $user->image = 'profile-photos/' . $imageName;
                //$user->image = 'profile-images/' . $imageName;
            }*/
            if ($request->hasFile('image')) {
                // Using updateProfilePhoto method from HasProfilePhoto trait
                $user->updateProfilePhoto($request->file('image'));
                
                // Store additional image if needed
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $path = $request->file('image')->storeAs('images', $imageName, 'public');
                $user->image = $path;
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

  /*  public function login(Request $request)
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
}*/
