<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JsonDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = File::get(database_path('portfolios.json'));
        $data = json_decode($jsonData, true);

        foreach ($data as $item) {
            // Assuming you have a Model called "Item"
            Portfolio::create([
                'user_id' => $item['user_id'],
                'company_id' => $item['company_id'],
                'shares_qty' => $item['shares_qty'],
                'total_invested' => $item['total_invested'],
                'current_cost' => $item['current_cost'],
                'gain' => $item['gain'],
                'performance_percentage' => $item['performance_percentage'],
                'last_purchase_date' => $item['last_purchase_date']
                // ... and so on for other fields
            ]);
        }
    }
}
