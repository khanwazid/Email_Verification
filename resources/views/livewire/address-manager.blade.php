<div>
    <x-section-border />

    <div class="mt-10 sm:mt-0 flex justify-between">
        <div class="w-full max-w-2xl">
            <h2 class="text-lg font-semibold text-gray-900">{{ __('Edit or Remove Addresses') }}</h2>
            <p class="mt-1 text-sm text-gray-600">{{ __('Manage addresses associated with your account.') }}</p>
        </div>
    </div>

    <div class="mt-4 flex justify-center"> <!-- Changed justify-end to justify-center -->
        <div class="overflow-x-auto w-2/5"> <!-- Set to 2/5 for half the width -->
            <table class="min-w-full border-collapse border border-gray-200 mx-auto" style="width: 100%;"> <!-- Added mx-auto for centering -->
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Address 1') }}</th>
                        <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Address 2') }}</th>
                        <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->address_1 }}</td>
                            <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->address_2 }}</td>
                            <td class="border border-gray-300 px-6 py-4">
                                <div class="flex items-center">
                                    <button wire:click="editAddress({{ $address->id }})" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        {{ __('Edit') }}
                                    </button>
                                    <button wire:click="deleteAddress({{ $address->id }})" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if ($addresses->isEmpty())
                        <tr>
                            <td colspan="3" class="border border-gray-300 px-4 py-2 text-sm text-gray-500 text-center">
                                {{ __('You have no saved addresses.') }}
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Address Modal -->
    <div wire:model="showEditModal" class="fixed z-10 inset-0 overflow-y-auto" style="display: {{ $showEditModal ? 'block' : 'none' }};">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg p-6">
                <h3 class="text-lg font-semibold">{{ __('Edit Address') }}</h3>
                <div class="mt-4">
                    <label for="edit_address_1" class="block text-sm font-medium text-gray-700">{{ __('Address 1') }}</label>
                    <input id="edit_address_1" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" wire:model.defer="newAddress.address_1" />
                    @error('newAddress.address_1') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4">
                    <label for="edit_address_2" class="block text-sm font-medium text-gray-700">{{ __('Address 2') }}</label>
                    <input id="edit_address_2" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" wire:model.defer="newAddress.address_2" />
                    @error('newAddress.address_2') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <button wire:click="$set('showEditModal', false)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </button>
                    <button class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" wire:click="updateAddress" wire:loading.attr="disabled">
                        {{ __('Update Address') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
