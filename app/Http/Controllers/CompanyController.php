<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Symbol;
use App\Models\Company;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{

    public function index()
    {
        // Fetch all tickers from the database
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
        $news_to_show = News::all();
        return view(
            'companies.index',
            [
                'companies' => Company::oldest()->filter(request(['search']))->paginate(8),
                'news' => $news_to_show
            ]
        );
    }


    public function show($ticker)
    {
        $company = Company::where('ticker', $ticker)->first();

        $noData = '// missing data //'; // missing data error code

        $businessDays = [];
        $date = new DateTime();
        while (count($businessDays) < 5) {
            $date->modify('-1 day');
            // skip weekends (Saturday = 6, Sunday = 0)
            if ($date->format('N') >= 6) {
                continue;
            }
            $businessDays[] = $date->format('Y-m-d');
        }

        $apiKey = 'c27b5612b9msh8ab4f6395705c09p18166cjsn91e9563d42d2'; // API key
        $url = "https://query1.finance.yahoo.com/v8/finance/chart/{$ticker}?apiKey={$apiKey}";
        // response
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        // fetch high prices for the last 30 days
        $highPrices = $data['chart']['result'][0]['indicators']['quote'][0]['high'];

        // creating fake numbers in case of API crashes or doesnt provide full package of data
        $highPricesLast30 = [];

        // $min = 150;
        // $max = 160;

        // $previousNumber = rand($min * 100, $max * 100) / 100; // Initial number with two decimals
        // $highPricesLast30[] = $previousNumber;


        // foreach (range(1, 29) as $i) {
        //     $minValue = max($min, $previousNumber - 1);
        //     $maxValue = min($max, $previousNumber + 1);

        //     $randomNumber = rand($minValue * 100, $maxValue * 100) / 100;
        //     $highPricesLast30[] = $randomNumber;

        //     $previousNumber = $randomNumber;
        // }
        if (count($highPrices) >= 30) {
            $startIndex = count($highPrices) - 30;
            for ($i = $startIndex; $i < count($highPrices); $i++) {
                $highPricesLast30[] = $highPrices[$i];
            }
        }
        // high prices reverse for the chart to dislay it from left to right
        $highPricesLast30reverse = array_reverse($highPricesLast30);
        // fill labelsArray with numbers for each fetched high price data to have chart labeled correctly
        $labelsArray = [];
        for ($i = 1; $i <= count($highPricesLast30); $i++) {
            $labelsArray[] = $i;
        }
        $labelsArray = array_reverse($labelsArray);
        // main price color change based on the difference between two last days
        $difference = number_format(((($highPricesLast30[0] - $highPricesLast30[1]) / $highPricesLast30[1]) * 100), 3);
        $classInd = ($difference >= 0) ? "green" : "red";

        // get the 52 week high max and min prices
        $prices = $highPrices;
        $week52High = max($prices);
        $week52Low = min($prices);
        // troubleshooting if the min price == 0
        if ($week52Low == 0) {
            $nonZeroPrices = array_filter($prices, function ($price) {
                return $price > 0;
            });
            $week52Low = min($nonZeroPrices);
        }

        // fetch regular market price
        $regPrice = $data['chart']['result'][0]['meta']['regularMarketPrice'];

        // fetch all volume and sum up
        $volumeData = $data['chart']['result'][0]['indicators']['quote'][0]['volume'];
        if (!empty($volumeData)) {
            $totalVolume = array_sum($volumeData);
        } else {
            $totalVolume = 0;
        }

        $descriptionUrl = "https://yahoo-finance15.p.rapidapi.com/api/yahoo/mo/module/{$ticker}";
        $descriptionResponse = Http::withHeaders([
            'X-RapidAPI-Host' => 'yahoo-finance15.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
        ])->get($descriptionUrl, [
            'module' => 'asset-profile,financial-data,earnings'
        ]);
        $descriptionApiData = $descriptionResponse->json();
        $description = $descriptionApiData['assetProfile']['longBusinessSummary'] ?? 'Description not available';

        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'yahoo-finance15.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
        ])->get("https://yahoo-finance15.p.rapidapi.com/api/yahoo/mo/module/{$ticker}", [
            'module' => 'asset-profile,financial-data,earnings'
        ]);
        $response2 = Http::withHeaders([
            'X-RapidAPI-Host' => 'yahoo-finance15.p.rapidapi.com',
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
        ])->get("https://yahoo-finance15.p.rapidapi.com/api/yahoo/qu/quote/{$ticker}", [
            //'module' => 'asset-profile,financial-data,earnings'
        ]);
        if ($response && $response2->successful()) {
            $arrayresponse[0] = $response->json();
            // $arrayresponse[1] = $response1->json();
            $arrayresponse[2] = $response2->json();
            $company->fill([
                'recomendation' => $arrayresponse[0]['financialData']['recommendationKey'] ?? 'no data from API',
                'regular_market_price' => $arrayresponse[2][0]['regularMarketPrice'] ?? 0,
                'regular_market_change' => $arrayresponse[2][0]['regularMarketChange'] ?? 0,
                'target_mean_price' => $arrayresponse[0]['financialData']['targetMeanPrice']['raw'] ?? 0,
                'EPS' => $arrayresponse[0]['earnings']['earningsChart']['quarterly'][0]['actual']['raw'] ?? 0,
                'regular_market_delta' => $arrayresponse[2][0]['regularMarketDayRange'] ?? 'no data from API'
            ]);
            $company->save();
        } else {
            //exception
        }
        return view('companies.show', [
            'company' => $company,
            'description' => $description,
            'highPricesLast30reverse' => $highPricesLast30reverse,
            'highPricesLast30' => $highPricesLast30,
            'labelsArray' => $labelsArray,
            'classInd' => $classInd,
            'difference' => $difference,
            'week52High' => $week52High,
            'regPrice' => $regPrice,
            'totalVolume' => $totalVolume,
            'businessDays' => $businessDays,
            'date' => $date,
            'noData' => $noData,
            'week52Low' => $week52Low,
        ]);
    }



    public function store(Request $request)
    {
        $ticker = $request->route('ticker'); // Get the value of the ticker parameter
                $company = Company::where('ticker', $ticker)->first();
                $u_id=Auth::id();
                $qty = $request->validate([
                    'quantity' => 'required|numeric|min:1', 
                ]);
                $existed=false;
                $current_cost=$company->regular_market_price;
                
                $companies_in_portfolio = Portfolio::where('user_id', $u_id)->get(); 
                if ($companies_in_portfolio->isEmpty()){
                    $formfields = [
                        'user_id'=>$u_id,
                        'company_id'=> $company->id,                     
                        'last_purchase_date'=>Carbon::today(),
                        'shares_qty'=>$qty['quantity'],
                        'current_cost'=>$current_cost,
                        'total_invested'=> $qty['quantity'] * $current_cost,
                        'gain'=>0,
                        'performance_percentage'=>0               
                    ];
                    Portfolio::create($formfields);
                }else{
                    foreach($companies_in_portfolio as $cp){
                        if ($cp->company_id==$company->id){
                            $ec = Portfolio::where('user_id', $u_id)
                            ->where('company_id', $company->id)
                            ->first(); 
                            $portfolio_id=$cp->id;
                            $existed=true;                       
                            $formfields=[
                                'shares_qty'=>$ec->shares_qty + $qty['quantity'],
                                'current_cost'=>$current_cost,
                                'total_invested'=> $ec->total_invested + $qty['quantity'] * $current_cost,
                                'gain'=>$ec->shares_qty*$current_cost-$ec->total_invested,
                                'performance_percentage'=>$ec->gain * 100/$ec->total_invested,
                                'user_id'=>$u_id,
                                'company_id'=> $company->id,                     
                                'last_purchase_date'=>Carbon::today()
                            ];
                            Portfolio::find($portfolio_id)->update($formfields);
                        };
                    }
                    if (!$existed){
                        $formfields=[
                            'shares_qty'=>$qty['quantity'],
                            'current_cost'=>$current_cost,
                            'total_invested'=> $qty['quantity'] * $current_cost,
                            'gain'=>0,
                            'performance_percentage'=>0,
                            'user_id'=>$u_id,
                            'company_id'=> $company->id,                     
                            'last_purchase_date'=>Carbon::today()
                            ];
                            Portfolio::create($formfields);
                        }
                    }
                return redirect("/users/$u_id/dashboard")->with('message', "The company $company->shortname added to your portfolio");
    }
}
