# Developer Quick Reference Guide
**BAC Office Supply Management System - Updated Structure**

## 🚀 Quick Start

### Creating a Transaction with Multiple Requests

```php
use App\Models\Transaction;
use App\Models\SupplyRequest;
use App\Models\Product;

// 1. Create a transaction
$transaction = Transaction::create([
    'user_id' => auth()->id(),
    'request_date' => now(),
]);

// 2. Add multiple requests to the transaction
$products = [1, 2, 3]; // Product IDs
foreach ($products as $productId) {
    $product = Product::find($productId);
    
    SupplyRequest::create([
        'request_number' => 'SR-' . date('Y') . '-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
        'transaction_id' => $transaction->id,
        'user_id' => auth()->id(),
        'product_id' => $productId,
        'quantity_requested' => 5,
        // Copy product details for audit trail
        'product_code' => $product->product_code,
        'description' => $product->description,
        'unit_of_measurement' => $product->unit,
        // Requester details
        'person_name' => auth()->user()->name,
        'designation' => auth()->user()->position,
        'office_name' => auth()->user()->department,
        'purpose' => 'Office supplies needed',
        'status' => 'pending',
        'remarks' => '',
        'user_read' => false,
    ]);
}

// 3. Check transaction status
$status = $transaction->status; // 'pending', 'approved', 'rejected', 'partial'
```

---

## 📋 Creating Multi-Item IAR

### Single IAR Document with Multiple Products

```php
use App\Models\Inspection;
use Illuminate\Support\Str;

// 1. Generate unique group ID
$iarGroupId = 'IARG-' . Str::random(13);
$iarNumber = 'IAR-' . date('Y-m') . '-001';

// 2. Create multiple inspection records with same IAR number
$products = Product::whereIn('id', [1, 2, 3])->get();

foreach ($products as $index => $product) {
    Inspection::create([
        'iar_number' => $iarNumber, // Same for all items
        'iar_group_id' => $iarGroupId, // Same for all items
        'entity_name' => 'CAGAYAN STATE UNIVERSITY AT APARRI',
        'fund_cluster' => '01',
        'product_id' => $product->id,
        'supplier_name' => 'ABC Supplies Inc.',
        'quantity_received' => 20,
        'date_received' => now(),
        'date_inspected' => now(),
        'date_accepted' => now(),
        'invoice_number' => 'INV-12345',
        'po_number' => 'PO-2025-001',
        'po_no_date' => 'PO-2025-001 dated December 3, 2025',
        'office_dept' => 'BAC Office',
        'responsibility_code' => 'RC-001',
        // Product details copy
        'product_description' => $product->description,
        'unit' => $product->unit,
        'quantity' => 20,
        'stock_no' => str_pad($index + 1, 3, '0', STR_PAD_LEFT),
        // Inspector info
        'inspected_by' => auth()->id(),
        'inspection_officer' => auth()->user()->name . ' / Supply Officer',
        'status' => 'passed',
        'remarks' => 'All items in good condition',
    ]);
}

// 3. Retrieve all items in the IAR
$iarItems = Inspection::where('iar_group_id', $iarGroupId)->get();
// OR using the model method:
$firstItem = Inspection::where('iar_group_id', $iarGroupId)->first();
$allItems = $firstItem->groupItems(); // Returns collection of all items
```

---

## 📦 Creating Multi-Item PAR

### Single PAR Document with Multiple Properties

