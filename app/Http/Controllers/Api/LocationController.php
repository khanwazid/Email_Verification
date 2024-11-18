<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CityResource;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller
{
    public function countries()
    {
        try {
            $data = Cache::remember('countries', 86400, function () {
                $countries = Country::all();
                if ($countries->isEmpty()) {
                    throw new ModelNotFoundException('No countries found');
                }
                return CountryResource::collection($countries);
            });

            return response()->json([
                'status' => true,
                'message' => 'Countries retrieved successfully',
                'data' => $data
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve countries'
            ], 500);
        }
    }

    public function states($countryId)
    {
        try {
            if (!Country::find($countryId)) {
                throw new ModelNotFoundException('Country not found');
            }

            $data = Cache::remember("country.{$countryId}.states", 86400, function () use ($countryId) {
                $states = State::where('country_id', $countryId)->get();
                if ($states->isEmpty()) {
                    throw new ModelNotFoundException('No states found for this country');
                }
                return StateResource::collection($states);
            });

            return response()->json([
                'status' => true,
                'message' => 'States retrieved successfully',
                'data' => $data
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve states'
            ], 500);
        }
    }

    public function cities($stateId)
    {
        try {
            if (!State::find($stateId)) {
                throw new ModelNotFoundException('State not found for this id');
            }

            $data = Cache::remember("state.{$stateId}.cities", 86400, function () use ($stateId) {
                $cities = City::where('state_id', $stateId)->get();
                if ($cities->isEmpty()) {
                    throw new ModelNotFoundException('No cities found for this state');
                }
                return CityResource::collection($cities);
            });

            return response()->json([
                'status' => true,
                'message' => 'Cities retrieved successfully',
                'data' => $data
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve cities'
            ], 500);
        }
    }
}
