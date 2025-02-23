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
        Schema::create('tickets', function (Blueprint $table) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->enum('status', ['open', 'in-progress', 'resolved', 'closed'])->default('open');
                $table->enum('priority', ['low', 'medium', 'high'])->default('medium');  
                $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); 
                $table->foreignId('agent_id')->nullable()->constrained('agents')->onDelete('set null');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