```php
use App\Models\PropertyAcknowledgment;
use Illuminate\Support\Str;

// 1. Generate unique group ID
$parGroupId = 'PARG-' . Str::random(13);
$parNumber = 'PAR-' . date('Y-m') . '-001';

// 2. Create multiple PAR records with same PAR number
$products = Product::whereIn('id', [1, 2, 3])->get();

foreach ($products as $index => $product) {
    PropertyAcknowledgment::create([
        'par_number' => $parNumber, // Same for all items
        'par_group_id' => $parGroupId, // Same for all items
        'entity_name' => 'CAGAYAN STATE UNIVERSITY AT APARRI',
        'fund_cluster' => '01',
        'product_id' => $product->id,
        // Receiver details
        'assigned_to' => $userId,
        'received_by' => $user->name,
        'received_position' => $user->position,
        'received_date' => now(),
        // Property details
        'quantity' => 2,
        'unit' => $product->unit,
        'description' => $product->description,
        'property_number' => 'CSU-APARRI-' . date('Y') . '-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
        'date_acquired' => now()->subDays(30),
        'amount' => $product->unit_price,
        // Issuer details
        'date_issued' => now(),
        'issued_by' => auth()->id(),
        'issued_by_name' => auth()->user()->name,
        'issued_position' => 'Supply Officer',
        'issued_date_actual' => now(),
        'condition' => 'Brand New',
        'status' => 'active',
        'remarks' => 'Property issued in good condition',
    ]);
}

// 3. Retrieve all items in the PAR
$parItems = PropertyAcknowledgment::where('par_group_id', $parGroupId)->get();
// OR:
$firstItem = PropertyAcknowledgment::where('par_group_id', $parGroupId)->first();
$allItems = $firstItem->groupItems();

// 4. Calculate total PAR value
$totalValue = $parItems->sum(function($item) {
    return $item->total_value; // Uses getTotalValueAttribute()
});
```

---

## 🔄 Creating Property Transfer with Full Audit Trail

```php
use App\Models\PropertyTransfer;
use App\Models\PropertyAcknowledgment;

$par = PropertyAcknowledgment::find($parId);

PropertyTransfer::create([
    'ptr_number' => 'PTR-' . date('Y-m') . '-001',
    'par_id' => $par->id,
    
    // Copy all property details for audit trail
    'entity_name' => $par->entity_name,
    'fund_cluster' => $par->fund_cluster,
    'par_no' => $par->par_number,
    'quantity' => $par->quantity,
    'unit' => $par->unit,
    'description' => $par->description,
    'property_number' => $par->property_number,
    'date_acquired' => $par->date_acquired,
    'amount' => $par->amount,
    'par_group_id' => $par->par_group_id,
    
    // User references (for relationships)
    'from_user' => $par->assigned_to,
    'to_user' => $newUserId,
    'approved_by' => auth()->id(),
    
    // Stage 1: Approval
    'approved_by_name' => auth()->user()->name,
    'approved_position' => 'Campus Administrator',
    'approved_date' => now(),
    
    // Stage 2: Issuance
    'issued_by_name' => 'Supply Officer Name',
    'issued_position' => 'Supply Officer',
    'issued_date' => now(),
    
    // Stage 3: Receipt
    'received_by_name' => $newUser->name,
    'received_position' => $newUser->position,
    'received_date' => now(),
    
    'transfer_date' => now(),
    'transfer_reason' => 'Reassignment due to office relocation',
    'status' => 'completed',
]);

// Update original PAR status
$par->update(['status' => 'transferred']);
```

---

## 🔔 Supply Request Approval with Notifications

```php
use App\Models\SupplyRequest;

$request = SupplyRequest::find($requestId);

// Approve request
$request->update([
    'status' => 'approved',
    'approved_by' => auth()->id(),
    'approved_at' => now(),
    'remarks' => 'Available',
    'admin_message' => 'Your request has been approved. Please pick up from the supply office.',
    'admin_remarks' => 'Stock available, ready for release.',
    'user_read' => false, // User hasn't seen this yet
]);

// Reject request
$request->update([
    'status' => 'rejected',
    'approved_by' => auth()->id(),
    'approved_at' => now(),
    'remarks' => 'Not Available',
    'admin_message' => 'Sorry, this item is currently out of stock.',
    'rejection_reason' => 'Insufficient stock. Expected delivery: January 2026',
    'admin_remarks' => 'Stock depleted, reorder pending.',
    'user_read' => false,
]);

// User marks as read
$request->update(['user_read' => true]);

// Get all unread requests for user
$unreadRequests = auth()->user()
    ->supplyRequests()
    ->where('user_read', false)
    ->whereIn('status', ['approved', 'rejected'])
    ->get();
```

---

## 📊 Useful Queries

### Get All Requests in a Transaction
```php
$transaction = Transaction::with('supplyRequests.product')->find($id);
$requests = $transaction->supplyRequests;
```

