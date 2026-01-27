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
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->foreignId('gst_id')->nullable()->after('item_id')->constrained('gsts')->onDelete('restrict');
            $table->decimal('item_rate', 10, 2)->nullable()->after('quantity');
            $table->decimal('item_gst', 10, 2)->nullable()->after('item_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropForeign(['gst_id']);
            $table->dropColumn(['gst_id', 'item_rate', 'item_gst']);
        });
    }
};
