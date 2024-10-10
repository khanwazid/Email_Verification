<x-guest-layout>
    <x-authentication-card>
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="username" value="{{ __('Username') }}" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone Number') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
    <x-label for="gender" value="{{ __('Gender') }}" />
    <select id="gender" name="gender" class="block mt-1 w-full"  required>
        {{--<option value="" disabled selected>{{ __('Select Gender') }}</option>
        <option value="0">{{ __('Male') }}</option>   
        <option value="1">{{ __('Female') }}</option> --}}
        <option value="" disabled selected>{{ __('Select Gender') }}</option>
        {{--<option value="" disabled selected>Select Gender</option>--}}
                    <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Male</option>
                    <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Female</option>
    </select>
</div>






         {{-- <div class="mt-4">
                <x-label for="image" value="{{ __('Profile Image') }}" />
                <x-input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" />
            </div>--}}
        
            
          {{-- <div class="mt-4">
    <label class="block font-medium text-sm text-gray-700" for="image">
        Profile Image
    </label>
    
    <!-- Hidden file input -->
    <input id="image" class="hidden" type="file" name="image" accept="image/*">

    <!-- Custom styled label acting as the button -->
    <label for="image" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
        Choose File
    </label>

    <!-- Display the selected file name -->
    <span id="file-name" class="text-sm text-gray-500 ml-3">No file chosen</span>
</div>

<!-- JavaScript to update the file name -->
<script>
    document.getElementById('image').addEventListener('change', function() {
        var fileName = this.files[0]?.name || 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>--}}
{{--<div class="mt-4">
    <label class="block font-medium text-sm text-gray-700" for="image">
        Profile Image
    </label>
    
    <div class="flex items-center mt-2">
        <!-- Hidden file input -->
        <input id="image" class="hidden" type="file" name="image" accept="image/*">

        <!-- Custom styled label acting as the button -->
        <label for="image" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
            Choose File
        </label>

        <!-- Display the selected file name -->
        <span id="file-name" class="text-lg font-medium text-black ml-2">>No file chosen</span>
    </div>
</div>

<!-- JavaScript to update the file name -->
<script>
    document.getElementById('image').addEventListener('change', function() {
        var fileName = this.files[0]?.name || 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>--}}

{{--<div class="mt-4">
    <label class="block font-medium text-sm text-gray-700" for="image">
        Profile Image
    </label>
    
    <div class="flex items-center mt-2">
        <!-- Hidden file input -->
        <input id="image" class="hidden" type="file" name="image"  accept="image/*">

        <!-- Custom styled label acting as the button -->
        <label for="image" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
            Choose File
        </label>

        <!-- Display the selected file name -->
        <span id="file-name" class="text-lg font-medium text-black ml-3">No file chosen</span>
    </div>
</div>

<!-- JavaScript to update the file name -->
<script>
    document.getElementById('image').addEventListener('change', function() {
        var fileName = this.files[0]?.name || 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>--}}

<div class="mt-4">
    <label class="block font-medium text-sm text-gray-700" for="image">
        Profile Image
    </label>
    
    <div class="flex items-center mt-2">
        <!-- Hidden file input -->
        <input id="image" class="hidden" type="file" name="image" accept="image/*" 
               onchange="updateFileName(this)">

        <!-- Custom styled label acting as the button -->
        <label for="image" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer">
            Choose File
        </label>

        <!-- Display the selected file name -->
        <span id="file-name" class="text-lg font-medium text-black ml-3">
            @if(old('image'))
                {{ old('image')->getClientOriginalName() }}
                
            @else
                No file chosen
            @endif
        </span>
    </div>

    @error('image')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- JavaScript to update the file name -->
<script>
    function updateFileName(input) {
        var fileName = input.files[0]?.name || 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    }

     //Check if there's an old file name and update the display
    window.addEventListener('load', function() {
        var oldFileName = "{{ old('image') ? old('image')->getClientOriginalName() : '' }}";
        if (oldFileName) {
            document.getElementById('file-name').textContent = oldFileName;
        }
    });
    
</script>




 





            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
