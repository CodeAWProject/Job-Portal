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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            
            //Every user can own a company and can add some job offers
            $table->string('company_name');
            //Users can optionally be the employer
            $table->foreignIdFor(\App\Models\User::class)
                ->nullable()->constrained();
            $table->timestamps();
        });

        //Every job needs to have an Id off the employer
        Schema::table('jobs', function(Blueprint $table) {
            $table->foreignIdFor(\App\Models\Employer::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function(Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Employer::class);
        });

        Schema::dropIfExists('employers');
    }
};
