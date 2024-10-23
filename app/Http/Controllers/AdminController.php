<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    public function page()
    {
        return view('admin.dashboard');
    }

    public function show()
    {
       /* // Logic to fetch admin details
        return view('admin.details');  // Make sure to create a Blade file 'admin/details.blade.php'*/
         // Assuming 'admin' role is stored as a string in the 'role' field of the users table
         $admin = Auth::user(); // Get the currently authenticated admin

         return view('admin.details', compact('admin')); // Pass the admin data to the view
    }
}
