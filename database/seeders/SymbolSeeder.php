<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $symbols = [
            "AAPL", "ABBV", "ABT", "ACN", "ADBE", "AMD", "AMZN", "ASML", "AVGO", "AZN",
            "BABA", "BAC", "BRK-B", "CMCSA", "COST", "CRM", "CSCO", "CVX", "DHR", "FMX",
            "GOOG", "HD", "JNJ", "JPM", "KO", "LIN", "LLY", "MA", "MCD", "META", "MRK",
            "MSFT", "NFLX", "NVDA", "NVO", "NVS", "ORCL", "PEP", "PFE", "PG", "SHEL",
            "TCEHY", "TM", "TMO", "TSLA", "TSM", "UNH", "V", "WMT", "XOM"
        ];

        foreach ($symbols as $symbol) {
            DB::table('symbols')->insert([
                'ticker' => $symbol,
            ]);
        }
    }
}
