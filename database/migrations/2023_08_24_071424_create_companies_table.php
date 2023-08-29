<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('shortname');
            $table->string('fullname');
            $table->string('ticker');
            $table->string('country');
            $table->string('sector');
            $table->string('industry');
            $table->decimal('market_cap', 15, 2);
            $table->string('recomendation');
            $table->float('regular_market_price');            
            $table->float('regular_market_change');
            $table->float('target_mean_price');
            $table->float('EPS');
            $table->string('regular_market_delta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
