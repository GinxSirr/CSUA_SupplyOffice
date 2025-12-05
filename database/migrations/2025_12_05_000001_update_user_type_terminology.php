<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing user_type values
        DB::table('users')
            ->where('user_type', 'admin')
            ->update(['user_type' => 'supply_officer']);

        DB::table('users')
            ->where('user_type', 'user')
            ->update(['user_type' => 'employee']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert user_type values
        DB::table('users')
            ->where('user_type', 'supply_officer')
            ->update(['user_type' => 'admin']);

        DB::table('users')
            ->where('user_type', 'employee')
            ->update(['user_type' => 'user']);
    }
};
