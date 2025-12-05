<x-app-layout>
    <x-slot name="header">
        Inspection & Acceptance Report (IAR)
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
                    <span>📦 Inspection & Acceptance Reports</span>
                    <a href="{{ route('inspections.create') }}" class="win-button-primary text-sm">
                        ➕ Record New IAR
                    </a>
                </div>

                <div class="p-4">
                    @if($inspections->isEmpty())
                        <p class="text-gray-600 text-center py-8">No inspection records found.</p>
                    @else
                        <table class="win-table">
                            <thead>
                                <tr>
                                    <th>IAR #</th>
                                    <th>Product</th>
                                    <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>Date Received</th>
                                    <th>PO #</th>
                                    <th>Status</th>
                                    <th>Inspector</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inspections as $inspection)
                                    <tr>
                                        <td class="font-bold">{{ $inspection->iar_number }}</td>
                                        <td>{{ $inspection->product->product_name }}</td>
                                        <td>{{ $inspection->supplier_name }}</td>
                                        <td>{{ $inspection->quantity_received }} {{ $inspection->product->unit }}</td>
                                        <td>{{ $inspection->date_received->format('M d, Y') }}</td>
                                        <td>{{ $inspection->po_number ?? '-' }}</td>
                                        <td>
                                            <span class="win-badge
                                                @if($inspection->status == 'passed') win-badge-success
                                                @elseif($inspection->status == 'failed') win-badge-error
                                                @else win-badge-warning @endif">
                                                {{ strtoupper($inspection->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $inspection->inspector->name }}</td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a href="{{ route('inspections.show', $inspection) }}" class="win-button text-sm">View</a>
                                                <a href="{{ route('inspections.edit', $inspection) }}" class="win-button text-sm">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $inspections->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