### Get All Items in an IAR Document
```php
// By IAR number
$iarItems = Inspection::where('iar_number', 'IAR-2025-12-001')
    ->with('product')
    ->get();

// By IAR group ID
$iarItems = Inspection::where('iar_group_id', $iarGroupId)
    ->with('product')
    ->orderBy('stock_no')
    ->get();

// Using scope
$iarItems = Inspection::inGroup($iarGroupId)->get();
```

### Get All Items in a PAR Document
```php
// By PAR number
$parItems = PropertyAcknowledgment::where('par_number', 'PAR-2025-12-001')
    ->with('product', 'assignedTo')
    ->get();

// By PAR group ID
$parItems = PropertyAcknowledgment::where('par_group_id', $parGroupId)
    ->with('product', 'assignedTo')
    ->get();

// Using scope
$parItems = PropertyAcknowledgment::inGroup($parGroupId)->get();
```

### Get User's Unread Notifications
```php
$unreadCount = auth()->user()
    ->supplyRequests()
    ->where('user_read', false)
    ->whereIn('status', ['approved', 'rejected'])
    ->count();
```

### Get Transaction Status Summary
```php
$transaction = Transaction::find($id);

// Automatic status calculation
echo $transaction->status; // 'pending', 'approved', 'rejected', 'partial'

// Manual check
$isCompleted = $transaction->isCompleted(); // Boolean
```

### Get Property Transfer History
```php
$par = PropertyAcknowledgment::find($id);
$transfers = $par->transfers()
    ->with(['fromUser', 'toUser'])
    ->orderBy('transfer_date', 'desc')
    ->get();
```

---

## 🎨 Blade Template Examples

### Display Transaction with Requests
```blade
<div class="win-groupbox">
    <legend>Transaction #{{ $transaction->id }}</legend>
    <p><strong>Requested by:</strong> {{ $transaction->user->name }}</p>
    <p><strong>Date:</strong> {{ $transaction->request_date->format('F d, Y') }}</p>
    <p><strong>Status:</strong> <span class="badge-{{ $transaction->status }}">{{ ucfirst($transaction->status) }}</span></p>
    
    <table class="win-table">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->supplyRequests as $request)
            <tr>
                <td>{{ $request->product_code }}</td>
                <td>{{ $request->description }}</td>
                <td>{{ $request->quantity_requested }} {{ $request->unit_of_measurement }}</td>
                <td>
                    <span class="badge-{{ $request->status }}">
                        {{ ucfirst($request->status) }}
                    </span>
                </td>
                <td>{{ $request->remarks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
```

### Display IAR with Multiple Items
```blade
<div class="win-window">
    <div class="win-titlebar">
        <span>Inspection and Acceptance Report (IAR)</span>
    </div>
    <div class="win-content">
        <h3>{{ $firstItem->iar_number }}</h3>
        <p><strong>Entity:</strong> {{ $firstItem->entity_name }}</p>
        <p><strong>Supplier:</strong> {{ $firstItem->supplier_name }}</p>
        <p><strong>Date Inspected:</strong> {{ $firstItem->date_inspected->format('F d, Y') }}</p>
        
        <table class="win-table">
            <thead>
                <tr>
                    <th>Stock No.</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($firstItem->groupItems() as $item)
                <tr>
                    <td>{{ $item->stock_no }}</td>
                    <td>{{ $item->product_description }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            <p><strong>Inspected by:</strong> {{ $firstItem->inspector_name }}</p>
            <p><strong>Remarks:</strong> {{ $firstItem->remarks }}</p>
        </div>
    </div>
</div>
```

### Display PAR with Multiple Items
```blade
<div class="win-window">
    <div class="win-titlebar">
        <span>Property Acknowledgment Receipt (PAR)</span>
    </div>
    <div class="win-content">
        <h3>{{ $firstItem->par_number }}</h3>
        <p><strong>Entity:</strong> {{ $firstItem->entity_name }}</p>
        <p><strong>Received by:</strong> {{ $firstItem->received_by }} ({{ $firstItem->received_position }})</p>
        <p><strong>Issued by:</strong> {{ $firstItem->issued_by_name }} ({{ $firstItem->issued_position }})</p>
        
        <table class="win-table">
            <thead>
                <tr>
                    <th>Property No.</th>
                    <th>Description</th>
                    <th>Qty</th>
                    <th>Unit</th>
                    <th>Amount</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($firstItem->groupItems() as $item)
                <tr>
                    <td>{{ $item->property_number }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>₱{{ number_format($item->amount, 2) }}</td>
                    <td>₱{{ number_format($item->total_value, 2) }}</td>
                </tr>
                @php $grandTotal += $item->total_value; @endphp
                @endforeach
                <tr class="font-bold">
                    <td colspan="5" class="text-right">GRAND TOTAL:</td>
                    <td>₱{{ number_format($grandTotal, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
```

