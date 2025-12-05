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
        Schema::table('property_acknowledgments', function (Blueprint $table) {
            // Add government form compliance fields
            $table->string('entity_name')->default('CAGAYAN STATE UNIVERSITY AT APARRI')->after('id');
            $table->string('fund_cluster')->nullable()->after('entity_name');

            // Add detailed receiver information (name, position, date)
            $table->string('received_by')->after('assigned_to');
            $table->string('received_position')->nullable()->after('received_by');
            $table->date('received_date')->after('received_position');

            // Add detailed issuer information (name, position, date)
            $table->string('issued_by_name')->after('issued_by');
            $table->string('issued_position')->nullable()->after('issued_by_name');
            $table->date('issued_date_actual')->after('date_issued');

            // Add property details
            $table->string('unit')->after('quantity');
            $table->text('description')->after('unit');
            $table->string('property_number')->nullable()->after('description');
            $table->date('date_acquired')->nullable()->after('property_number');
            $table->decimal('amount', 12, 2)->default(0)->after('date_acquired');

            // Add grouping support for multiple items per PAR
            $table->string('par_group_id')->nullable()->after('par_number');
            $table->index('par_group_id');
        });

        // Make par_number non-unique to allow multiple items per PAR
        Schema::table('property_acknowledgments', function (Blueprint $table) {
            $table->dropUnique(['par_number']);
            $table->index('par_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_acknowledgments', function (Blueprint $table) {
            $table->dropIndex(['par_number']);
            $table->unique('par_number');

            $table->dropIndex(['par_group_id']);
            $table->dropColumn([
                'entity_name',
                'fund_cluster',
                'received_by',
                'received_position',
                'received_date',
                'issued_by_name',
                'issued_position',
                'issued_date_actual',
                'unit',
                'description',
                'property_number',
                'date_acquired',
                'amount',
                'par_group_id'
            ]);
        });
    }
};
