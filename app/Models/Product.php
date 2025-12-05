<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'product_name',
        'description',
        'unit',
        'quantity',
        'reorder_level',
        'unit_price',
        'category',
        'is_active',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'reorder_level' => 'integer',
        'unit_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function supplyRequests()
    {
        return $this->hasMany(SupplyRequest::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function propertyAcknowledgments()
    {
        return $this->hasMany(PropertyAcknowledgment::class);
    }

    // Helper methods
    public function isLowStock()
    {
        return $this->quantity <= $this->reorder_level;
    }

    public function decreaseQuantity($amount)
    {
        $this->quantity -= $amount;
        $this->save();
    }

    public function increaseQuantity($amount)
    {
        $this->quantity += $amount;
        $this->save();
    }
}
