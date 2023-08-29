<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .shadow-green {
            box-shadow: 0 4px 6px rgba(0, 255, 0, 0.1);
        }
        
        .shadow-red {
            box-shadow: 0 4px 6px rgba(255, 0, 0, 0.1);
        }

        .card:hover {
            filter: brightness(95%);
        }

    </style>
</head>
<body>
    <div class="flex flex-wrap justify-center gap-3 mb-10 mt-10">
        @foreach ($companies as $company)

        <x-card id="company-card-{{ $company->ticker }}" class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 rounded-md shadow-md card {{ $company->regular_market_change >= 0 ? 'shadow-green' : 'shadow-red' }}">

            <a href="/companies/{{ $company->ticker }}">
                <div class="flex flex-col justify-center text-center">
    
                    <img src="{{ asset('logos/'.$company->ticker.'.png') }}" alt="{{ $company->shortname }} Logo"
                        class="card-img-top img-fluid rounded-circle company-logo p-3 img-thumbnail mx-auto d-block"
                        style="width: 100px; height: 100px;">
                    <h3 class="text-2xl">
                        {{ $company->shortname }}
                    </h3>
                    <h3 class="text-2xl">{{ $company->ticker }}</h3>
                    <p class=""><strong>Country: </strong> {{ $company->country }}</p>
                    <hr>
                    <p class=""><strong>Sector: </strong> {{ $company->sector }}</p>
                    <hr>
                    <p class=""><strong>Industry: </strong> {{ $company->industry }}</p>
                    <hr>
                    <p class="">
                        <strong>Market Cap: </strong>
                        @if ($company->market_cap >= 1000000000000)
                            {{ number_format($company->market_cap / 1000000000000, 2) }} T
                        @elseif ($company->market_cap >= 1000000000)
                            {{ number_format($company->market_cap / 1000000000, 2) }} B
                        @elseif ($company->market_cap >= 1000000)
                            {{ number_format($company->market_cap / 1000000, 2) }} M
                        @else
                            {{ $company->market_cap }}
                        @endif
                    </p>
                    <hr>
                    <p class="">
                        <strong>24H Change: </strong>
                        <span class="{{ $company->regular_market_change >= 0 ? 'text-green-500' : 'text-red-500' }}"
                            style="display: inline-block; margin-right: 5px;">
                            {{ $company->regular_market_change >= 0 ? '+' : '-' }}
                            ${{ number_format(abs($company->regular_market_change), 2) }}
                            <i class="{{ $company->regular_market_change >= 0 ? 'fas fa-arrow-up' : 'fas fa-arrow-down' }}"></i>
                        </span>
                    </p>
                </div>
            </a>
        </x-card>
        @endforeach
    </div>

</body>
</html>
