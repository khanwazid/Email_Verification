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
        // Get the authenticated user
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

        // Get only the necessary fields from the request
        $data = $request->only(['name', 'email', 'username', 'phone_number', 'gender']);
        
        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Store the new image and update the image path in the data
            $data['image'] = $request->file('image')->store('images', 'public');

            // Optionally update the profile photo URL 
            $user->updateProfilePhoto($request->file('image'));
        }

        // Hash and update the password if it's provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update the user profile in the database
        $user->update($data);

        // Return the updated user profile as a resource
        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => new UserResource($user),
        ], 200);

    } catch (\Illuminate\Database\QueryException $e) {
        // Handle database-specific errors
        return response()->json([
            'status' => false,
            'message' => 'Database error occurred',
            'error' => $e->getMessage()
        ], 500);
    } catch (\Exception $e) {
        // Handle any other exceptions
        return response()->json([
            'status' => false,
            'message' => 'An error occurred while updating profile',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
   /* public function updateProfile(Request $request)
    {
        try {
            $user = User::find(auth()->id());
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'username' => 'required|string|unique:users,username,' . $user->id,
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
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                
  
             
                $data['image'] = $request->file('image')->store('images', 'public');
                
                
                // Update profile photo url for Jetstream
                $user->updateProfilePhoto($request->file('image'));
            }
    
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
    
            $user->update($data);
            
            // Force refresh the model
            $user = $user->fresh();
    
            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => new UserResource($user),
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Database error occurred',
                'error' => $e->getMessage()
            ], 500);
    }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating profile',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }
    
}
*/

/*
 public function updateProfile(Request $request)
    {
        try {
            // Get the authenticated user
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
    
            // Get the request data for the user (without the image)
            $data = $request->only(['name', 'email', 'username', 'phone_number', 'gender']);
    
            // Handle profile image update if any
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
    
                // Store the new image in the 'profile-images' directory in the public disk
                $imagePath = $request->file('image')->store('profile-images', 'public');
    
                // Add the image path to the data
                $data['image'] = $imagePath;
            }
    
            // If password is provided, hash it and update
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
    
            // Update the user profile
            $user->update($data);
    
            // Generate the full URL for the image (if it exists)
            if ($user->image) {
                // Return the URL to access the image
                $user->image_url = Storage::url($user->image); // This returns the full URL to the image
            }
    
            // Return the updated user data wrapped in the UserResource
            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => new UserResource($user),  // Return the updated user as a resource
                'image_url' => $user->image_url,   // Include the image URL in the response
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
}    */