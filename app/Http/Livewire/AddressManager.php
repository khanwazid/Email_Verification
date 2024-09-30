<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Address;

class AddressManager extends Component
{
    public $addresses;
    public $newAddress = [
        'address_1' => '',
        'address_2' => '',
    ];
    public $editingAddressId = null;
    public $showAddModal = false; // Ensure this property is defined
    public $showEditModal = false; // You should also have this if you have an edit modal

    protected $rules = [
        'newAddress.address_1' => 'required',
        'newAddress.address_2' => 'required',
    ];

    public function mount()
    {
        $this->addresses = auth()->user()->addresses;
    }

    public function addAddress()
    {
        $this->validate();
        auth()->user()->addresses()->create($this->newAddress);
        $this->addresses = auth()->user()->addresses->fresh();
        $this->resetNewAddress();
        $this->showAddModal = false; // Close modal after adding
    }

    public function editAddress($addressId)
    {
        $this->editingAddressId = $addressId;
        $address = Address::find($addressId);
        $this->newAddress = $address->toArray();
        $this->showEditModal = true; // Show edit modal
    }

    public function updateAddress()
    {
        $this->validate();
        $address = Address::find($this->editingAddressId);
        $address->update($this->newAddress);
        $this->addresses = auth()->user()->addresses->fresh();
        $this->resetNewAddress();
        $this->editingAddressId = null;
        $this->showEditModal = false; // Close edit modal
    }

    public function deleteAddress($addressId)
    {
        Address::destroy($addressId);
        $this->addresses = auth()->user()->addresses->fresh();
    }

    private function resetNewAddress()
    {
        $this->newAddress = [
            'address_1' => '',
            'address_2' => '',
        ];
    }

    public function render()
    {
        return view('livewire.address-manager');
    }
}
