<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupplyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_number',
        'transaction_id',
        'user_id',
        'product_id',
        'quantity_requested',
        'person_name',
        'designation',
        'office_name',
        'product_code',
        'description',
        'unit_of_measurement',
        'purpose',
        'status',
        'approved_by',
        'approved_at',
        'admin_remarks',
        'remarks',
        'admin_message',
        'rejection_reason',
        'user_read',
        'date_needed',
    ];

    protected $casts = [
        'quantity_requested' => 'integer',
        'approved_at' => 'datetime',
        'date_needed' => 'date',
        'user_read' => 'boolean',
    ];

    // Relationships
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}
