<?php
namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function add()
    {
        $countries = Country::all();
        return view('addresses.add', compact('countries'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'address_line_1' => 'required|string|max:255',
            
             'user_id' => 'required|exists:users,id',
            
        ]);
        $existingAddress = Address::where('address_line_1', $request->input('address_line_1'))
                              ->where('address_line_2', $request->input('address_line_2'))
                              ->where('country_id', $request->input('country_id'))
                              ->where('state_id', $request->input('state_id'))
                              ->where('city_id', $request->input('city_id'))
                              ->where('user_id', $request->input('user_id'))
                              ->exists();

    if ($existingAddress) {
        return redirect('add')->with('error', 'Address already exists.');
    }
        Address::create([
           // 'user_id' => $request->user_id, 
            'user_id' => $request->user_id ?? auth()->id(),
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
        ]);

        //$address = auth()->user()->addresses()->create($validatedData);

        return redirect()->route('addresses.add')->with('success', 'Address added successfully.');
    }

    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        return response()->json($cities);
    }
    function show(){
        $data= Address::all();
       return view('list' ,['addresses'=>$data]);
       
    }
    function delete($id){
        $data=Address::find($id);
        $data->delete();
        return redirect('list');
    }
    public function edit($id)
    {
        $address = Address::findOrFail($id); // Fetch the address by ID
    
        // Fetch countries, states, cities for the dropdowns
        $countries = Country::all();
        $states = State::where('country_id', $address->country_id)->get();
        $cities = City::where('state_id', $address->state_id)->get();
    
        return view('addresses.edit', compact('address', 'countries', 'states', 'cities')); // Pass the address and other data to the view
    }
    public function update(Request $request, $id)
{
    $address = Address::find($id); // Find the address by its ID
    
    // Validate the request data (optional but recommended)
    $request->validate([
        'address_line_1' => 'required|string|max:255',
        'address_line_2' => 'nullable|string|max:255',
        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'city_id' => 'required|integer',
        'user_id' => 'required|integer',
    ]);

    // Update the address with new values
    $address->address_line_1 = $request->address_line_1;
    $address->address_line_2 = $request->address_line_2;
    $address->country_id = $request->country_id;
    $address->state_id = $request->state_id;
    $address->city_id = $request->city_id;
    $address->user_id = $request->user_id;

    // Save the updated address
    $address->save();

    return redirect()->route('addresses.edit', $address->id)->with('success', 'Address updated successfully');
}


/*public function update(Request $request, $id)
{
    $request->validate([
        'country_id' => 'required',
        'state_id' => 'required',
        'city_id' => 'required',
        'address_line_1' => 'required',
        'user_id' => 'required|exists:users,id',
    ]);

    $address = Address::findOrFail($id);
    $address->update([
        'country_id' => $request->country_id,
        'state_id' => $request->state_id,
        'city_id' => $request->city_id,
        'address_1' => $request->address_line_1,
        'address_2' => $request->address_line_2,
        'user_id' => $request->user_id,
    ]);
    return redirect()->route('addresses.edit', $address->id)->with('success', 'Address updated successfully.');
}*/
  /*function update(Request $req){
    $data=Address::find($req->id);
    
        $data->address_line_1=$req->address_line_1;
        $data->address_line_2=$req->address_line_2;
        $data->country_id=$req->country_id;
        $data->state_id=$req->state_id;
        $data->city_id=$req->city_id;
        $data->save();
        return redirect('list');*/



  }




      