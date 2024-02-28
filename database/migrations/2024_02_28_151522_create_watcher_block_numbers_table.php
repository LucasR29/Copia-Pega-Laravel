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
        Schema::create('watcher_block_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('watcher_name');
            $table->foreignId('collection_id')->constrained();
            $table->string('address');
            $table->string('block_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('watcher_block_numbers');
    }
};
