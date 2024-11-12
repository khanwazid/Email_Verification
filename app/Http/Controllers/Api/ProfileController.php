<?php
namespace App\Http\Controllers\Api;



use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class ProfileController extends Controller
{
    public function showProfileWithAddresses(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Load the addresses relationship
        $user->load('addresses'); // eager load addresses

        // Return the transformed user data with addresses using the UserResource
        return new UserResource($user);
    }
    public function updateProfile(Request $request)
    {
        try {
            // Get authenticated user
            $user = User::find(auth()->id());

            // Validate the input
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'username' => 'required|string|unique:users,username,' . $user->id,
                'phone_number' => 'required|string',
                'gender' => 'nullable|in:male,female,other',
                'password' => 'nullable|min:8|confirmed',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

                
            ]);

            // If validation fails, return validation errors
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Get the request data for the user
            $data = $request->only(['name', 'email', 'username', 'phone_number', 'gender']);

            // Handle profile image update if any
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                // Store the new image
                $imagePath = $request->file('image')->store('profile-images', 'public');
                $data['image'] = $imagePath;
            }

            // If password is provided, hash it and update
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Update the user profile
            $user->update($data);

            // Return the updated user data wrapped in the UserResource
            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => new UserResource($user)  // Return the updated user as a resource
            ], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Database error occurred',
                'error' => $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
    /*public function showProfileWithAddresses(Request $request)
{
    // Get the authenticated user
    $user = $request->user(); 

    // Load the addresses relationship (if any)
    $user->load('addresses'); 

    // Check if the user has no addresses
    $addresses = $user->addresses;
    $addressesMessage = $addresses->isEmpty() ? 'You have no address yet.' : $addresses;

    // Return response
    return response()->json([
        'status' => true,
        'data' => [
            'name' => $user->name,
            'email' => $user->email,
            'profile_photo_url' => $user->profile_photo_url,
            'image' => $user->image,
            'username' => $user->username,
            'phone_number' => $user->phone_number,
            'gender' => $user->gender,
            'role' => $user->role,
            'addresses' => $addressesMessage, // Show either addresses or a no-address message
        ]
    ]);
}
public function updateProfile(Request $request)
{
    try {
        // Get authenticated user
        $user = User::find(auth()->id());
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required|string|unique:users,username,'.$user->id,
            'phone_number' => 'required|string',
            'gender' => 'nullable|in:male,female,other',
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only(['name', 'email', 'username', 'phone_number', 'gender']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('profile-images', 'public');
            $data['image'] = $imagePath;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Direct update using the update method
        $user->update($data);

        // Refresh user data from database
        $updatedUser = User::find($user->id);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => $updatedUser
        ], 200);

    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json([
            'status' => false,
            'message' => 'Database error occurred',
            'error' => $e->getMessage()
        ], 500);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'An error occurred while updating profile',
            'error' => $e->getMessage()
        ], 500);
    }
}
}*/