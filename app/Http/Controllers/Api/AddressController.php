<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AddressResource;

class AddressController extends Controller
{
    
    public function getUserAddresses(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in to access your addresses.'], 401);
        }

        return response()->json([
            'success' => true,
            'addresses' => AddressResource::collection($user->addresses)
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|exists:cities,id',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $address = new Address();
        $address->user_id = auth()->id();
        $address->city_id = $request->city_id;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->save();

        $address->load(['city.state.country']);

        return response()->json([
            'status' => true,
            'message' => 'Address added successfully',
            'data' => new AddressResource($address)
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$address) {
            return response()->json([
                'status' => false,
                'message' => 'Address not found or unauthorized'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'city_id' => 'sometimes|exists:cities,id',
            'address_line_1' => 'sometimes|string|max:255',
            'address_line_2' => 'sometimes|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $address->update($request->only([
            'city_id',
            'address_line_1',
            'address_line_2'
        ]));

        $address->load(['city.state.country']);

        return response()->json([
            'status' => true,
            'message' => 'Address updated successfully',
            'data' => new AddressResource($address)
        ], 200);
    }

    public function destroy($id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$address) {
            return response()->json([
                'status' => false,
                'message' => 'Address not found or unauthorized'
            ], 404);
        }

        $address->delete();

        return response()->json([
            'status' => true,
            'message' => 'Address deleted successfully'
        ], 200);
    }
}
   /* public function getUserAddresses(Request $request)
    {
        // Retrieve the authenticated user's addresses
        $user = $request->user(); // This will be null if the user is not authenticated

        // If no user is found, return a 401 response with a specific error message
        if (!$user) {
            return response()->json(['error' => 'Unauthorized. Please log in to access your addresses.'], 401);
        }

        // Retrieve the user's addresses (assuming you have defined an 'addresses' relationship in the User model)
        $addresses = $user->addresses; // This should return all addresses associated with the user

        return response()->json([
            'success' => true,
            'addresses' => $addresses
        ], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|exists:cities,id',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $address = new Address();
        $address->user_id = auth()->id();
        $address->city_id = $request->city_id;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->save();

        // Load relationships for the response
        $address->load(['city.state.country']);

        return response()->json([
            'status' => true,
            'message' => 'Address added successfully',
            'data' => $address
        ], 201);
    }
    public function update(Request $request, $id)
    {
        // Find address and verify ownership
        $address = Address::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$address) {
            return response()->json([
                'status' => false,
                'message' => 'Address not found or unauthorized'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'city_id' => 'sometimes|exists:cities,id',
            'address_line_1' => 'sometimes|string|max:255',
            'address_line_2' => 'sometimes|nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $address->update($request->only([
            'city_id',
            'address_line_1',
            'address_line_2'
        ]));

        // Load relationships for the response
        $address->load(['city.state.country']);

        return response()->json([
            'status' => true,
            'message' => 'Address updated successfully',
            'data' => $address
        ], 200);
    }
    public function destroy($id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$address) {
            return response()->json([
                'status' => false,
                'message' => 'Address not found or unauthorized'
            ], 404);
        }

        $address->delete();

        return response()->json([
            'status' => true,
            'message' => 'Address deleted successfully'
        ], 200);
    }

}*/