<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        return view('users.index', compact('users')); 
    }
    public function getData(){
        $users=User::with('address')->get();
       return $users;
      // return view('users.show',compact('users'));
    }
    public function search(Request $request){
        $userData=User::where('name','like',"%$request->search%")->get();
        return view('users.index',['users'=>$userData,'search'=>$request->search]);
    }
}


