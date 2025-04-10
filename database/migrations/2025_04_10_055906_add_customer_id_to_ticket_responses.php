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
        Schema::table('ticket_responses', function (Blueprint $table) {
            // Ensure the customer_id column is nullable first
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_responses', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['customer_id']);
            // Drop the column if you want to completely remove it
            $table->dropColumn('customer_id');
        });
    }
};
