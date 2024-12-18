<x-guest-layout>
    <x-authentication-card>
        <x-validation-errors class="mb-4" />

        <div class="container">
            <div class="card">
                <div class="form-header">
                    <h1 class="text-6xl font-bold text-center mb-8 text-blue-600">Add New Address</h1>
                </div>

                <div class="card-body">
                    {{-- Success Message --}}
                    
                    @if(session('success'))
    <div id="success-alert" style="background-color: #4ade80; border: 2px solid #22c55e;" class="px-6 py-4 rounded-lg shadow-lg mb-6 text-white">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif
                    {{-- Error Messages --}}
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Error</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Error</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

        <form method="POST" action="{{ route('addresses.store') }}">
            @csrf
            
  <div>
                <x-label for="country_id" value="{{ __('Country') }}" />
                <select name="country_id" id="country_id" class="block mt-1 w-full">
                    <option value="">{{ __('Select Country') }}</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="state_id" value="{{ __('State') }}" />
                <select name="state_id" id="state_id" class="block mt-1 w-full">
                    <option value="">{{ __('Select State') }}</option>
                </select>
                @error('state_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="city_id" value="{{ __('City') }}" />
                <select name="city_id" id="city_id" class="block mt-1 w-full">
                    <option value="">{{ __('Select City') }}</option>
                </select>
                @error('city_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="address_line_1" value="{{ __('Address Line 1') }}" />
                <x-input id="address_line_1" class="block mt-1 w-full" type="text" name="address_line_1" :value="old('address_line_1')" required />
                @error('address_line_1')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <x-label for="address_line_2" value="{{ __('Address Line 2') }}" />
                <x-input id="address_line_2" class="block mt-1 w-full" type="text" name="address_line_2" :value="old('address_line_2')" />
                @error('address_line_2')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

           

           {{--  <div class="mt-4">
    <x-label for="user_id" value="{{ __('Existing User') }}" />
    <select name="user_id" id="user_id" class="block mt-1 w-full" readonly>
        @foreach($users as $user)
            <option value="{{ $user->id }}" selected>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
    @error('user_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div> --}}
      


{{--<div class="mt-4">
    <x-label for="user_id" value="{{ __('Existing Users') }}" />
    <select name="user_id" id="user_id" class="block mt-1 w-full">
        <option value="">{{ __('Select User') }}</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}  
            </option>
        @endforeach
    </select>
    @error('user_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>--}}
@if(auth()->user()->role === 'admin')

<div class="mt-4">
    <x-label for="user_id" value="{{ __('Select User') }}" />
    <select name="user_id" id="user_id" class="block mt-1 w-full">
        <option value="">{{ __('Select User') }}</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}  
            </option>
        @endforeach
    </select>
    @error('user_id')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
@else
<input type="hidden" name="user_id" value="{{ auth()->id() }}">
@endif



            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Submit') }}
                </x-button>
               <a class="ml-4 underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('profile.show') }}">
                    {{ __('Cancel?') }}
                </a>
            </div>
        </form>
    

    <!-- jQuery inclusion -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- AJAX for dependent dropdowns -->
    <script>
        $(document).ready(function() {
            var oldStateId = '{{ old('state_id') }}';
            var oldCityId = '{{ old('city_id') }}';

            $('#country_id').on('change', function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: '{{ route("get.states") }}',
                        type: 'GET',
                        data: { country_id: countryId },
                        success: function(data) {
                            $('#state_id').empty().append('<option value="">{{ __('Select State') }}</option>');
                            $.each(data, function(key, value) {
                                var selected = (value.id == oldStateId) ? 'selected' : '';
                                $('#state_id').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                            });
                            $('#city_id').empty().append('<option value="">{{ __('Select City') }}</option>');

                            if (oldStateId) {
                                $('#state_id').trigger('change');
                            }
                        }
                    });
                } else {
                    $('#state_id').empty().append('<option value="">{{ __('Select State') }}</option>');
                    $('#city_id').empty().append('<option value="">{{ __('Select City') }}</option>');
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
                            $('#city_id').empty().append('<option value="">{{ __('Select City') }}</option>');
                            $.each(data, function(key, value) {
                                var selected = (value.id == oldCityId) ? 'selected' : '';
                                $('#city_id').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city_id').empty().append('<option value="">{{ __('Select City') }}</option>');
                }
            });

            var oldCountryId = '{{ old('country_id') }}';
            if (oldCountryId) {
                $('#country_id').trigger('change');
            }
        });
    </script>
     <script>
    $(document).ready(function() {
        $('#success-alert').fadeIn('slow');
        setTimeout(function() {
            $('#success-alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 4000);
    });
</script>
        </x-authentication-card>
</x-guest-layout>
