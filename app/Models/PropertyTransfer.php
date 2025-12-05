<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'ptr_number',
        'par_id',
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
        'from_user',
        'to_user',
        'transfer_date',
        'transfer_reason',
        'approved_by',
        'approved_by_name',
        'approved_position',
        'approved_date',
        'issued_by_name',
        'issued_position',
        'issued_date',
        'received_by_name',
        'received_position',
        'received_date',
        'status',
    ];

    protected $casts = [
        'transfer_date' => 'date',
        'approved_date' => 'date',
        'issued_date' => 'date',
        'received_date' => 'date',
        'date_acquired' => 'date',
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function propertyAcknowledgment()
    {
        return $this->belongsTo(PropertyAcknowledgment::class, 'par_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
