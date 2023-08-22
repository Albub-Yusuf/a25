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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->unsignedBigInteger('leave_type');
            $table->unsignedBigInteger('requested_by');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('expected_leave_days');
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->tinyInteger('is_notified')->default(1);
            $table->foreign('leave_type')->references('id')->on('categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('requested_by')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
