<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
</head>
<body class="bg-gray-100 font-sans mb-40">
    <x-layout>
        <section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                    Welcome {{ auth()->user()->first_name }} to your portfolio
                </h1>
                <p class="text-xl md:text-2xl lg:text-3xl">
                    Get ready to manage your stock investments and financial future.
                </p>
            </div>
        </section>
        
        
    
        <div class="">
            <div class="flex xl:flex-row lg:flex-row md:flex-col sm:flex-col flex-wrap ">
                <x-card class="mx-auto mt-8 md:mt-12 lg:mt-16 xl:w-2/5 lg:w-2/5  rounded-lg bg-gray-100 border min-w-1 shadow-md">
                    <div class=" flex flex-col h-full justify-between p-6">
                        <h1 class="text-center text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
                            Your Personal Data
                        </h1>
                        
                        <div class="text-gray-700">
                            <p class="pb-2 text-sm md:text-base lg:text-lg xl:text-xl my-2">
                                <span class="font-semibold">Name:</span> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                            </p>
                            <p class="pb-2 text-sm md:text-base lg:text-lg xl:text-xl my-2">
                                <span class="font-semibold">Age:</span> 
                                @php
                                    $bd = auth()->user()->birth_date;
                                    $today = date("Y-m-d");
                                    $age = substr($today, 0, 4) - substr($bd, 0, 4);
                                    echo $age;
                                @endphp
                                y.o.
                            </p>
                            <p class="pb-2 text-sm md:text-base lg:text-lg xl:text-xl my-2">
                                <span class="font-semibold">E-mail:</span> {{ auth()->user()->email}}
                            </p>
                            <p class="pb-2 text-sm md:text-base lg:text-lg xl:text-xl my-2">
                                <span class="font-semibold">Phone number:</span> {{ auth()->user()->phone_number}}
                            </p>
                            <p class="pb-2 text-sm md:text-base lg:text-lg xl:text-xl my-2">
                                <span class="font-semibold">Address:</span> {{ auth()->user()->address}}, {{ auth()->user()->city}}, {{ auth()->user()->country}}, {{ auth()->user()->zip}}
                            </p>
                        </div>
                        <div class="flex justify-center ">
                            <a href="/users/{{ auth()->user()->id }}/edit" class="bg-laravel hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-lg">Change My Personal Data</a>
                        </div>
                    </div>
                </x-card>
                @if (empty($companies_in_portfolio))
                <x-card class="p-10 mx-auto mt-24 xl:w-2/5 lg:w-2/5  rounded-md shadow-md min-w-1">
                    <div class="text-center flex flex-col justify-between h-full">
                        <h1 class="text-center pt-2 sm:text-lg md:text-xl lg:text-2-xl xl:text-3xl font-bold uppercase text-laravel" style="font:family 'Roboto', sans-serif;">
                                Portfolio's resume</h1>
                        <p class="pb-2 text-2xl text-gray-200  sm:text-lg md:text-xl lg:text-2-xl xl:text-3xl my-4 text-laravel2"> <span class="font-bold text-laravel">No companies in your portfolio </span></p>
                        <a href="/" class="bg-laravel text-white py-2 mx-auto px-4 rounded sm:text-lg md:text-xl lg:text-2xl xl:text-3xl hover:text-laravel2">Add companies to your portfolio</a>
                    </div>
                </x-card>
                @else    
                <x-card class="mx-auto mt-12 md:mt-16 lg:mt-20 xl:w-2/5 lg:w-2/5 rounded-lg bg-gray-100 shadow-md min-w-1">
                    <div class="p-6">
                        <h1 class="text-center text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
                            Top 3 Companies in Your Portfolio
                        </h1>
                        <p class="text-center text-lg md:text-xl lg:text-2xl text-gray-700 mb-6">
                            With the Best EPS-index
                        </p>
                        <div class="grid grid-cols-3 gap-6 justify-center">
                            @foreach($best_EPS as $be)
                            <div class="flex flex-col items-center justify-center p-4 border rounded-lg shadow-md bg-white">
                                <img src="{{ asset('logos/'.$be['ticker'].'.png') }}" class="w-20 h-auto mb-2" alt="">
                                <p class="text-lg text-gray-700">{{ $be['EPS'] }}</p>
                            </div>
                            @endforeach
                        </div>
                        <p class="text-center text-lg md:text-xl lg:text-2xl text-gray-700 mt-8 mb-6">
                            With the Best Performance
                        </p>
                        <div class="grid grid-cols-3 gap-6 justify-center">
                            @foreach($best_perf as $bp)
                            <div class="flex flex-col items-center justify-center p-4 border rounded-lg shadow-md bg-white">
                                <img src="{{ asset('logos/'.$bp['ticker'].'.png') }}" class="w-20 h-auto mb-2" alt="">
                                <p class="text-lg text-gray-700">{{ $bp['perf'] }}%</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </x-card>
            </div>
                
            </div>
            <div class="flex flex-col items-center mt-8">

                <x-card class="p-10  rounded-lg bg-white shadow-lg mx-auto xl:w-2/5 lg:w-2/5">
                    <div class="">
                    <h1 class="text-center text-2xl md:text-3xl lg:text-4xl font-bold mb-4 text-laravel">
                        Portfolio's Resume
                    </h1>
                    <p class="text-center text-lg md:text-xl lg:text-2xl text-gray-700 mb-6">
                        Companies in Portfolio: {{ count($companies) }}
                    </p>
                    <p class="text-center text-xl lg:text-2xl text-gray-700 mb-4">
                        <span class="font-bold text-laravel">Total Investment:</span> {{ $total_invest }} $
                    </p>
                    <p class="text-center text-xl lg:text-2xl mb-4">
                        <span class="font-bold text-laravel">Portfolio Gain:</span>
                        @if ($total_gain >= 0)
                            <span class="text-green-600">{{ $total_gain }} $</span>
                        @else
                            <span class="text-red-600">{{ $total_gain }} $</span>
                        @endif
                    </p>
                    <p class="text-center text-xl lg:text-2xl mb-6">
                        <span class="font-bold text-laravel">Portfolio Performance:</span>
                        @if ($portfolio_performance >= 0)
                            <span class="text-green-600">{{ number_format($portfolio_performance, 2) }}%</span>
                        @else
                            <span class="text-red-600">{{ number_format($portfolio_performance, 2) }}%</span>
                        @endif
                    </p>
                </div>
            </x-card>
            </div>
        

    <x-card class="p-10 mt-24 w-5/6 mx-auto rounded-md shadow-md shadow-laravel" >
        <div class="flex justify-between mb-2">
            <h1 class="text-2xl font-bold">Your portfolio</h1>

            <button id="sort-by-cost" class="hover:text-black text-blue-600 rounded-lg text-lg"><i class="fa-solid fa-arrow-down"></i><i class="fa-solid fa-arrow-up"></i> Sort By Cost</button>
        </div>
        <div class="bg-white overflow-x-auto">
           
            <table class="w-full border-collapse" id="portfolio-table">
                <thead>
                    <tr class="bg-gray-200 ">
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Company Name</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Symbol</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Sector</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Market Cap (trillions $)</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Analytics Rating</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">24h Price Change</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Share Quantity</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Performance Percentage</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Current Share Cost</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Last Purchase Date</th>
                        <th class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl font-bold border">Delete/Sale</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $c)
                    <tr class="hover:bg-gray-100 portfolio-row" >
                        <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ $c->shortname }}</td>
                        <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ $c->ticker }}</td>
                        <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ $c->sector }}</td>
                        <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ number_format($c->market_cap/1000000000000, 2) }} T</td>
                        <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ $c->recomendation }}</td>
                        <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ $c->regular_market_delta }}</td>
                        <!-- Add more table data cells here -->
                        @foreach ($companies_in_portfolio as $cp)
                            @if ($cp->company_id == $c->id)
                                <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ $cp->shares_qty }}</td>
                                @if ($cp->performance_percentage >= 0)
                                    <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border bg-green-100">{{ $cp->performance_percentage }}%</td>
                                @elseif ($cp->performance_percentage < 0)
                                    <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border bg-red-100">{{ $cp->performance_percentage }}%</td>
                                @endif
                                <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border current-cost">{{ $cp->current_cost }} $</td>
                                <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">{{ $cp->last_purchase_date }}</td>
                                <td class="py-2 px-4 text-center text-sm md:text-base lg:text-lg xl:text-xl border">
                                    <a href="/users/{{ auth()->user()->id }}/dashboard/{{ $cp->id }}" class="bg-laravel hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-lg">Delete</a>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-6">
            <a href="/" class="bg-laravel hover:bg-blue-600 text-white py-2 px-4 rounded-lg text-lg">Add companies to your portfolio</a>
        </div>
    </x-card>
    @endif
</div>
    
    
    
            
    </x-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rows = Array.from(document.querySelectorAll('.portfolio-row'));
            let sortByCostDescending = true; // Initial sort order
            
            const sortByProperty = (property) => (a, b) => {
                const valueA = a.querySelector(`.${property}`).textContent;
                const valueB = b.querySelector(`.${property}`).textContent;
                return sortByCostDescending
                    ? valueB.localeCompare(valueA) // Descending order
                    : valueA.localeCompare(valueB); // Ascending order
            };
    
            const portfolioTable = document.querySelector('#portfolio-table');
            const sortByCostButton = document.querySelector('#sort-by-cost');
    
            sortByCostButton.addEventListener('click', function () {
                sortByCostDescending = !sortByCostDescending; // Toggle the sort order
                rows.sort(sortByProperty('current-cost'));
                rows.forEach(row => portfolioTable.appendChild(row));
            });
        });
    </script>
    
</body>
</html>





