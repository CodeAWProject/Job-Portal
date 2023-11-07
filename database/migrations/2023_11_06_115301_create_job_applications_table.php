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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            // You can't have a job application without both a user and a job.
            $table->foreignIdFor(\App\Models\User::class)->constrained();
        
            $table->foreignIdFor(\App\Models\Job::class)->constrained()
                ->onDelete('cascade');
            $table->timestamps();

            $table->unsignedInteger('expected_salary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
