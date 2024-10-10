<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all(); 
            return view('users.index', compact('users'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load users. Please try again.');
        }
    }
   
    public function getData()
    {
        try {
            $users = User::with('addresses')->get();

            if ($users->isEmpty()) {
                return response()->json([
                    'message' => 'No users found.'
                ], 404);
            }

            $usersWithAddresses = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'addresses' => $user->addresses->isEmpty() 
                        ? 'No addresses found for this user.' 
                        : $user->addresses
                ];
            });

            return response()->json($usersWithAddresses);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve user data.'
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $userData = User::where('name', 'like', "%$request->search%")->get();

            if ($userData->isEmpty()) {
                return back()->with('error', 'No users found matching your search.');
            }

            return view('users.index', ['users' => $userData, 'search' => $request->search]);
        } catch (Exception $e) {
            return back()->with('error', 'Failed to search users. Please try again.');
        }
    }
}
