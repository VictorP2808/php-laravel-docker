<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    // Shows news from API
    public function getNews() {
         $apiToken='jdR7kSJJlDzInE3Xy6JuFt7tyU2ESXkZsMWaB9tR';
         $response=Http::get("https://api.marketaux.com/v1/news/all", [
             'api_token'=>$apiToken,
             'symbols' => 'AAPL,TSLA',
             'filter_entities' => 'true',
             'limit'=>10
         ]);
         $r=$response->json();
         $news=$r['data'];

          $apiToken='jdR7kSJJlDzInE3Xy6JuFt7tyU2ESXkZsMWaB9tR';
         $response=Http::get("https://api.marketaux.com/v1/news/all", [
             'api_token'=>$apiToken,
             'symbols' => 'AAPL,TSLA',
             'filter_entities' => 'true',
             'limit'=>10
         ]);
         $r=$response->json();
         $news=$r['data'];

         $curl = curl_init();

// curl_setopt_array($curl, [
// 	CURLOPT_URL => "https://yahoo-finance15.p.rapidapi.com/api/yahoo/ne/news/TSLA",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 10,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => [
// 		"X-RapidAPI-Host: yahoo-finance15.p.rapidapi.com",
// 		"X-RapidAPI-Key: c27b5612b9msh8ab4f6395705c09p18166cjsn91e9563d42d2"
// 	],
// ]);

// $response = curl_exec($curl);
// $news=json_decode($response)->item;
// return view ('companies.index', [
//     'news'=>array_slice($news, 0, 5)]);
    }

}