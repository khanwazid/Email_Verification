<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{  
    public function add()
    {
        try {
            $countries = Country::all();
            $users = User::where('id', auth()->id())->get(); // Fetch only the logged-in user
            return view('addresses.add', compact('countries', 'users'));
        } catch (\Exception $e) {
            Log::error('Error in AddressController@add: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the page. Please try again later.');
        }
    }

    public function store(Request $request)
    {
        // Validation for city_id and address line
        $validatedData = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255', // Optional field
        ]);

        try {
            // Check if the address already exists for this user
            $existingAddress = Address::where('address_line_1', $request->input('address_line_1'))
                ->where('address_line_2', $request->input('address_line_2'))
                ->where('city_id', $request->input('city_id'))
                ->where('user_id', auth()->id())
                ->exists();

            if ($existingAddress) {
                return redirect()->route('addresses.add')->with('error', 'Address already exists.');
            }

            // Save the address with the logged-in user's ID
            Address::create([
                'user_id' => auth()->id(), // Automatically assign the logged-in user
                'city_id' => $request->city_id,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
            ]);

            return redirect()->route('addresses.add')->with('success', 'Address added successfully.');
        } catch (\Exception $e) {
            Log::error('Error in AddressController@store: ' . $e->getMessage());
            return back()->with('error', 'Failed to add address. Please try again.');
        }
    }
    public function getStates(Request $request)
{
    $countryId = $request->input('country_id');

    // Log the country ID for debugging
    Log::info('Fetching states for country ID: ' . $countryId);

    // Fetch states based on the country ID
    try {
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states);
    } catch (\Exception $e) {
        Log::error('Error fetching states: ' . $e->getMessage());
        return response()->json(['error' => 'Error fetching states.'], 500);
    }
}


    public function getCities(Request $request)
    {
        try {
            $cities = City::where('state_id', $request->state_id)->get();
            return response()->json($cities);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load cities.'], 500);
        }
    }

   
   /* public function show()
    {
        try {
            $data = Address::all();
            return view('list', ['addresses' => $data]);
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load addresses.');
        }
    }*/
    public function index()
    {
        try {
            // Fetch all addresses with their related city, state, and country
            $addresses = Address::with(['city.state.country'])->get();
    
            return view('list', compact('addresses'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load addresses.');
        }
    }

    public function delete($id)
    {
        try {
            $address = Address::findOrFail($id);
            $address->delete();
            return redirect()->route('addresses.list')->with('delete', 'Address deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete address.');
        }
    }

  
   /* public function edit($id)
{
    try {
        // Fetch address by ID
        $address = Address::findOrFail($id);
        
        // Get all countries
        $countries = Country::all();
        
        // Get the current state and city IDs
        $stateId = $address->city ? $address->city->state_id : null;
        $countryId = $stateId ? $address->city->state->country_id : null;
        
        // Get the current states and cities based on the address
        $states = $countryId ? State::where('country_id', $countryId)->get() : collect();
        $cities = $stateId ? City::where('state_id', $stateId)->get() : collect();

        // Fetch all users from the database
        $users = User::all();

        // Pass the data to the view
        return view('addresses.edit', compact('address', 'countries', 'states', 'cities', 'users', 'countryId'));
    } catch (\Exception $e) {
        Log::error('Error in AddressController@edit: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while loading the page. Please try again later.');
    }
}*/
/*public function edit($id)
{
    $address = Address::findOrFail($id);
    $countries = Country::all();
    $states = State::all(); // You may want to filter this based on the selected country
    $cities = City::all(); // Similarly, filter based on selected state
    $users = User::where('role', '!=', 'admin')->get(); // Adjust the role check as needed

    return view('addresses.edit', compact('address', 'countries', 'states', 'cities', 'users'));
}*/
public function edit($id)
{
    try {
        // Fetch address by ID
        $address = Address::findOrFail($id);
        
        // Get all countries
        $countries = Country::all();
        
        // Get the current state and city IDs
        $stateId = $address->city ? $address->city->state_id : null;
        $countryId = $stateId ? $address->city->state->country_id : null;
        
        // Get the current states and cities based on the address
        $states = $countryId ? State::where('country_id', $countryId)->get() : collect();
        $cities = $stateId ? City::where('state_id', $stateId)->get() : collect();

        // Fetch all non-admin users from the database
        $users = User::where('role', '!=', 'admin')->get(); // Adjust the role check as needed

        // Pass the data to the view
        return view('addresses.edit', compact('address', 'countries', 'states', 'cities', 'users', 'countryId'));
    } catch (\Exception $e) {
        Log::error('Error in AddressController@edit: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while loading the page. Please try again later.');
    }
}


public function update(Request $request, $id)
{
    $address = Address::findOrFail($id);

    // Validation for city_id, state_id, country_id, and address lines
    $validatedData = $request->validate([
        'address_line_1' => 'required|string|max:255',
        'address_line_2' => 'nullable|string|max:255',
        'country_id' => 'required|integer|exists:countries,id',
        'state_id' => 'required|integer|exists:states,id',
        'city_id' => 'required|integer|exists:cities,id',
        'user_id' => 'required|integer|exists:users,id', // Validate user_id
    ]);

    try {
        $address->update($validatedData);
        return redirect()->route('addresses.list')->with('update', 'Address updated successfully.'); // Redirect to addresses list
    } catch (\Exception $e) {
        Log::error('Error in AddressController@update: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Failed to update address. Please try again.');
    }
}

}
