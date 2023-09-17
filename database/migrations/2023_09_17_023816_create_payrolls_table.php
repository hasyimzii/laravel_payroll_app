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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('basic_salary', 10);
            $table->integer('allowance', 10);
            $table->integer('incentive', 10);
            $table->integer('overtime', 10);
            $table->integer('nwnp', 10);
            $table->integer('insurance', 10);
            $table->enum('status', ['draft', 'approved', 'rejected']);
            $table->date('payroll_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
