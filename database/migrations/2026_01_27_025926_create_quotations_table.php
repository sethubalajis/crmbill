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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotationno', 50)->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('gstcentral', 10, 2)->nullable();
            $table->boolean('intrastate')->nullable();
            $table->decimal('gststate', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
