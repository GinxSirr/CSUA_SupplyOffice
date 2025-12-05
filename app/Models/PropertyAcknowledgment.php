<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyAcknowledgment extends Model
{
    use HasFactory;

    protected $fillable = [
        'par_number',
        'par_group_id',
        'entity_name',
        'fund_cluster',
        'product_id',
        'assigned_to',
        'received_by',
        'received_position',
        'received_date',
        'quantity',
        'unit',
        'description',
        'property_number',
        'date_acquired',
        'amount',
        'date_issued',
        'issued_by',
        'issued_by_name',
        'issued_position',
        'issued_date_actual',
        'condition',
        'remarks',
        'status',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'date_issued' => 'date',
        'received_date' => 'date',
        'issued_date_actual' => 'date',
        'date_acquired' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function transfers()
    {
        return $this->hasMany(PropertyTransfer::class, 'par_id');
    }

    // Helper methods
    /**
     * Scope to get all PARs in the same group
     */
    public function scopeInGroup($query, $groupId)
    {
        return $query->where('par_group_id', $groupId);
    }

    /**
     * Get all items in the same PAR document
     */
    public function groupItems()
    {
        if (!$this->par_group_id) {
            return collect([$this]);
        }
        return static::where('par_group_id', $this->par_group_id)->get();
    }

    /**
     * Get total value of PAR
     */
    public function getTotalValueAttribute()
    {
        return $this->quantity * $this->amount;
    }
}
