<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index() {
        $profiles = Profile::orderBy('created_at','DESC')->get();

        return view('profiles.list',[
            'profiles' => $profiles
        ]);
    }

    
    public function create() {
        return view('profiles.create');
    }

    
    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:5',
            'username' => 'required|min:8',
            'email' => 'required|min:10',
            'phone' => 'required|min:10',
            'password' => 'required'            
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->route('profiles.create')->withInput()->withErrors($validator);
        }

        
        $profiles = new Profile();
        $profiles->name = $request->name;
        $profiles->username = $request->username;
        $profiles->email = $request->email;
        $profiles->phone = $request->phone;
        $profiles->password = $request->password;
        $profiles->save();

        
        if ($request->image != "") {
            
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; 
            

          
            $image->move(public_path('uploads/profiles'),$imageName);

            
          
            $profile = new Profile(); 
            $profile->image = $imageName; 
            $profile->save();
        }        

        return redirect()->route('profiles.index')->with('success','Profile added successfully.');
    }

    
    public function edit($id) {
        $profile = Profile::findOrFail($id);
        return view('profiles.edit',[
            'profile' => $profile
        ]);
    }


    public function update($id, Request $request) {

        $profile = Profile::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'username' => 'required|min:8',
            'email' => 'required|min:10',
            'phone' => 'required|min:10',
            'password' => 'required'          
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->route('profiles.edit',$profile->id)->withInput()->withErrors($validator);
        }
      

        
        $profiles->name = $request->name;
        $profiles->username = $request->username;
        $profiles->email = $request->email;
        $profiles->phone = $request->phone;
        $profiles->password = $request->password;
        $profiles->save();

        if ($request->image != "") {

            
            File::delete(public_path('uploads/profiles/'.$profile->image));

            
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext; 

           
            $image->move(public_path('uploads/profiles'),$imageName);

            
            $profile->image = $imageName;
            $profile->save();
        }        

        return redirect()->route('profiles.index')->with('success','Profile updated successfully.');
    }

    public function destroy($id) {
        $profile = Profile::findOrFail($id);

      
       File::delete(public_path('uploads/profiles/'.$profile->image));

       
       $profile->delete();

       return redirect()->route('profiles.index')->with('success','Profile deleted successfully.');
    }
}
