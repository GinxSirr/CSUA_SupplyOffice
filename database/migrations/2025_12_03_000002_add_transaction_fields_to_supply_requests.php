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
        Schema::table('supply_requests', function (Blueprint $table) {
            // Add transaction support
            $table->foreignId('transaction_id')->nullable()->after('id')->constrained()->onDelete('cascade');

            // Add detailed requester information
            $table->string('person_name')->after('user_id');
            $table->string('designation')->nullable()->after('person_name');
            $table->string('office_name')->after('designation');

            // Add product details copy (for audit trail)
            $table->string('product_code')->after('product_id');
            $table->text('description')->after('product_code');
            $table->string('unit_of_measurement')->after('description');

            // Add detailed status tracking
            $table->string('remarks')->default('')->after('status');
            $table->text('admin_message')->nullable()->after('admin_remarks');
            $table->text('rejection_reason')->nullable()->after('admin_message');
            $table->boolean('user_read')->default(false)->after('rejection_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supply_requests', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropColumn([
                'transaction_id',
                'person_name',
                'designation',
                'office_name',
                'product_code',
                'description',
                'unit_of_measurement',
                'remarks',
                'admin_message',
                'rejection_reason',
                'user_read'
            ]);
        });
    }
};
