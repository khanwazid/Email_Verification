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

class AuthController extends Controller
{
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
