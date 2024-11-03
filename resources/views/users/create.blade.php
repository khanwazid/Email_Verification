<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  
    <style>
        .form-container { max-width: 600px; margin: 0 auto; }
    </style></head>
  <body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Profile</h3>
    </div>
    
        <div class="container">
    <div class="form-container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1>Create Profile</h1>
                    <form enctype="multipart/form-data" action="{{ route('profiles.store') }}" method="post">
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
<div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input value="{{ old('image') }}" type="file" class="@error('image') is-invalid @enderror form-control form-control-lg" placeholder="Image" name="image">
                                @error('image')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
</div>
                          

                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
  </body>
</html>



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