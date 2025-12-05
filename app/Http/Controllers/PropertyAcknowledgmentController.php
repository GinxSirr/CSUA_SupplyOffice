<?php

namespace App\Http\Controllers;

use App\Models\PropertyAcknowledgment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyAcknowledgmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage property acknowledgments.');
        }

        $acknowledgments = PropertyAcknowledgment::with(['product', 'assignedTo', 'issuedBy'])
            ->latest()
            ->paginate(20);

        return view('property-acknowledgments.index', compact('acknowledgments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage property acknowledgments.');
        }

        $products = Product::where('is_active', true)
            ->where('quantity', '>', 0)
            ->orderBy('product_name')
            ->get();

        $users = User::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('property-acknowledgments.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage property acknowledgments.');
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'assigned_to' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'date_issued' => 'required|date',
            'condition' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        // Generate PAR number
        $latestPAR = PropertyAcknowledgment::latest('id')->first();
        $nextNumber = $latestPAR ? ($latestPAR->id + 1) : 1;
        $parNumber = 'PAR-' . date('Y') . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        $validated['par_number'] = $parNumber;
        $validated['issued_by'] = Auth::id();
        $validated['status'] = 'active';

        $par = PropertyAcknowledgment::create($validated);

        // Decrease product quantity
        $par->product->decreaseQuantity($validated['quantity']);

        return redirect()->route('property-acknowledgments.index')
            ->with('success', 'Property acknowledgment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyAcknowledgment $propertyAcknowledgment)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage property acknowledgments.');
        }

        $propertyAcknowledgment->load(['product', 'assignedTo', 'issuedBy']);

        return view('property-acknowledgments.show', compact('propertyAcknowledgment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyAcknowledgment $propertyAcknowledgment)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage property acknowledgments.');
        }

        $products = Product::where('is_active', true)
            ->orderBy('product_name')
            ->get();

        $users = User::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('property-acknowledgments.edit', compact('propertyAcknowledgment', 'products', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyAcknowledgment $propertyAcknowledgment)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage property acknowledgments.');
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'assigned_to' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'date_issued' => 'required|date',
            'condition' => 'nullable|string',
            'remarks' => 'nullable|string',
            'status' => 'required|in:active,returned,transferred',
        ]);

        $propertyAcknowledgment->update($validated);

        return redirect()->route('property-acknowledgments.index')
            ->with('success', 'Property acknowledgment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyAcknowledgment $propertyAcknowledgment)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage property acknowledgments.');
        }

        $propertyAcknowledgment->delete();

        return redirect()->route('property-acknowledgments.index')
            ->with('success', 'Property acknowledgment deleted successfully!');
    }
}
