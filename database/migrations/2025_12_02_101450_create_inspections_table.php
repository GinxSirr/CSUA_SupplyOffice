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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('iar_number')->unique();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('supplier_name');
            $table->integer('quantity_received');
            $table->date('date_received');
            $table->string('invoice_number')->nullable();
            $table->string('po_number')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('inspected_by')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['passed', 'failed', 'partial'])->default('passed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
