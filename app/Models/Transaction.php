<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_date',
    ];

    protected $casts = [
        'request_date' => 'datetime',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the supply requests for the transaction.
     */
    public function supplyRequests()
    {
        return $this->hasMany(SupplyRequest::class);
    }

    /**
     * Check if all requests in this transaction have been processed.
     */
    public function isCompleted()
    {
        return $this->supplyRequests()
            ->whereNotIn('status', ['approved', 'rejected'])
            ->count() === 0;
    }

    /**
     * Get the transaction status based on its requests.
     */
    public function getStatusAttribute()
    {
        $requests = $this->supplyRequests;

        if ($requests->isEmpty()) {
            return 'empty';
        }

        $allApproved = $requests->every(fn($req) => $req->status === 'approved');
        $allRejected = $requests->every(fn($req) => $req->status === 'rejected');
        $anyPending = $requests->contains(fn($req) => $req->status === 'pending');

        if ($allApproved) return 'approved';
        if ($allRejected) return 'rejected';
        if ($anyPending) return 'pending';

        return 'partial';
    }
}