---

## 🛠️ Helper Functions

### Generate Unique Group IDs
```php
// In a helper file or controller

public function generateIARGroupId()
{
    return 'IARG-' . Str::random(13);
}

public function generatePARGroupId()
{
    return 'PARG-' . Str::random(13);
}

public function generatePropertyNumber($year = null)
{
    $year = $year ?? date('Y');
    $lastPar = PropertyAcknowledgment::whereYear('created_at', $year)
        ->whereNotNull('property_number')
        ->orderBy('id', 'desc')
        ->first();
    
    $lastNumber = $lastPar 
        ? intval(substr($lastPar->property_number, -4)) 
        : 0;
    
    $nextNumber = $lastNumber + 1;
    
    return 'CSU-APARRI-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
}
```

---

## 📖 Model Relationships Quick Reference

```php
// Transaction
$transaction->user            // User who created transaction
$transaction->supplyRequests  // All requests in transaction

// SupplyRequest
$request->transaction  // Parent transaction
$request->user        // Requester
$request->product     // Requested product
$request->approvedBy  // Admin who approved

// Inspection
$inspection->product       // Inspected product
$inspection->inspector     // Inspector (user)
$inspection->groupItems()  // All items in same IAR

// PropertyAcknowledgment
$par->product        // Property/product
$par->assignedTo     // User assigned to
$par->issuedBy       // User who issued
$par->transfers      // Transfer history
$par->groupItems()   // All items in same PAR

// PropertyTransfer
$transfer->propertyAcknowledgment  // Original PAR
$transfer->fromUser                // Previous owner
$transfer->toUser                  // New owner
$transfer->approvedBy              // Approver

// User
$user->transactions              // All transactions
$user->supplyRequests           // All supply requests
$user->approvedRequests         // Requests approved by user
$user->inspections              // Inspections done by user
$user->propertyAcknowledgments  // Properties assigned to user
$user->issuedProperties         // Properties issued by user
```

---

## 🎯 Common Tasks Checklist

### Creating a Supply Request
- [ ] Create Transaction record
- [ ] Create SupplyRequest records with transaction_id
- [ ] Copy product details (code, description, unit)
- [ ] Fill requester details (name, designation, office)
- [ ] Set user_read to false
- [ ] Set status to 'pending'

### Processing Supply Request
- [ ] Check product availability
- [ ] Update status (approved/rejected)
- [ ] Set approved_by and approved_at
- [ ] Fill admin_message for user
- [ ] Fill rejection_reason if rejected
- [ ] Set remarks (Available/Not Available)
- [ ] Update product quantity if approved
- [ ] Set user_read to false (user needs to see this)

### Creating IAR Document
- [ ] Generate unique iar_group_id
- [ ] Use same iar_number for all items
- [ ] Create Inspection record for each product
- [ ] Fill government form fields (entity_name, fund_cluster)
- [ ] Copy product details to each record
- [ ] Assign sequential stock_no
- [ ] Fill inspector information
- [ ] Update product quantities if passed

### Creating PAR Document
- [ ] Generate unique par_group_id
- [ ] Use same par_number for all items
- [ ] Create PropertyAcknowledgment for each property
- [ ] Generate unique property_number for each
- [ ] Fill government form fields
- [ ] Copy product details
- [ ] Fill receiver and issuer information with names and positions
- [ ] Set date_acquired and amount
- [ ] Update product quantities

### Creating Property Transfer
- [ ] Get original PAR details
- [ ] Copy ALL property fields to transfer record
- [ ] Fill three-stage approval (approved, issued, received)
- [ ] Each stage needs: name, position, date
- [ ] Set transfer_reason
- [ ] Update original PAR status to 'transferred'

---

**Last Updated:** December 3, 2025  
**Version:** 2.0  
**Author:** GitHub Copilot
