<!-- Using Blade components in Laravel -->

<!-- The following code defines a reusable component named 'card' -->

{{-- to override/add classes to our component we need to merge attributes --}}
{{-- $attributes represents all the attributes our component has
     --}}
     <div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}} >
        {{-- The 'attributes' variable is provided by Laravel and contains any HTML attributes that are passed to the component.
        It allows you to dynamically apply attributes to the component. Here, we're using the 'merge' method to merge additional attributes into the existing attributes of the <div> element. --}}
    
        {{-- Within this component, you can insert content using the 'slot' variable. The 'slot' variable acts as a placeholder for the content that will be passed into the component when it's used. --}}
    
        {{$slot}}
        {{-- Here, we're echoing out the content that's passed into the component when it's used. Any content placed inside the <x-card> tag will be displayed here within this <div>. --}}
    </div>
    