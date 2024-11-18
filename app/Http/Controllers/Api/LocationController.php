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


class LocationController extends Controller
{
    public function countries()
    {
        $countries = Country::all();
        return CountryResource::collection($countries);
    }

    public function states($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return StateResource::collection($states);
    }

    public function cities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return CityResource::collection($cities);
    }
}
