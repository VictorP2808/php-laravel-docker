<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'shortname',
        'fullname',
        'ticker',
        'country',
        'sector',
        'industry',
        'market_cap',
        'recomendation',
        'regular_market_price',
        'regular_market_change',
        'target_mean_price',
        'EPS',
        'regular_market_delta'
    ];

    // Added this to create filtering for our search bar on the page. 
    public function scopeFilter($query, array $filters){
     
        if($filters['search'] ?? false) {
            // Make an array of keyword to search for
            $keywords = explode(' ', $filters['search']);
            // dd($keywords); //Check to see if the code is working correcting, like console.log()

            foreach($keywords as $keyword) {
            $query->where('shortname', 'like', '%' . $keyword . '%')->orWhere('fullname', 'like', '%' . $keyword . '%')->orWhere('ticker', 'like', '%' . $keyword . '%')->orWhere('sector', 'like', '%' . $keyword . '%')->orWhere('industry', 'like', '%' . $keyword . '%');
            }
        }}
}
