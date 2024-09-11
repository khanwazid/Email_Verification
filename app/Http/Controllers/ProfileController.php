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
    
    
        public function search(Request $request)
        {
            
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
            ]);
    
            
            $query = Profile::query();
    
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            }
    
            if ($request->filled('email')) {
                $query->where('email', 'like', '%' . $request->input('email') . '%');
            }
    
            if ($request->filled('phone')) {
                $query->where('phone', 'like', '%' . $request->input('phone') . '%');
            }
    
            $profiles = $query->paginate(10); 
    
            if ($request->ajax()) {
                return response()->json([
                    'profiles' => $profiles->items(),
                    'pagination' => $profiles->links()->render()
                ]);
            }
    
            return view('profiles.index', ['profiles' => $profiles]);
        }
    
    
    

public function fetchProfiles(Request $request)
{
    $profiles = Profile::where('name', 'like', '%'.$request->input('query').'%')
                         ->orWhere('email', 'like', '%'.$request->input('query').'%')
                        ->orWhere('phone', 'like', '%'.$request->input('query').'%')
                        ->paginate(1);

    return view('profiles.pagination', compact('profiles'))->render();
}
    
    public function create() {
        return view('profiles.create');
    }

    
    public function store(Request $request) {
     try{  $rules = [
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

        return redirect()->route('profiles.create')->with('success', 'Profile created successfully!');
    }
    catch(\Exception $e) {
        return back()->with('error', 'Error creating profile: '.$e->getMessage());
    }
    }

    
   public function edit($id) {
        $profile = Profile::findOrFail($id);
       // return redirect()->route('profiles.edit');
        return redirect()->route('profiles.edit', ['profileId' => $profile->id]);

       
     
    }
   /*public function edit($id)
    {
        return view('profiles.edit', compact('profile'));
    }*/
    

    public function update( Request $request ,$id) {

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

    protected function authenticated(Request $request, $user)
{
    return redirect()->route('profiles.show', $user->id);
}

}
