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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('birth_place', 20);
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->string('position', 20);
            $table->enum('status', ['fulltime', 'contract', 'freelance']);
            $table->integer('basic_salary');
            $table->integer('allowance');
            $table->date('start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
