<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'iar_number',
        'iar_group_id',
        'entity_name',
        'fund_cluster',
        'product_id',
        'supplier_name',
        'quantity_received',
        'date_received',
        'date_inspected',
        'date_accepted',
        'invoice_number',
        'po_number',
        'po_no_date',
        'office_dept',
        'responsibility_code',
        'product_date',
        'stock_no',
        'product_description',
        'unit',
        'quantity',
        'remarks',
        'inspected_by',
        'inspection_officer',
        'status',
    ];

    protected $casts = [
        'quantity_received' => 'integer',
        'quantity' => 'integer',
        'date_received' => 'date',
        'date_inspected' => 'date',
        'date_accepted' => 'date',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function inspector()
    {
        return $this->belongsTo(User::class, 'inspected_by');
    }

    // Helper methods
    public function getInspectorNameAttribute()
    {
        return $this->inspection_officer ?: ($this->inspector ? $this->inspector->name : null);
    }

    /**
     * Scope to get all inspections in the same IAR group
     */
    public function scopeInGroup($query, $groupId)
    {
        return $query->where('iar_group_id', $groupId);
    }

    /**
     * Get all items in the same IAR document
     */
    public function groupItems()
    {
        if (!$this->iar_group_id) {
            return collect([$this]);
        }
        return static::where('iar_group_id', $this->iar_group_id)->get();
    }
}
