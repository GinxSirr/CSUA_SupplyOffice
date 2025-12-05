<x-app-layout>
    <x-slot name="header">
        Property Acknowledgment Receipt (PAR)
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
                    <span>📄 Property Acknowledgment Receipts</span>
                    <a href="{{ route('property-acknowledgments.create') }}" class="win-button-primary text-sm">
                        ➕ Issue New PAR
                    </a>
                </div>

                <div class="p-4">
                    @if($acknowledgments->isEmpty())
                        <p class="text-gray-600 text-center py-8">No property acknowledgment records found.</p>
                    @else
                        <table class="win-table">
                            <thead>
                                <tr>
                                    <th>PAR #</th>
                                    <th>Product</th>
                                    <th>Assigned To</th>
                                    <th>Quantity</th>
                                    <th>Date Issued</th>
                                    <th>Condition</th>
                                    <th>Status</th>
                                    <th>Issued By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($acknowledgments as $par)
                                    <tr>
                                        <td class="font-bold">{{ $par->par_number }}</td>
                                        <td>{{ $par->product->product_name }}</td>
                                        <td>{{ $par->assignedTo->name }}</td>
                                        <td>{{ $par->quantity }} {{ $par->product->unit }}</td>
                                        <td>{{ $par->date_issued->format('M d, Y') }}</td>
                                        <td>{{ $par->condition ?? '-' }}</td>
                                        <td>
                                            <span class="win-badge
                                                @if($par->status == 'active') win-badge-success
                                                @elseif($par->status == 'returned') win-badge-info
                                                @else win-badge-warning @endif">
                                                {{ strtoupper($par->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $par->issuedBy->name }}</td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a href="{{ route('property-acknowledgments.show', $par) }}" class="win-button text-sm">View</a>
                                                <a href="{{ route('property-acknowledgments.edit', $par) }}" class="win-button text-sm">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $acknowledgments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
