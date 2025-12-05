<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\SupplyRequest;
use App\Models\Inspection;
use App\Models\PropertyAcknowledgment;
use Illuminate\Support\Str;

class UpdatedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users
        $supplyOfficer = User::where('email', 'supply.officer@csuaparr.edu.ph')->first();
        $employee = User::where('email', 'employee@csuaparr.edu.ph')->first();

        // Fallback to old email patterns if new ones don't exist yet
        if (!$supplyOfficer) {
            $supplyOfficer = User::where('email', 'admin@bac-office.local')->first();
        }
        if (!$employee) {
            $employee = User::where('email', 'staff@bac-office.local')->first();
        }

        // Update user details if they exist
        if ($employee) {
            $employee->update([
                'department' => 'BAC Office',
                'position' => 'BAC Secretary',
            ]);
        }

        // Get some products
        $products = Product::take(5)->get();

        if ($products->isEmpty()) {
            $this->command->warn('No products found. Please run ProductSeeder first.');
            return;
        }

        // Create a sample transaction with multiple requests
        $transaction = Transaction::create([
            'user_id' => $employee->id,
            'request_date' => now(),
        ]);

        // Create supply requests as part of the transaction
        foreach ($products->take(3) as $index => $product) {
            SupplyRequest::create([
                'request_number' => 'SR-' . date('Y') . '-' . str_pad($transaction->id * 10 + $index, 4, '0', STR_PAD_LEFT),
                'transaction_id' => $transaction->id,
                'user_id' => $employee->id,
                'product_id' => $product->id,
                'quantity_requested' => rand(1, 5),
                'person_name' => $employee->name,
                'designation' => $employee->position,
                'office_name' => $employee->department,
                'product_code' => $product->product_code,
                'description' => $product->description ?? $product->product_name,
                'unit_of_measurement' => $product->unit,
                'purpose' => 'For office use - ' . ['daily operations', 'special project', 'urgent need'][rand(0, 2)],
                'status' => 'pending',
                'remarks' => '',
                'user_read' => false,
            ]);
        }

        // Create sample IAR with grouped items
        $iarGroupId = 'IARG-' . Str::random(13);
        $iarNumber = 'IAR-' . date('Y-m') . '-001';

        foreach ($products->take(2) as $index => $product) {
            Inspection::create([
                'iar_number' => $iarNumber,
                'iar_group_id' => $iarGroupId,
                'entity_name' => 'CAGAYAN STATE UNIVERSITY AT APARRI',
                'fund_cluster' => '01',
                'product_id' => $product->id,
                'supplier_name' => 'ABC Supplies Inc.',
                'quantity_received' => rand(10, 50),
                'date_received' => now(),
                'date_inspected' => now(),
                'date_accepted' => now(),
                'invoice_number' => 'INV-' . rand(1000, 9999),
                'po_number' => 'PO-' . rand(1000, 9999),
                'po_no_date' => 'PO-2025-001 dated ' . now()->format('F d, Y'),
                'office_dept' => 'BAC Office',
                'responsibility_code' => 'RC-001',
                'product_description' => $product->description ?? $product->product_name,
                'unit' => $product->unit,
                'quantity' => rand(10, 50),
                'stock_no' => str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'inspected_by' => $supplyOfficer->id,
                'inspection_officer' => $supplyOfficer->name . ' / ' . ($supplyOfficer->position ?? 'Supply Officer'),
                'status' => 'passed',
                'remarks' => 'All items inspected and in good condition',
            ]);
        }

        // Create sample PAR with grouped items
        $parGroupId = 'PARG-' . Str::random(13);
        $parNumber = 'PAR-' . date('Y-m') . '-001';

        foreach ($products->take(2) as $index => $product) {
            PropertyAcknowledgment::create([
                'par_number' => $parNumber,
                'par_group_id' => $parGroupId,
                'entity_name' => 'CAGAYAN STATE UNIVERSITY AT APARRI',
                'fund_cluster' => '01',
                'product_id' => $product->id,
                'assigned_to' => $employee->id,
                'received_by' => $employee->name,
                'received_position' => $employee->position ?? 'Staff',
                'received_date' => now(),
                'quantity' => rand(1, 5),
                'unit' => $product->unit,
                'description' => $product->description ?? $product->product_name,
                'property_number' => 'CSU-APARRI-' . date('Y') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'date_acquired' => now()->subDays(rand(30, 365)),
                'amount' => $product->unit_price,
                'date_issued' => now(),
                'issued_by' => $supplyOfficer->id,
                'issued_by_name' => $supplyOfficer->name,
                'issued_position' => $supplyOfficer->position ?? 'Supply Officer',
                'issued_date_actual' => now(),
                'condition' => 'Brand New',
                'status' => 'active',
                'remarks' => 'Property issued in good condition',
            ]);
        }

        $this->command->info('Sample data with government form compliance created successfully!');
        $this->command->info('- Transaction ID: ' . $transaction->id . ' with ' . $transaction->supplyRequests->count() . ' requests');
        $this->command->info('- IAR Group: ' . $iarGroupId . ' (' . Inspection::where('iar_group_id', $iarGroupId)->count() . ' items)');
        $this->command->info('- PAR Group: ' . $parGroupId . ' (' . PropertyAcknowledgment::where('par_group_id', $parGroupId)->count() . ' items)');
    }
}
