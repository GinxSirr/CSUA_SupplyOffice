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
        Schema::create('property_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('ptr_number')->unique();
            $table->foreignId('par_id')->constrained('property_acknowledgments')->onDelete('cascade');
            $table->foreignId('from_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('to_user')->constrained('users')->onDelete('cascade');
            $table->date('transfer_date');
            $table->text('reason')->nullable();
            $table->foreignId('approved_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_transfers');
    }
};
