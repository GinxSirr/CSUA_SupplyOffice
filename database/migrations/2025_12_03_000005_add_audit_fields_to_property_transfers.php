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
        Schema::table('property_transfers', function (Blueprint $table) {
            // Copy property details for complete audit trail
            $table->string('entity_name')->after('par_id');
            $table->string('fund_cluster')->nullable()->after('entity_name');
            $table->string('par_no')->after('fund_cluster');
            $table->string('quantity')->after('par_no');
            $table->string('unit')->after('quantity');
            $table->text('description')->after('unit');
            $table->string('property_number')->nullable()->after('description');
            $table->date('date_acquired')->nullable()->after('property_number');
            $table->decimal('amount', 12, 2)->default(0)->after('date_acquired');
            $table->string('par_group_id')->nullable()->after('amount');

            // Add three-stage approval process (approved, issued, received)
            $table->string('approved_by_name')->after('approved_by');
            $table->string('approved_position')->nullable()->after('approved_by_name');
            $table->date('approved_date')->nullable()->after('approved_position');

            $table->string('issued_by_name')->after('approved_date');
            $table->string('issued_position')->nullable()->after('issued_by_name');
            $table->date('issued_date')->nullable()->after('issued_position');

            $table->string('received_by_name')->after('to_user');
            $table->string('received_position')->nullable()->after('received_by_name');
            $table->date('received_date')->nullable()->after('received_position');

            // Rename reason to transfer_reason for clarity
            $table->renameColumn('reason', 'transfer_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_transfers', function (Blueprint $table) {
            $table->renameColumn('transfer_reason', 'reason');

            $table->dropColumn([
                'entity_name',
                'fund_cluster',
                'par_no',
                'quantity',
                'unit',
                'description',
                'property_number',
                'date_acquired',
                'amount',
                'par_group_id',
                'approved_by_name',
                'approved_position',
                'approved_date',
                'issued_by_name',
                'issued_position',
                'issued_date',
                'received_by_name',
                'received_position',
                'received_date'
            ]);
        });
    }
};
