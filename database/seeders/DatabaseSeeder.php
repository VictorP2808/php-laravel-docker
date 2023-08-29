<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\News;

use App\Models\User;
use App\Models\Symbol;


use App\Models\Company;
use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Banana',
            'last_name' => 'Man',
            'address' => '456 Somewhere Ave.',
            'city' => 'Luxembourg City',
            'country' => 'Luxembourg',
            'zip' => '2222',
            'birth_date' => '2022-08-27',
            'phone_number' => '123-123-123',
            'email' => 'banana.man@gmail.com',
            'password' => 'Pa$$word123?'
        ]);
        User::factory()->create([
            'first_name' => 'Loren',
            'last_name' => 'Butterfly',
            'address' => '456 Somewhere Ave.',
            'city' => 'Luxembourg City',
            'country' => 'Luxembourg',
            'zip' => '2222',
            'birth_date' => '1998-01-27',
            'phone_number' => '123-123-222',
            'email' => 'loren.butterfly@gmail.com',
            'password' => 'butterflyis'
        ]);
        $this->call(SymbolSeeder::class);

        $companies = Symbol::all();
        $data = [];
        $arrayresponse = [];

        foreach ($companies as $company) {
            //  $companiesCount = count($companies);
            //  dd($companiesCount);

            $symbol = $company->ticker;
            //  dump("Fetching data for symbol: {$symbol}"); 

            $response = Http::withHeaders([
                'X-RapidAPI-Host' => 'yahoo-finance15.p.rapidapi.com',
                'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            ])->get("https://yahoo-finance15.p.rapidapi.com/api/yahoo/mo/module/{$symbol}", [
                'module' => 'asset-profile,financial-data,earnings'
            ]);


            $response2 = Http::withHeaders([
                'X-RapidAPI-Host' => 'yahoo-finance15.p.rapidapi.com',
                'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            ])->get("https://yahoo-finance15.p.rapidapi.com/api/yahoo/qu/quote/{$symbol}", [
                //'module' => 'asset-profile,financial-data,earnings'
            ]);

            if ($response && $response2->successful()) {
                $arrayresponse[0] = $response->json();
                // $arrayresponse[1] = $response1->json();
                $arrayresponse[2] = $response2->json();
                Company::create(
                    [
                        'shortname' => $arrayresponse[2][0]['shortName'] ?? 'no data from API',
                        'fullname' => $arrayresponse[2][0]['longName'] ?? 'no data from API',
                        'ticker' => $symbol,
                        'country' => $arrayresponse[0]['assetProfile']['country'] ?? 'no data from API',
                        'sector' => $arrayresponse[0]['assetProfile']['sector'] ?? 'no data from API',
                        'industry' => $arrayresponse[0]['assetProfile']['industry'] ?? 'no data from API',
                        'market_cap' => $arrayresponse[2][0]['marketCap'] ?? 0,
                        'recomendation' => $arrayresponse[0]['financialData']['recommendationKey'] ?? 'no data from API',
                        'regular_market_price' => $arrayresponse[2][0]['regularMarketPrice'] ?? 0,
                        'regular_market_change' => $arrayresponse[2][0]['regularMarketChange'] ?? 0,
                        'target_mean_price' => $arrayresponse[0]['financialData']['targetMeanPrice']['raw'] ?? 0,
                        'EPS' => $arrayresponse[0]['earnings']['earningsChart']['quarterly'][0]['actual']['raw'] ?? 0,
                        'regular_market_delta' => $arrayresponse[2][0]['regularMarketDayRange'] ?? 'no data from API'
                    ]
                );
            } else {
                // Handle the error                 
            }
        }
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://yahoo-finance15.p.rapidapi.com/api/yahoo/ne/news/TSLA",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: yahoo-finance15.p.rapidapi.com",
                "X-RapidAPI-Key: c27b5612b9msh8ab4f6395705c09p18166cjsn91e9563d42d2"
            ],
        ]);

        $response = curl_exec($curl);
        $news = json_decode($response)->item;
        foreach ($news as $new) {
            News::create([
                'title' => $new->title,
                'description' => $new->description
            ]);
        }
        $this->call(JsonDataSeeder::class);
    }
}
