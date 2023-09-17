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
        Schema::create('commons', function (Blueprint $table) {
            $table->integer('incentive', 7);
            $table->integer('overtime', 5);
            $table->integer('nwnp', 5);
            $table->float('insurance', 2, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commons');
    }
};
