<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {

        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id(); // Create the primary key 'id'

            $table->string('title');
            $table->text('description');
            $table->enum('status', ['open', 'in-progress', 'resolved', 'closed'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            // Add a foreign key column for customer_id
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');

            // Add a foreign key column for agent_id
            $table->foreignId('agent_id')->nullable()->constrained('agents')->onDelete('set null');

            // Foreign key for department_id referencing 'departments' table
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
