<x-app-layout>
    <x-slot name="header">
        Record New IAR
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="win-window">
                <div class="win-titlebar">📦 New Inspection & Acceptance Report</div>

                <div class="p-6">
                    <form action="{{ route('inspections.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="win-groupbox col-span-2">
                                <div class="win-groupbox-title">Product *</div>
                                <select name="product_id" class="win-input w-full" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->product_code }} - {{ $product->product_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Supplier Name *</div>
                                <input type="text" name="supplier_name" value="{{ old('supplier_name') }}"
                                       class="win-input w-full" required>
                                @error('supplier_name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Quantity Received *</div>
                                <input type="number" name="quantity_received" value="{{ old('quantity_received') }}"
                                       min="1" class="win-input w-full" required>
                                @error('quantity_received')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Date Received *</div>
                                <input type="date" name="date_received" value="{{ old('date_received', date('Y-m-d')) }}"
                                       class="win-input w-full" required>
                                @error('date_received')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Invoice Number</div>
                                <input type="text" name="invoice_number" value="{{ old('invoice_number') }}"
                                       class="win-input w-full">
                                @error('invoice_number')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Purchase Order (PO) Number</div>
                                <input type="text" name="po_number" value="{{ old('po_number') }}"
                                       class="win-input w-full">
                                @error('po_number')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Inspection Status *</div>
                                <select name="status" class="win-input w-full" required>
                                    <option value="passed" {{ old('status') == 'passed' ? 'selected' : '' }}>Passed</option>
                                    <option value="partial" {{ old('status') == 'partial' ? 'selected' : '' }}>Partial</option>
                                    <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                                @error('status')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox col-span-2">
                                <div class="win-groupbox-title">Remarks</div>
                                <textarea name="remarks" class="win-input w-full" rows="3">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-3 mt-6">
                            <button type="submit" class="win-button-primary">
                                💾 Save IAR
                            </button>
                            <a href="{{ route('inspections.index') }}" class="win-button">
                                ← Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
