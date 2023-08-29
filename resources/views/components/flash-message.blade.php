@if (session()->has('message'))
    <div x-data="{ show:true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="rounded opacity-80 fixed top-2 left-1/2 transform -translate-x-1/2 bg-laravel2 text-white px-10 py-5">
        {{-- x-data : when flash message is triggered, it will be displayed --}}
        {{-- x-init : after 4seconds, the message will go away/no longer be displayed --}}
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif