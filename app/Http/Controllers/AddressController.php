<?php
  


namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{

    public function __invoke(Request $request)
    {
        // Your logic here
    }
    function show(){
        $data= Address::all();
       return view('list' ,['addresses'=>$data]);
       
    }
  
    

public function addData(Request $request) {
    
    $request->validate([
        'address_1' => 'required|string|max:255',
        'address_2' => 'nullable|string|max:255',
        'user_id' => 'required|integer',
    ]);

    
    $existingAddress = Address::where('address_1', $request->input('address_1'))
                              ->where('address_2', $request->input('address_2'))
                              ->where('user_id', $request->input('user_id'))
                              ->exists();

    if ($existingAddress) {
        return redirect('add')->with('error', 'Address already exists.');
    }

    Address::create([
        'address_1' => $request->input('address_1'),
        'address_2' => $request->input('address_2'),
        'user_id' => $request->input('user_id'),
    ]);

    return redirect('add')->with('success', 'Address added successfully.');
}

    function delete($id){
        $data=Address::find($id);
        $data->delete();
        return redirect('list');
    }
  function editData($id){

    $data=Address::find($id);
    return view('edit',['data'=>$data]);
  }
  function update(Request $req){
    $data=Address::find($req->id);
    
        $data->address_1=$req->address_1;
        $data->address_2=$req->address_2;
        $data->user_id=$req->user_id;
        $data->save();
        return redirect('list');

  }
  
     
}

