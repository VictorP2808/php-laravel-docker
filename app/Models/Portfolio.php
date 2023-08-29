<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'company_id',
            'shares_qty',
            'total_invested',
            'current_cost',
            'gain',
            'performance_percentage',
            'last_purchase_date'        
    ];

    public function scopeFilter($query, $filters){       
            $query->where('user_id', '=', $filters);        
    }

    // relationship to User model
    public function user() {
        // Now for Laravel, our Listing belongs to a sinlge User
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function company() {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
