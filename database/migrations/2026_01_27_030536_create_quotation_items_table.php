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
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->unsignedBigInteger('gst_id')->nullable();
            $table->decimal('item_rate', 10, 2)->nullable();
            $table->decimal('item_gst', 10, 2)->nullable();
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null');
            $table->foreign('gst_id')->references('id')->on('gsts')->onDelete('set null');
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
