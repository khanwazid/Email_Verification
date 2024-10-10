<?php
namespace App\Http\Controllers;


use App\Models\Address;
use App\Models\Country;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class AddressController extends Controller
{  
    public function add()
{
    try {
        $countries = Country::all();
        $users = User::all(); // Fetch all users from the database
        return view('addresses.add', compact('countries', 'users'));
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error in AddressController@create: ' . $e->getMessage());

        // You can customize this error message
        $errorMessage = 'An error occurred while loading the page. Please try again later.';

        // Redirect back with an error message
        return redirect()->back()->with('error', $errorMessage);
    }
}

    
    /*public function add()
    {
        try {
            $countries = Country::all();
            return view('addresses.add', compact('countries'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load countries. Please try again.');
        }
    }*/

    /*public function store(Request $request)
    {
        try {
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
                'user_id' => $request->user_id ?? auth()->id(),
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
            ]);

            return redirect()->route('addresses.add')->with('success', 'Address added successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to add address. Please try again.');
        }
    }*/
    public function store(Request $request)
{
    // Move validation outside the try-catch block
    $validatedData = $request->validate([
        'country_id' => 'required|exists:countries,id',
        'state_id' => 'required|exists:states,id',
        'city_id' => 'required|exists:cities,id',
        'address_line_1' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
    ]);

    try {
        // Check for existing address
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

        // Save new address
        Address::create([
            'user_id' => $request->user_id ?? auth()->id(),
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
        ]);

        return redirect()->route('addresses.add')->with('success', 'Address added successfully.');
    } catch (Exception $e) {
        // Catch unexpected errors and show a general message
        return back()->with('error', 'Failed to add address. Please try again.');
    }
}


    public function getStates(Request $request)
    {
        try {
            $states = State::where('country_id', $request->country_id)->get();
            return response()->json($states);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to load states.'], 500);
        }
    }

    public function getCities(Request $request)
    {
        try {
            $cities = City::where('state_id', $request->state_id)->get();
            return response()->json($cities);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to load cities.'], 500);
        }
    }

    public function show()
    {
        try {
            $data = Address::all();
            return view('list', ['addresses' => $data]);
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load addresses.');
        }
    }

    public function delete($id)
    {
        try {
            $data = Address::findOrFail($id);
            $data->delete();
            return redirect('list')->with('success', 'Address deleted successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete address.');
        }
    }

    public function edit($id)
    {
        try {
            $address = Address::findOrFail($id);
            $countries = Country::all();
            $states = State::where('country_id', $address->country_id)->get();
            $cities = City::where('state_id', $address->state_id)->get();
            $users = User::all(); // Fetch all users from the database

            return view('addresses.edit', compact('address', 'countries', 'states', 'cities', 'users'));
        }catch (\Exception $e) {
            Log::error('Error in AddressController@edit: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the page. Please try again later.');
        }
    }

 /*   public function update(Request $request, $id)
    {
        try {
            $address = Address::findOrFail($id);

            $request->validate([
                'address_line_1' => 'required|string|max:255',
                'address_line_2' => 'nullable|string|max:255',
                'country_id' => 'required|integer',
                'state_id' => 'required|integer',
                'city_id' => 'required|integer',
                'user_id' => 'required|integer',
            ]);

            $address->address_line_1 = $request->address_line_1;
            $address->address_line_2 = $request->address_line_2;
            $address->country_id = $request->country_id;
            $address->state_id = $request->state_id;
            $address->city_id = $request->city_id;
            $address->user_id = $request->user_id;

            $address->save();

            return redirect()->route('addresses.edit', $address->id)->with('success', 'Address updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to update address.');
        }
    }*/public function update(Request $request, $id)
{
    $address = Address::findOrFail($id);

    $validatedData = $request->validate([
        'address_line_1' => 'required|string|max:255',
        'address_line_2' => 'nullable|string|max:255',
        'country_id' => 'required|integer|exists:countries,id',
        'state_id' => 'required|integer|exists:states,id',
        'city_id' => 'required|integer|exists:cities,id',
        'user_id' => 'required|integer|exists:users,id',
    ]);

    try {
        $address->update($validatedData);
        return redirect()->route('addresses.edit', $address->id)->with('success', 'Address updated successfully.');
    } catch (Exception $e) {
        return back()->withInput()->with('error', 'Failed to update address. Please try again.');
    }
}

}
