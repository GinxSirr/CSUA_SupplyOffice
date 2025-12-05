<x-app-layout>
    <x-slot name="header">
        Issue New PAR
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="win-window">
                <div class="win-titlebar">📄 New Property Acknowledgment Receipt</div>

                <div class="p-6">
                    <form action="{{ route('property-acknowledgments.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="win-groupbox col-span-2">
                                <div class="win-groupbox-title">Product *</div>
                                <select name="product_id" class="win-input w-full" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->product_code }} - {{ $product->product_name }} (Stock: {{ $product->quantity }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox col-span-2">
                                <div class="win-groupbox-title">Assign To *</div>
                                <select name="assigned_to" class="win-input w-full" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} - {{ $user->department }} ({{ $user->position }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('assigned_to')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Quantity *</div>
                                <input type="number" name="quantity" value="{{ old('quantity', 1) }}"
                                       min="1" class="win-input w-full" required>
                                @error('quantity')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox">
                                <div class="win-groupbox-title">Date Issued *</div>
                                <input type="date" name="date_issued" value="{{ old('date_issued', date('Y-m-d')) }}"
                                       class="win-input w-full" required>
                                @error('date_issued')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="win-groupbox col-span-2">
                                <div class="win-groupbox-title">Condition</div>
                                <input type="text" name="condition" value="{{ old('condition') }}"
                                       placeholder="e.g., Brand New, Good, Fair" class="win-input w-full">
                                @error('condition')
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
                                💾 Issue PAR
                            </button>
                            <a href="{{ route('property-acknowledgments.index') }}" class="win-button">
                                ← Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
