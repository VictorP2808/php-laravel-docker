<section class="relative bg-laravel flex pb-5 justify-center align-center space-y-4 mb-4">
    
    <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-center z-0"
        style="background-image: url('images/Arrows.jpg'); bg-repeat: repeat; background-size: 25%"></div>

<div class="flex flex-col justify-center align-center text-xl text-laravel2 w-2/3 rounded p-10 bg-laravel ">

    <h1 class="pb-7 text-center text-6xl font-bold uppercase text-white">
        Contact<span class="text-laravel2">Us
    </h1>

    <form action="{{ route('contact.us.store') }}" method="POST" class="z-10 relative w-80 text-lrg mx-auto">
        @csrf
        <label for="name">Full Name:</label>
        <br>
        <input class="mb-3 w-80 rounded p-2" type="text" name="name" placeholder="Name" id="name" value="{{ old('name') }}">
        @error('name')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        <br>

        <label for="email">Email:</label>
        <br>
        <input class="w-80 mb-3 rounded p-2" type="text" name="email" placeholder="Email" id="email" value="{{ old('email') }}">
        @error('email')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        <br>

        <label for="ticker">Company Ticker/Symbol:</label>
        <br>
        <input class="w-80 rounded p-2" type="text" id="ticker" name="ticker" placeholder="AAPL, GOOG, ATVI, SQSP..." value="{{ old('ticker') }}">
        @error('ticker')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        <br>

        <label for="subject">Subject:</label>
        <br>
        <input class="w-80 mb-3 rounded p-2" type="text" name="subject" placeholder="Subject of message" id="subject" value="{{ old('subject') }}">
        @error('subject')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        <br>

        <label for="message">Questions for Advisers:</label>
        <br>
        <textarea class="w-80 rounded p-2" id="message" name="message" id="message" rows="5" placeholder="Please type your message to our advisers and we will reply as soon as we can">{{ old('message') }}</textarea>
        @error('message')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
        <br>

        <button type="submit" class="bg-black text-white py-2 px-4 rounded text-sm">Submit</button>
    </form>
</div>
    
</section>