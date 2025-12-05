<x-app-layout>
    <x-slot name="header">
        @if(Auth::user()->isAdmin())
            Supply Requests Management
        @else
            My Supply Requests
        @endif
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
                    <span>📋 Supply Requests</span>
                    @if(!Auth::user()->isAdmin())
                        <a href="{{ route('supply-requests.create') }}" class="win-button-primary text-sm">
                            ➕ New Request
                        </a>
                    @endif
                </div>

                <div class="p-4">
                    @if($requests->isEmpty())
                        <p class="text-gray-600 text-center py-8">No supply requests found.</p>
                    @else
                        <table class="win-table">
                            <thead>
                                <tr>
                                    <th>Request #</th>
                                    @if(Auth::user()->isAdmin())
                                        <th>Requestor</th>
                                    @endif
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requests as $request)
                                    <tr>
                                        <td class="font-bold">{{ $request->request_number }}</td>
                                        @if(Auth::user()->isAdmin())
                                            <td>{{ $request->user->name }}</td>
                                        @endif
                                        <td>{{ $request->product->product_name }}</td>
                                        <td>{{ $request->quantity_requested }} {{ $request->product->unit }}</td>
                                        <td>
                                            <span class="win-badge
                                                @if($request->status == 'pending') win-badge-warning
                                                @elseif($request->status == 'approved') win-badge-success
                                                @elseif($request->status == 'rejected') win-badge-error
                                                @else win-badge-info @endif">
                                                {{ strtoupper($request->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $request->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a href="{{ route('supply-requests.show', $request) }}" class="win-button text-sm">View</a>

                                                @if(Auth::user()->isAdmin() && $request->status == 'pending')
                                                    <form action="{{ route('supply-requests.approve', $request) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="win-button-primary text-sm" onclick="return confirm('Approve this request?')">
                                                            Approve
                                                        </button>
                                                    </form>
                                                    <button type="button" class="win-button text-sm" onclick="showRejectModal({{ $request->id }})">
                                                        Reject
                                                    </button>
                                                @endif

                                                @if(!Auth::user()->isAdmin() && $request->status == 'pending')
                                                    <a href="{{ route('supply-requests.edit', $request) }}" class="win-button text-sm">Edit</a>
                                                    <form action="{{ route('supply-requests.destroy', $request) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="win-button text-sm" onclick="return confirm('Delete this request?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $requests->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="win-window max-w-md w-full mx-4">
            <div class="win-titlebar">Reject Request</div>
            <form id="rejectForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="p-4">
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Reason for Rejection:</label>
                        <textarea name="admin_remarks" class="win-input w-full" rows="4" required></textarea>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="win-button-primary">Submit</button>
                        <button type="button" class="win-button" onclick="hideRejectModal()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showRejectModal(requestId) {
            const modal = document.getElementById('rejectModal');
            const form = document.getElementById('rejectForm');
            form.action = `/supply-requests/${requestId}/reject`;
            modal.classList.remove('hidden');
        }

        function hideRejectModal() {
            const modal = document.getElementById('rejectModal');
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
