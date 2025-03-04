<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            // Add the department_id column to the agents table
            $table->unsignedBigInteger('department_id')->nullable();

            // Create the foreign key constraint
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            // Drop the foreign key and column if rolling back
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
}
