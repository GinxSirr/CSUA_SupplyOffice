<?php

namespace App\Http\Controllers;

use App\Models\SupplyRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplyRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Admins see all requests, users only see their own
        if ($user->isAdmin()) {
            $requests = SupplyRequest::with(['user', 'product', 'approvedBy'])
                ->latest()
                ->paginate(20);
        } else {
            $requests = SupplyRequest::with(['product', 'approvedBy'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(20);
        }

        return view('supply-requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('is_active', true)
            ->where('quantity', '>', 0)
            ->orderBy('product_name')
            ->get();

        return view('supply-requests.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_requested' => 'required|integer|min:1',
            'purpose' => 'nullable|string|max:500',
            'date_needed' => 'nullable|date|after_or_equal:today',
        ]);

        // Generate request number
        $latestRequest = SupplyRequest::latest('id')->first();
        $nextNumber = $latestRequest ? ($latestRequest->id + 1) : 1;
        $requestNumber = 'SR-' . date('Y') . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        $validated['user_id'] = Auth::id();
        $validated['request_number'] = $requestNumber;
        $validated['status'] = 'pending';

        SupplyRequest::create($validated);

        return redirect()->route('supply-requests.index')
            ->with('success', 'Supply request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplyRequest $supplyRequest)
    {
        $user = Auth::user();

        // Users can only view their own requests, admins can view all
        if (!$user->isAdmin() && $supplyRequest->user_id !== $user->id) {
            abort(403, 'Unauthorized access to this request.');
        }

        $supplyRequest->load(['user', 'product', 'approvedBy']);

        return view('supply-requests.show', compact('supplyRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplyRequest $supplyRequest)
    {
        $user = Auth::user();

        // Users can only edit their own pending requests
        if (!$user->isAdmin() && ($supplyRequest->user_id !== $user->id || $supplyRequest->status !== 'pending')) {
            abort(403, 'Cannot edit this request.');
        }

        $products = Product::where('is_active', true)
            ->where('quantity', '>', 0)
            ->orderBy('product_name')
            ->get();

        return view('supply-requests.edit', compact('supplyRequest', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplyRequest $supplyRequest)
    {
        $user = Auth::user();

        // Users can only update their own pending requests
        if (!$user->isAdmin() && ($supplyRequest->user_id !== $user->id || $supplyRequest->status !== 'pending')) {
            abort(403, 'Cannot update this request.');
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_requested' => 'required|integer|min:1',
            'purpose' => 'nullable|string|max:500',
            'date_needed' => 'nullable|date|after_or_equal:today',
        ]);

        $supplyRequest->update($validated);

        return redirect()->route('supply-requests.index')
            ->with('success', 'Supply request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplyRequest $supplyRequest)
    {
        $user = Auth::user();

        // Users can only delete their own pending requests
        if (!$user->isAdmin() && ($supplyRequest->user_id !== $user->id || $supplyRequest->status !== 'pending')) {
            abort(403, 'Cannot delete this request.');
        }

        $supplyRequest->delete();

        return redirect()->route('supply-requests.index')
            ->with('success', 'Supply request deleted successfully!');
    }

    /**
     * Approve a supply request (Admin only)
     */
    public function approve(Request $request, SupplyRequest $supplyRequest)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can approve requests.');
        }

        $validated = $request->validate([
            'admin_remarks' => 'nullable|string|max:500',
        ]);

        $supplyRequest->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'admin_remarks' => $validated['admin_remarks'] ?? null,
        ]);

        // Decrease product quantity
        $supplyRequest->product->decreaseQuantity($supplyRequest->quantity_requested);

        return redirect()->back()
            ->with('success', 'Request approved successfully!');
    }

    /**
     * Reject a supply request (Admin only)
     */
    public function reject(Request $request, SupplyRequest $supplyRequest)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can reject requests.');
        }

        $validated = $request->validate([
            'admin_remarks' => 'required|string|max:500',
        ]);

        $supplyRequest->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'admin_remarks' => $validated['admin_remarks'],
        ]);

        return redirect()->back()
            ->with('success', 'Request rejected.');
    }
}
