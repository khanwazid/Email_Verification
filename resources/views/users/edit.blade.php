<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Profile</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('profiles.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Profile</h3>
                    </div> 
                    
                    <form action="{{ route('profiles.update', $profile->id) }}" method="POST">
                
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{ old('name') }}" type="text" class="@error('name') is-invalid @enderror form-control-lg form-control" placeholder="Name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Username</label>
                                <input value="{{ old('username') }}" type="text" class="@error('username') is-invalid @enderror form-control form-control-lg" placeholder="Username" name="username">
                                @error('username')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Email</label>
                                <input value="{{ old('email') }}" type="text" class="@error('email') is-invalid @enderror form-control form-control-lg" placeholder="Email" name="email">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Phone</label>
                                <input value="{{ old('phone') }}" type="text" class="@error('phone') is-invalid @enderror form-control form-control-lg" placeholder="Phone" name="phone">
                                @error('phone')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Password</label>
                                <input value="{{ old('password') }}" type="text" class="@error('password') is-invalid @enderror form-control form-control-lg" placeholder="Password" name="password">
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
  </body>
</html>

<div class="mt-10 sm:mt-0">
    @if (session()->has('message'))
        <div wire:ignore class="border px-4 py-3 rounded relative mt-4" role="alert"
             style="background-color: {{ session('message_type') === 'success' ? '#d1e7dd' : '#f8d7da' }};
                    border-color: {{ session('message_type') === 'success' ? '#badbcc' : '#f5c2c7' }}; 
                    color: {{ session('message_type') === 'success' ? '#0f5132' : '#842029' }};">
            <span class="block sm:inline">{{ session('message') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove();">
                &times;
            </button>
        </div>
    @endif

    @if (!auth()->user()->isAdmin())
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Edit or Remove Addresses') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ __('Manage addresses associated with your account.') }}</p>
                </div>
            </div>
           

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Country') }}</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('State') }}</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('City') }}</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Address Line 1') }}</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Address Line 2') }}</th>
                                    <th class="border border-gray-300 px-6 py-3 text-left text-sm font-medium text-gray-700">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->city->state->country->name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->city->state->name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-6 py-4 text-sm text-gray-900">{{ $address->city->name  }}</td>
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
                </div>
            </div>
        </div>

       

     <!-- Edit Address Modal -->
     @if ($showEditModal)
<div wire:model="showEditModal" class="fixed z-10 inset-0 overflow-y-auto" style="display: {{ $showEditModal ? 'block' : 'none' }};">
    <div class="flex items-center justify-center min-h-screen bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
            <h3 class="text-xl font-semibold text-center text-gray-800 mb-6">{{ __('Edit Address') }}</h3>
            
            <!-- Country Selection -->
            <div class="mt-4">
                <label for="edit_country" class="block text-sm font-medium text-gray-700">{{ __('Country') }}</label>
                <select id="edit_country" wire:model="newAddress.country_id" wire:change="loadStates" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    <option value="">{{ __('Select Country') }}</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('newAddress.country_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- State Selection -->
            <div class="mt-4">
                <label for="edit_state" class="block text-sm font-medium text-gray-700">{{ __('State') }}</label>
                <select id="edit_state" wire:model="newAddress.state_id" wire:change="loadCities" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    <option value="">{{ __('Select State') }}</option>
                    @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('newAddress.state_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- City Selection -->
            <div class="mt-4">
                <label for="edit_city" class="block text-sm font-medium text-gray-700">{{ __('City') }}</label>
                <select id="edit_city" wire:model="newAddress.city_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    <option value="">{{ __('Select City') }}</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('newAddress.city_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address Line 1 -->
            <div class="mt-4">
                <label for="edit_address_line_1" class="block text-sm font-medium text-gray-700">{{ __('Address Line 1') }}</label>
                <input id="edit_address_line_1" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" wire:model.defer="newAddress.address_line_1" />
                @error('newAddress.address_line_1') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address Line 2 -->
            <div class="mt-4">
                <label for="edit_address_line_2" class="block text-sm font-medium text-gray-700">{{ __('Address Line 2') }}</label>
                <input id="edit_address_line_2" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" wire:model.defer="newAddress.address_line_2" />
                @error('newAddress.address_line_2') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons -->
            <div class="mt-6 flex justify-end">
                <button wire:click="$set('showEditModal', false)" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring focus:ring-offset-2 focus:ring-gray-500">
                    {{ __('Cancel') }}
                </button>
                <button wire:click="updateAddress" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring focus:ring-offset-2 focus:ring-red-500">
                    {{ __('Update Address') }}
                </button>
            </div>
        </div>
    </div>
@endif
@endif
</div>



<div class="hidden sm:block">
    <div class="py-8">
        <div class="border-t border-gray-200"></div>
    </div>
</div>

@if (!auth()->user()->isAdmin())
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1 flex justify-between">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Addresses') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ __('Add your addresses.') }}</p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl text-sm text-gray-600">
                        {{ __('Manage your addresses associated with your account. You can add or remove addresses as needed.') }}
                    </div>

                    <div class="mt-5">
                        <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <a href="/add" class="btn btn-primary">{{ __('Add New Address') }}</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


