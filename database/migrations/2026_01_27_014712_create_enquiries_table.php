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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('company', 200)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('description', 500)->nullable();
            $table->date('callbackdate')->nullable();
            $table->time('callbacktime')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
