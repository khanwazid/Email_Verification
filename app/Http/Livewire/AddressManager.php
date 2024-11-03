<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class AddressManager extends Component
{
    
    public $addresses;
    public $countries;
    public $states = [];
    public $cities = [];
    public $newAddress = [
        'country_id' => '',
        'state_id' => '',
        'city_id' => '',
        'address_line_1' => '',
        'address_line_2' => '',
    ];
    public $editingAddressId = null;
    public $showAddModal = false;
    public $showEditModal = false;

    protected $rules = [
        'newAddress.country_id' => 'required',
        'newAddress.state_id' => 'required',
        'newAddress.city_id' => 'required',
        'newAddress.address_line_1' => 'required',
        'newAddress.address_line_2' => 'required',
    ];

    public function mount()
    {
        $this->addresses = auth()->user()->addresses;
        $this->countries = Country::all();
    }

    public function addAddress()
    {
        $this->validate();
        auth()->user()->addresses()->create($this->newAddress);
        $this->addresses = auth()->user()->addresses->fresh();
        $this->resetNewAddress();
        $this->showAddModal = false;
    }

    public function editAddress($addressId)
    {
        $this->editingAddressId = $addressId;
        $address = Address::find($addressId);
        $this->newAddress = $address->toArray();

        // Load states and cities based on existing address data
       /* $this->states = State::where('country_id', $this->newAddress['country_id'])->get();
        $this->cities = City::where('state_id', $this->newAddress['state_id'])->get();

        $this->showEditModal = true;*/
        $this->newAddress = $address->toArray() + [
            'country_id' => $address->city->state->country->id ?? null,
            'state_id' => $address->city->state->id ?? null,
            'city_id' => $address->city->id ?? null,
        ];
        if ($this->newAddress['country_id']) {
            $this->states = State::where('country_id', $this->newAddress['country_id'])->get();
        }
    
        if ($this->newAddress['state_id']) {
            $this->cities = City::where('state_id', $this->newAddress['state_id'])->get();
        }
    
        $this->showEditModal = true;
    }

    public function loadStates()
    {
        $this->states = State::where('country_id', $this->newAddress['country_id'])->get();
        $this->newAddress['state_id'] = '';
        $this->cities = []; // Reset cities when country changes
    }

    public function loadCities()
    {
        $this->cities = City::where('state_id', $this->newAddress['state_id'])->get();
        $this->newAddress['city_id'] = ''; // Reset city when state changes
    }

    public function updateAddress()
    {
        $this->validate();
        $address = Address::find($this->editingAddressId);
        $address->update($this->newAddress);
        $this->addresses = auth()->user()->addresses->fresh();
        $this->resetNewAddress();
        $this->editingAddressId = null;
        $this->showEditModal = false;

        session()->flash('message', 'Address updated successfully!');
        session()->flash('message_type', 'success');
    }

    public function deleteAddress($addressId)
    {
        Address::destroy($addressId);
        $this->addresses = auth()->user()->addresses->fresh();

        session()->flash('message', 'Address deleted successfully!');
session()->flash('message_type', 'error');
    }

    private function resetNewAddress()
    {
        $this->newAddress = [
            'country_id' => '',
            'state_id' => '',
            'city_id' => '',
            'address_line_1' => '',
            'address_line_2' => '',
        ];
    }

    public function render()
    {
        return view('livewire.address-manager');
    }
}
