<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24"> 
{{-- ! Temproary template to keep minimum css \/ \/ --}}


<header class="text-center">
    <h2 class="text-2xl font-bold uppercase mb-1">
        Register
    </h2>
    <p class="mb-4">Create an account to post products</p>
</header>
<form action="/users" method="POST">
    @csrf {{-- attack prevention --}}

    {{-- User personal data --}}
    <div class="mb-6">
        <label for="first_name" class="inline-block text-lg mb-2">
            First Name
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="first_name"
            value="{{ old('first_name') }}" />
        @error('first_name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="last_name" class="inline-block text-lg mb-2">
            Last Name
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="last_name"
            value="{{ old('last_name') }}" />
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="birth_date" class="inline-block text-lg mb-2">
            Date of Birth
        </label>
        <input type="date" class="border border-gray-200 rounded p-2 w-full" name="birth_date"
            value="{{ old('birth_date') }}" />
        @error('birth_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- User contact data  --}}
    <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">Email</label>
        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
            value="{{ old('email') }}" />
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="phone_number" class="inline-block text-lg mb-2">Phone number</label>
        <input type="tel" name="phone_number" class="border border-gray-200 rounded p-2 w-full"
            name="phone_number" placeholder="661661661" value="{{ old('phone_number') }}" />
        @error('phone_number')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- User Address --}}
    <div class="mb-6">
        <label for="address" class="inline-block text-lg mb-2">Street and home number</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="address"
            value="{{ old('address') }}" />
        @error('address')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        <label for="city" class="inline-block text-lg mb-2">City</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="city"
            value="{{ old('city') }}" />
        @error('city')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        <label for="country" class="inline-block text-lg mb-2">Country</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="country"
            value="{{ old('country') }}" />
        @error('country')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        
        <label for="zip" class="inline-block text-lg mb-2">Zip Code</label>
        <input type="number" class="border border-gray-200 rounded p-2 w-full" name="zip"
            value="{{ old('zip') }}" />
        @error('zip')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Password --}}
    <div class="mb-6">
        <label for="password" class="inline-block text-lg mb-2">
            Password
        </label>
        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
            value="{{ old('password') }}" />
        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label for="password2" class="inline-block text-lg mb-2">
            Confirm Password
        </label>
        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />
        @error('password_confirmation')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
            Sign Up
        </button>
    </div>

    <div class="mt-8">
        <p>
            Already have an account?
            <a href="/login" class="text-laravel">Login</a>
        </p>
    </div>
</form>


    </x-card>
</x-layout> 
