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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnUpdate();
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
