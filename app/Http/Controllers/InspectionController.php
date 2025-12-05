<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage inspections.');
        }

        $inspections = Inspection::with(['product', 'inspector'])
            ->latest()
            ->paginate(20);

        return view('inspections.index', compact('inspections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage inspections.');
        }

        $products = Product::where('is_active', true)
            ->orderBy('product_name')
            ->get();

        return view('inspections.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage inspections.');
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_name' => 'required|string|max:255',
            'quantity_received' => 'required|integer|min:1',
            'date_received' => 'required|date',
            'invoice_number' => 'nullable|string|max:100',
            'po_number' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
            'status' => 'required|in:passed,failed,partial',
        ]);

        // Generate IAR number
        $latestIAR = Inspection::latest('id')->first();
        $nextNumber = $latestIAR ? ($latestIAR->id + 1) : 1;
        $iarNumber = 'IAR-' . date('Y') . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        $validated['iar_number'] = $iarNumber;
        $validated['inspected_by'] = Auth::id();

        $inspection = Inspection::create($validated);

        // If inspection passed, increase product quantity
        if ($validated['status'] === 'passed') {
            $inspection->product->increaseQuantity($validated['quantity_received']);
        }

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inspection $inspection)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage inspections.');
        }

        $inspection->load(['product', 'inspector']);

        return view('inspections.show', compact('inspection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inspection $inspection)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage inspections.');
        }

        $products = Product::where('is_active', true)
            ->orderBy('product_name')
            ->get();

        return view('inspections.edit', compact('inspection', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inspection $inspection)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage inspections.');
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_name' => 'required|string|max:255',
            'quantity_received' => 'required|integer|min:1',
            'date_received' => 'required|date',
            'invoice_number' => 'nullable|string|max:100',
            'po_number' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
            'status' => 'required|in:passed,failed,partial',
        ]);

        $inspection->update($validated);

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspection $inspection)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Only administrators can manage inspections.');
        }

        $inspection->delete();

        return redirect()->route('inspections.index')
            ->with('success', 'Inspection record deleted successfully!');
    }
}
