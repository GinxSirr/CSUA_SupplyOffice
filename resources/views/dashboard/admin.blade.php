<x-app-layout>
    <x-slot name="header">
        Supply Officer Dashboard
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="win-window">
                    <div class="win-titlebar">Total Products</div>
                    <div class="p-6 text-center">
                        <div class="text-4xl font-bold text-gray-900">{{ $totalProducts }}</div>
                        <div class="text-sm mt-1">Items in inventory</div>
                    </div>
                </div>

                <div class="win-window">
                    <div class="win-titlebar bg-gradient-to-b from-red-500 to-red-700">Low Stock Items</div>
                    <div class="p-6 text-center">
                        <div class="text-4xl font-bold text-red-600">{{ $lowStockProducts }}</div>
                        <div class="text-sm mt-1">Needs restocking</div>
                    </div>
                </div>

                <div class="win-window">
                    <div class="win-titlebar bg-gradient-to-b from-yellow-500 to-yellow-700">Pending Requests</div>
                    <div class="p-6 text-center">
                        <div class="text-4xl font-bold text-yellow-700">{{ $pendingRequests }}</div>
                        <div class="text-sm mt-1">Awaiting approval</div>
                    </div>
                </div>

                <div class="win-window">
                    <div class="win-titlebar bg-gradient-to-b from-green-500 to-green-700">Total Requests</div>
                    <div class="p-6 text-center">
                        <div class="text-4xl font-bold text-green-700">{{ $totalRequests }}</div>
                        <div class="text-sm mt-1">All time</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recent Requests -->
                <div class="win-window">
                    <div class="win-titlebar">📋 Recent Supply Requests</div>
                    <div class="p-4">
                        <div class="space-y-2">
                            @forelse($recentRequests as $request)
                                <div class="win-panel flex justify-between items-center">
                                    <div class="flex-1">
                                        <p class="font-bold">{{ $request->product->product_name }}</p>
                                        <p class="text-sm">{{ $request->user->name }} • Qty: {{ $request->quantity_requested }}</p>
                                    </div>
                                    <span class="win-badge
                                        @if($request->status == 'pending') win-badge-warning
                                        @elseif($request->status == 'approved') win-badge-success
                                        @else win-badge-error @endif">
                                        {{ strtoupper($request->status) }}
                                    </span>
                                </div>
                            @empty
                                <p class="text-gray-600 p-2">No requests yet.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('supply-requests.index') }}" class="win-button-primary px-3 py-1">View All Requests</a>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Items -->
                <div class="win-window">
                    <div class="win-titlebar bg-gradient-to-b from-red-500 to-red-700">⚠️ Low Stock Alert</div>
                    <div class="p-4">
                        <div class="space-y-2">
                            @forelse($lowStockItems as $item)
                                <div class="win-panel bg-red-50 flex justify-between items-center">
                                    <div>
                                        <p class="font-bold">{{ $item->product_name }}</p>
                                        <p class="text-sm">Code: {{ $item->product_code }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-2xl font-bold text-red-700">{{ $item->quantity }}</p>
                                        <p class="text-xs">Reorder: {{ $item->reorder_level }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 p-2">All items are well stocked.</p>
                            @endforelse
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('products.index') }}" class="win-button-primary px-3 py-1">View All Products</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 win-window">
                <div class="win-titlebar">⚡ Quick Actions</div>
                <div class="p-4">
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('products.create') }}" class="win-button-primary">
                            ➕ Add New Product
                        </a>
                        <a href="{{ route('inspections.create') }}" class="win-button-primary">
                            📦 Record IAR
                        </a>
                        <a href="{{ route('property-acknowledgments.create') }}" class="win-button-primary">
                            📄 Issue PAR
                        </a>
                        <a href="{{ route('supply-requests.index') }}" class="win-button-primary">
                            ✅ Review Requests
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
