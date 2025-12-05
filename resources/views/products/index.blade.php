<x-app-layout>
    <x-slot name="header">
        Product Inventory Management
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="win-panel bg-green-100 border-green-500 mb-4 p-3">
                    <p class="font-bold text-green-800">✓ {{ session('success') }}</p>
                </div>
            @endif

            <div class="win-window">
                <div class="win-titlebar flex justify-between items-center">
                    <span>📦 Products</span>
                    <a href="{{ route('products.create') }}" class="win-button-primary text-sm">
                        ➕ Add New Product
                    </a>
                </div>

                <div class="p-4">
                    @if($products->isEmpty())
                        <p class="text-gray-600 text-center py-8">No products found.</p>
                    @else
                        <table class="win-table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Reorder Level</th>
                                    <th>Unit Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr class="@if($product->isLowStock()) bg-red-50 @endif">
                                        <td class="font-bold">{{ $product->product_code }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->category ?? '-' }}</td>
                                        <td>{{ $product->unit }}</td>
                                        <td class="text-right @if($product->isLowStock()) text-red-700 font-bold @endif">
                                            {{ $product->quantity }}
                                            @if($product->isLowStock())
                                                <span class="text-xs">⚠️</span>
                                            @endif
                                        </td>
                                        <td class="text-right">{{ $product->reorder_level }}</td>
                                        <td class="text-right">₱{{ number_format($product->unit_price, 2) }}</td>
                                        <td>
                                            <span class="win-badge @if($product->is_active) win-badge-success @else win-badge-error @endif">
                                                {{ $product->is_active ? 'ACTIVE' : 'INACTIVE' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a href="{{ route('products.show', $product) }}" class="win-button text-sm">View</a>
                                                <a href="{{ route('products.edit', $product) }}" class="win-button text-sm">Edit</a>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="win-button text-sm" onclick="return confirm('Delete this product?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Summary Panel -->
            <div class="mt-6 win-window">
                <div class="win-titlebar">📊 Inventory Summary</div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="win-groupbox">
                        <div class="win-groupbox-title">Total Products</div>
                        <p class="text-2xl font-bold text-center">{{ $products->total() }}</p>
                    </div>
                    <div class="win-groupbox">
                        <div class="win-groupbox-title">Low Stock Items</div>
                        <p class="text-2xl font-bold text-center text-red-700">
                            {{ $products->filter(fn($p) => $p->isLowStock())->count() }}
                        </p>
                    </div>
                    <div class="win-groupbox">
                        <div class="win-groupbox-title">Total Value</div>
                        <p class="text-2xl font-bold text-center">
                            ₱{{ number_format($products->sum(fn($p) => $p->quantity * $p->unit_price), 2) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
