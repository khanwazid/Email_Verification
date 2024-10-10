

{{--<div class="hidden sm:block">
    <div class="py-8">
        <div class="border-t border-gray-200"></div>
    </div>
</div>

<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900"> Addresses</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Add your addresses.
                </p>
            </div>
            <div class="px-4 sm:px-0">
                <!-- Space for future content if needed -->
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl text-sm text-gray-600">
                    Manage your addresses associated with your account. You can add or remove addresses as needed.
                </div>

                <div class="mt-5">
                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <!-- Link to Add Address Form -->
                        <a href="/add" class="btn btn-primary">Add New Address</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hidden sm:block">
    <div class="py-8">
        <div class="border-t border-gray-200"></div>
    </div>
</div>--}}


<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">{{ __('Edit or Remove Addresses') }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ __('Manage addresses associated with your account.') }}</p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <div class="overflow-x-auto"> <!-- Allows horizontal scroll -->
                    <table class="min-w-full border-collapse border border-gray-200"> <!-- Ensures table takes full width -->
                        <thead>
                            <tr>
                               {{-- <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Country_id') }}</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('State_id') }}</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('City_id') }}</th>--}}
                                <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Address_line_1') }}</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Address_line_2') }}</th>
                                <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addresses as $address)
                                <tr>
                                    {{--<td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->country_id }}</td>
                                    <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->state_id }}</td>
                                    <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->city_id }}</td>--}}
                                    <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->address_line_1 }}</td>
                                    <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->address_line_2 }}</td>
                                    <td class="border border-gray-300 px-6 py-4">
                                       <div class="flex items-center">
                                       <button wire:click="editAddress({{ $address->id }})" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                 {{ __('Edit') }}
                            </button>

                        <button wire:click="deleteAddress({{ $address->id }})" class="ml-2 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                         {{ __('Delete') }}
                        </button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($addresses->isEmpty())
                                <tr>
                                    <td colspan="6" class="border border-gray-300 px-4 py-2 text-sm text-gray-500 text-center">
                                        {{ __('You have no saved addresses.') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Edit Address Modal -->
                <div wire:model="showEditModal" class="fixed z-10 inset-0 overflow-y-auto" style="display: {{ $showEditModal ? 'block' : 'none' }};">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white rounded-lg p-6">
                            <h3 class="text-lg font-semibold">{{ __('Edit Address') }}</h3>
                            <div class="mt-4">
                                <label for="edit_address_line_1" class="block text-sm font-medium text-gray-700">{{ __('Address_line_1') }}</label>
                                <input id="edit_address_line_1" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" wire:model.defer="newAddress.address_line_1" />
                                @error('newAddress.address_line_1') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <label for="edit_address_line_2" class="block text-sm font-medium text-gray-700">{{ __('Address_line_2') }}</label>
                                <input id="edit_address_line_2" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" wire:model.defer="newAddress.address_line_2" />
                                @error('newAddress.address_line_2') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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
        </div>
    </div>
</div>
<div class="hidden sm:block">
    <div class="py-8">
        <div class="border-t border-gray-200"></div>
    </div>
</div>



<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900"> Addresses</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Add your addresses.
                </p>
            </div>
            <div class="px-4 sm:px-0">
                <!-- Space for future content if needed -->
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl text-sm text-gray-600">
                    Manage your addresses associated with your account. You can add or remove addresses as needed.
                </div>

                <div class="mt-5">
                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <!-- Link to Add Address Form -->
                        <a href="/add" class="btn btn-primary">Add New Address</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
