<x-app-layout>
    <x-slot name="header">
        Employee Dashboard
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="win-window">
                    <div class="win-titlebar bg-gradient-to-b from-yellow-500 to-yellow-700">Pending Requests</div>
                    <div class="p-6 text-center">
                        <div class="text-4xl font-bold text-yellow-700">{{ $pendingRequests }}</div>
                        <div class="text-sm mt-1">Awaiting approval</div>
                    </div>
                </div>

                <div class="win-window">
                    <div class="win-titlebar bg-gradient-to-b from-green-500 to-green-700">Approved Requests</div>
                    <div class="p-6 text-center">
                        <div class="text-4xl font-bold text-green-700">{{ $approvedRequests }}</div>
                        <div class="text-sm mt-1">Successfully approved</div>
                    </div>
                </div>

                <div class="win-window">
                    <div class="win-titlebar">Unread Notifications</div>
                    <div class="p-6 text-center">
                        <div class="text-4xl font-bold text-blue-700">{{ $notifications->count() }}</div>
                        <div class="text-sm mt-1">New messages</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- My Requests -->
                <div class="win-window">
                    <div class="win-titlebar">📋 My Supply Requests</div>
                    <div class="p-4">
                        <div class="mb-3">
                            <a href="{{ route('supply-requests.create') }}" class="win-button-primary">
                                ➕ New Request
                            </a>
                        </div>
                        <div class="space-y-2">
                            @forelse($myRequests as $request)
                                <div class="win-panel">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <p class="font-bold">{{ $request->product->product_name }}</p>
                                            <p class="text-sm">Quantity: {{ $request->quantity_requested }} {{ $request->product->unit }}</p>
                                            <p class="text-xs text-gray-600">{{ $request->created_at->format('M d, Y') }}</p>
                                            @if($request->admin_remarks)
                                                <p class="text-xs mt-1 bg-yellow-50 p-1 border border-yellow-300"><strong>Remarks:</strong> {{ $request->admin_remarks }}</p>
                                            @endif
                                        </div>
                                        <span class="win-badge ml-2
                                            @if($request->status == 'pending') win-badge-warning
                                            @elseif($request->status == 'approved') win-badge-success
                                            @elseif($request->status == 'rejected') win-badge-error
                                            @else win-badge-info @endif">
                                            {{ strtoupper($request->status) }}
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 p-2">No requests yet.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('supply-requests.index') }}" class="win-button px-3 py-1">View All Requests</a>
                        </div>
                    </div>
                </div>

                <!-- Notifications -->
                <div class="win-window">
                    <div class="win-titlebar">🔔 Recent Notifications</div>
                    <div class="p-4">
                        <div class="space-y-2">
                            @forelse($notifications as $notification)
                                <div class="win-panel bg-blue-50">
                                    <p class="font-bold text-sm">{{ $notification->title }}</p>
                                    <p class="text-sm mt-1">{{ $notification->message }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <p class="text-gray-600 p-2">No new notifications.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Info Card -->
            <div class="mt-6 win-window">
                <div class="win-titlebar">👤 My Information</div>
                <div class="p-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="win-groupbox">
                            <div class="win-groupbox-title">Name</div>
                            <p class="font-bold text-lg">{{ auth()->user()->name }}</p>
                        </div>
                        <div class="win-groupbox">
                            <div class="win-groupbox-title">Department</div>
                            <p class="font-bold text-lg">{{ auth()->user()->department ?? 'Not set' }}</p>
                        </div>
                        <div class="win-groupbox">
                            <div class="win-groupbox-title">Position</div>
                            <p class="font-bold text-lg">{{ auth()->user()->position ?? 'Not set' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
