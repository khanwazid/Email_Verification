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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address 1' => 'required|string|max:30',
            'address 2' => 'required|string|max:30',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Address::create([
            'profile_id' => Auth::id(),
            'address_1' => $request->input('address_1'),
            'address_2' => $request->input('address_2'),
        ]);

        return redirect()->route('profile.details')->with('success', 'Address added successfully!');
    }

    public function update(Request $request, Address $address)
    {
        $validator = Validator::make($request->all(), [
            'address 1' => 'required|string|max:30',
            'address 2' => 'required|string|max:30',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $address->update($request->only('address 1', 'address 2'));

        return redirect()->route('profile.details')->with('success', 'Address updated successfully!');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('profile.details')->with('success', 'Address deleted successfully!');
    }
}

