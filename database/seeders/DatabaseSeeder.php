<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create supply officer user
        \App\Models\User::create([
            'name' => 'Supply Officer',
            'username' => 'supplyofficer',
            'email' => 'supplyofficer@csu.edu.ph',
            'password' => bcrypt('supply123'),
            'user_type' => 'supply_officer',
            'department' => 'Supply Office',
            'position' => 'Supply Officer',
            'is_active' => true,
        ]);

        // Create regular employee user
        \App\Models\User::create([
            'name' => 'CSUA Employee',
            'username' => 'employee',
            'email' => 'employee@csu.edu.ph',
            'password' => bcrypt('employee123'),
            'user_type' => 'employee',
            'department' => 'General Services',
            'position' => 'Staff',
            'is_active' => true,
        ]);

        // Create sample products
        $products = [
            ['product_code' => 'SUP001', 'product_name' => 'Bond Paper A4', 'unit' => 'ream', 'quantity' => 100, 'reorder_level' => 20, 'unit_price' => 150.00, 'category' => 'Paper'],
            ['product_code' => 'SUP002', 'product_name' => 'Ballpen (Black)', 'unit' => 'box', 'quantity' => 50, 'reorder_level' => 10, 'unit_price' => 100.00, 'category' => 'Writing Instruments'],
            ['product_code' => 'SUP003', 'product_name' => 'Ballpen (Blue)', 'unit' => 'box', 'quantity' => 50, 'reorder_level' => 10, 'unit_price' => 100.00, 'category' => 'Writing Instruments'],
            ['product_code' => 'SUP004', 'product_name' => 'Folders (Long)', 'unit' => 'piece', 'quantity' => 200, 'reorder_level' => 50, 'unit_price' => 5.00, 'category' => 'Filing'],
            ['product_code' => 'SUP005', 'product_name' => 'Stapler', 'unit' => 'piece', 'quantity' => 30, 'reorder_level' => 5, 'unit_price' => 85.00, 'category' => 'Office Equipment'],
            ['product_code' => 'SUP006', 'product_name' => 'Staple Wire', 'unit' => 'box', 'quantity' => 40, 'reorder_level' => 10, 'unit_price' => 25.00, 'category' => 'Office Equipment'],
            ['product_code' => 'SUP007', 'product_name' => 'Tape (Clear)', 'unit' => 'roll', 'quantity' => 60, 'reorder_level' => 15, 'unit_price' => 30.00, 'category' => 'Adhesives'],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        // Create sample folder
        \App\Models\Folder::create([
            'name' => 'General Documents',
            'description' => 'Common office documents and forms',
            'created_by' => 1,
            'is_public' => true,
        ]);
    }
}
