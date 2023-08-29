<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit User Info
            </h2>
        </header>
        @auth
            <form action="{{ route('user.update', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                {{-- First Name input --}}
                <div class="mb-6">
                    <label for="first_name" class="inline-block text-lg mb-2">
                        First Name
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="first_name"
                        value="{{ $user->first_name }}" />
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Last Name input --}}
                <div class="mb-6">
                    <label for="last_name" class="inline-block text-lg mb-2">
                        Last Name
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="last_name"
                        value="{{ $user->last_name }}" />
                    @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                {{-- Input for email --}}
                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Email</label>
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                        value="{{ $user->email }}" />

                </div>

                {{-- Inputs for postal_address, zip_code, and city --}}
                <div class="mb-6">
                    <label for="address" class="inline-block text-lg mb-2">Street Address</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="address"
                        value="{{ $user->address }}" />
                    @error('postal_address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                <div>
                    <label for="city" class="inline-block text-lg mb-2">City</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="city"
                        value="{{ $user->city }}" />
                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>
                
                <div>
                    <label for="country" class="inline-block text-lg mb-2">Country
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="country"
                        value="{{ $user->country}}" />
                    @error('city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                <div>
                    <label for="zip" class="inline-block text-lg mb-2">Zip Code</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="zip"
                        value="{{ $user->zip}}" />
                    @error('zip_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                {{-- Input for Phone Number --}}
                <div class="mb-6">
                    <label for="birth_date" class="inline-block text-lg mb-2">Date of Birth</label>
                    <input type="date" class="border border-gray-200 rounded p-2 w-full" name="birth_date"
                        value="{{ $user->birth_date }}" />
                    @error('birth_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="phone_number" class="inline-block text-lg mb-2">Phone number</label>
                    <input type="tel" class="border border-gray-200 rounded p-2 w-full" name="phone_number"
                        placeholder="123-123-123" {{-- pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" --}} value="{{ $user->phone_number }}" />
                    @error('phone_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">
                        Password
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                        value="{{ $user->password }}" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password2" class="inline-block text-lg mb-2">
                        Confirm Password
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        {{-- This will display the validation error message --}}
                    @enderror
                </div>

                {{-- edit user info button --}}
                <div class="mb-6">
                    <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                        Edit Profile
                    </button>

                    <a href="/" class="text-black ml-4"> Back </a>
                </div>
            </form>
        @endauth
    </x-card>


</x-layout>
