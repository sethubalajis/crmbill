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
            $table->string('name', 100)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('phone2', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('postalcode', 30)->nullable();
            $table->string('gstinno', 50)->nullable();
            $table->string('pan', 50)->nullable();
            $table->string('bankname', 50)->nullable();
            $table->string('accountno', 50)->nullable();
            $table->string('ifsc', 20)->nullable();
            $table->string('accountname', 100)->nullable();
            $table->string('logo', 300)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
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
