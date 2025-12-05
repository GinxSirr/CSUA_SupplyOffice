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
        Schema::table('inspections', function (Blueprint $table) {
            // Add government form compliance fields
            $table->string('entity_name')->default('CAGAYAN STATE UNIVERSITY AT APARRI')->after('id');
            $table->string('fund_cluster')->nullable()->after('entity_name');
            $table->string('office_dept')->nullable()->after('po_number');
            $table->string('responsibility_code')->nullable()->after('office_dept');

            // Change inspector from user_id to name (for external inspectors)
            $table->string('inspection_officer')->nullable()->after('inspected_by');

            // Add detailed dates
            $table->date('date_inspected')->after('date_received');
            $table->date('date_accepted')->nullable()->after('date_inspected');

            // Add product details (for grouping)
            $table->string('product_date')->nullable()->after('product_id');
            $table->string('stock_no')->nullable()->after('product_date');
            $table->text('product_description')->nullable()->after('stock_no');
            $table->string('unit')->nullable()->after('product_description');
            $table->integer('quantity')->nullable()->after('unit');

            // Add grouping support for multiple items per IAR
            $table->string('iar_group_id')->nullable()->after('iar_number');
            $table->index('iar_group_id');

            // Rename for consistency
            $table->string('po_no_date')->nullable()->after('po_number');
        });

        // Make iar_number non-unique to allow multiple items per IAR
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropUnique(['iar_number']);
            $table->index('iar_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspections', function (Blueprint $table) {
            $table->dropIndex(['iar_number']);
            $table->unique('iar_number');

            $table->dropIndex(['iar_group_id']);
            $table->dropColumn([
                'entity_name',
                'fund_cluster',
                'office_dept',
                'responsibility_code',
                'inspection_officer',
                'date_inspected',
                'date_accepted',
                'product_date',
                'stock_no',
                'product_description',
                'unit',
                'quantity',
                'iar_group_id',
                'po_no_date'
            ]);
        });
    }
};
