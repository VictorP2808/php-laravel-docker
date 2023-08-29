<x-layout>
    {{-- add hero partial --}}
    @include('partials._hero')

   {{-- Only authorized users can access the search bar --}}
    @auth
    @include('partials._search')
    @endauth

    <div class="flex flex-row flex-wrap justify-center gap-3">    
    @include('components.news')
    </div>

   <div class="h-32"></div>
    @auth
       @include('components.company-card')
       {{-- adding new div to add page direct buttons : This is sick and much easier than the way we had to do it in PHP : WOO!--}}
    <div class="mt-6 p-4">
        {{$companies->links()}}
    </div>
    @endauth

   @guest
        @include('components.aboutUs')
    @endguest
 



   @include('components.contactForm')
</x-layout>

