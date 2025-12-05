<x-app-layout>
    <x-slot name="header">
        Add New Product
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="win-window">
                <div class="win-titlebar">➕ New Product Form</div>

                <div class="p-6">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Product Code *</div>
                                <input type="text" name="product_code" value="{{ old('product_code') }}"
                                       class="win-input w-full" required>
                                @error('product_code')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Product Name *</div>
                                <input type="text" name="product_name" value="{{ old('product_name') }}"
                                       class="win-input w-full" required>
                                @error('product_name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Category</div>
                                <input type="text" name="category" value="{{ old('category') }}"
                                       class="win-input w-full">
                                @error('category')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Unit *</div>
                                <input type="text" name="unit" value="{{ old('unit') }}"
                                       placeholder="e.g., piece, box, ream" class="win-input w-full" required>
                                @error('unit')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Quantity *</div>
                                <input type="number" name="quantity" value="{{ old('quantity', 0) }}"
                                       min="0" class="win-input w-full" required>
                                @error('quantity')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Reorder Level *</div>
                                <input type="number" name="reorder_level" value="{{ old('reorder_level', 10) }}"
                                       min="0" class="win-input w-full" required>
                                @error('reorder_level')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox col-span-2">
                                <div class="win-groupbox-title">Unit Price *</div>
                                <input type="number" name="unit_price" value="{{ old('unit_price', 0) }}"
                                       step="0.01" min="0" class="win-input w-full" required>
                                @error('unit_price')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox col-span-2">
                                <div class="win-groupbox-title">Description</div>
                                <textarea name="description" class="win-input w-full" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-3 mt-6">
                            <button type="submit" class="win-button-primary">
                                💾 Save Product
                            </button>
                            <a href="{{ route('products.index') }}" class="win-button">
                                ← Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
