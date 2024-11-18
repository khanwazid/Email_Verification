<x-guest-layout>
    <x-authentication-card>
        <x-validation-errors class="mb-4" />

        <div class="container">
            <div class="card">
                <div class="form-header">
                    <h1 class="text-6xl font-bold text-center mb-8 text-blue-600">Edit Address</h1>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                   
                   
                   
                   
                   <!-- Country Dropdown -->
<div>
    <x-label for="country_id" value="{{ __('Country') }}" />
    <select name="country_id" id="country_id" class="block mt-1 w-full">
        <option value="">{{ __('Select Country') }}</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}" 
                {{ old('country_id', optional(optional(optional($address->city)->state)->country)->id) == $country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    @error('country_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
</div>

<!-- State Dropdown -->
<div class="mt-4">
    <x-label for="state_id" value="{{ __('State') }}" />
    <select name="state_id" id="state_id" class="block mt-1 w-full">
        <option value="">{{ __('Select State') }}</option>
        @foreach($states as $state)
            <option value="{{ $state->id }}" 
                {{ old('state_id', optional(optional($address->city)->state)->id) == $state->id ? 'selected' : '' }}>
                {{ $state->name }}
            </option>
        @endforeach
    </select>
    @error('state_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
</div>

<!-- City Dropdown -->
<div class="mt-4">
    <x-label for="city_id" value="{{ __('City') }}" />
    <select name="city_id" id="city_id" class="block mt-1 w-full">
        <option value="">{{ __('Select City') }}</option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}" 
                {{ old('city_id', optional($address->city)->id) == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>
    @error('city_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
</div>
     {{-- 
                        <!-- Country Dropdown -->
                        <div>
                            <x-label for="country_id" value="{{ __('Country') }}" />
                            <select name="country_id" id="country_id" class="block mt-1 w-full">
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id', $address->city->state->country_id) == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                     {{--   <!-- State Dropdown -->
                        <div class="mt-4">
                            <x-label for="state_id" value="{{ __('State') }}" />
                            <select name="state_id" id="state_id" class="block mt-1 w-full">
                                <option value="">{{ __('Select State') }}</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ old('state_id', $address->city->state_id) == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City Dropdown -->
                        <div class="mt-4">
                            <x-label for="city_id" value="{{ __('City') }}" />
                            <select name="city_id" id="city_id" class="block mt-1 w-full">
                                <option value="">{{ __('Select City') }}</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id', $address->city_id) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

<!-- State Dropdown -->
<div class="mt-4">
    <x-label for="state_id" value="{{ __('State') }}" />
    <select name="state_id" id="state_id" class="block mt-1 w-full">
        <option value="">{{ __('Select State') }}</option>
        @foreach($states as $state)
            <option value="{{ $state->id }}" {{ old('state_id', $address->city->state_id) == $state->id ? 'selected' : '' }}>
                {{ $state->name }}
            </option>
        @endforeach
    </select>
    @error('state_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- City Dropdown -->
<div class="mt-4">
    <x-label for="city_id" value="{{ __('City') }}" />
    <select name="city_id" id="city_id" class="block mt-1 w-full">
        <option value="">{{ __('Select City') }}</option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}" {{ old('city_id', $address->city_id) == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>
    @error('city_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div> --}}


<!-- Country Dropdown -->
{{-- <div> uncomment this all dropdown and method(edit and update the last)in addresscontroller
    <x-label for="country_id" value="{{ __('Country') }}" />
    <select name="country_id" id="country_id" class="block mt-1 w-full">
        <option value="">{{ __('Select Country') }}</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}" 
                {{ old('country_id', optional(optional($address->city)->state)->country_id) == $country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    @error('country_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror

</div>

<!-- State Dropdown -->
<div class="mt-4">
    <x-label for="state_id" value="{{ __('State') }}" />
    <select name="state_id" id="state_id" class="block mt-1 w-full">
        <option value="">{{ __('Select State') }}</option>
        @foreach($states as $state)
            <option value="{{ $state->id }}" 
                {{ old('state_id', optional($address->city)->state_id) == $state->id ? 'selected' : '' }}>
                {{ $state->name }}
            </option>
        @endforeach
    </select>
    @error('state_id')
 <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
     @enderror
</div>

<!-- City Dropdown -->
<div class="mt-4">
    <x-label for="city_id" value="{{ __('City') }}" />
    <select name="city_id" id="city_id" class="block mt-1 w-full">
        <option value="">{{ __('Select City') }}</option>
        @foreach($cities as $city)
            <option value="{{ $city->id }}" 
                {{ old('city_id', $address->city_id) == $city->id ? 'selected' : '' }}>
                {{ $city->name }}
            </option>
        @endforeach
    </select>
    @error('city_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>   --}}

                        <!-- Address Line 1 -->
                        <div class="mt-4">
                            <x-label for="address_line_1" value="{{ __('Address Line 1') }}" />
                            <x-input id="address_line_1" class="block mt-1 w-full" type="text" name="address_line_1" :value="old('address_line_1', $address->address_line_1)" required />
                            @error('address_line_1')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address Line 2 -->
                        <div class="mt-4">
                            <x-label for="address_line_2" value="{{ __('Address Line 2') }}" />
                            <x-input id="address_line_2" class="block mt-1 w-full" type="text" name="address_line_2" :value="old('address_line_2', $address->address_line_2)" />
                            @error('address_line_2')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
          {{--            
            @if($address->user_id)
<!-- Hidden field to send the user_id -->
<input type="hidden" name="user_id" value="{{ $address->user_id }}">
@else
<div class="mt-4">
    <x-label for="user_id" value="{{ __('User') }}" />
    <select name="user_id" id="user_id" class="block mt-1 w-full">
        <option value="">{{ __('Select User') }}</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id', $address->user_id) == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    @error('user_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
@endif  17 OCT 13:40--}}


                        <!-- User Dropdown -->
                        <div class="mt-4">
                            <x-label for="user_id" value="{{ __('User') }}" />
                            <select name="user_id" id="user_id" class="block mt-1 w-full">
                                <option value="">{{ __('Select User') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $address->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div> 

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update Address') }}
                            </x-button>
                            <a class="ml-4 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('addresses.list') }}">
                                {{ __('Cancel?') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-authentication-card>

    <!-- jQuery inclusion -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- AJAX for dependent dropdowns -->
    <script>
        $(document).ready(function() {
            var oldStateId = '{{ old('state_id', $address->city->state_id ?? '') }}';
            var oldCityId = '{{ old('city_id', $address->city_id ?? '') }}';
            var oldCountryId = '{{ old('country_id', $address->city->state->country_id ?? '') }}';

            $('#country_id').on('change', function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: '{{ route("get.states") }}',
                        type: 'GET',
                        data: { country_id: countryId },
                        success: function(data) {
                            $('#state_id').empty().append('<option value="">{{ __("Select State") }}</option>');
                            $.each(data, function(key, state) {
                                $('#state_id').append('<option value="' + state.id + '">' + state.name + '</option>');
                            });

                            // If the previous selected country has a state already selected, mark it
                            if (oldCountryId == countryId) {
                                $('#state_id').val(oldStateId);
                                $('#state_id').change();
                            }
                        }
                    });
                } else {
                    $('#state_id').empty().append('<option value="">{{ __("Select State") }}</option>');
                }
            });

            $('#state_id').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '{{ route("get.cities") }}',
                        type: 'GET',
                        data: { state_id: stateId },
                        success: function(data) {
                            $('#city_id').empty().append('<option value="">{{ __("Select City") }}</option>');
                            $.each(data, function(key, city) {
                                $('#city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
                            });

                            // If the previous selected state has a city already selected, mark it
                            if (oldStateId == stateId) {
                                $('#city_id').val(oldCityId);
                            }
                        }
                    });
                } else {
                    $('#city_id').empty().append('<option value="">{{ __("Select City") }}</option>');
                }
            });

            // Trigger change events on page load to set the correct states and cities based on the existing address
            $('#country_id').val(oldCountryId).change();
        });
    </script>
</x-guest-layout>
