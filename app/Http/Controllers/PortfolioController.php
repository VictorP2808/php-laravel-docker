<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function destroy(User $user, Portfolio $company){
        $company->delete();
        return redirect("/users/$user->id/dashboard")->with('message', 'Company was deleted from your portfolio');
    }
    
}
