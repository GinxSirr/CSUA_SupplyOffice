<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SupplyRequest;
use App\Models\Inspection;
use App\Models\PropertyAcknowledgment;
use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSupplyOfficer()) {
            // Supply Officer dashboard data
            $data = [
                'totalProducts' => Product::count(),
                'lowStockProducts' => Product::whereColumn('quantity', '<=', 'reorder_level')->count(),
                'pendingRequests' => SupplyRequest::where('status', 'pending')->count(),
                'totalRequests' => SupplyRequest::count(),
                'recentRequests' => SupplyRequest::with(['user', 'product'])
                    ->latest()
                    ->take(5)
                    ->get(),
                'lowStockItems' => Product::whereColumn('quantity', '<=', 'reorder_level')
                    ->orderBy('quantity', 'asc')
                    ->take(5)
                    ->get(),
                'recentInspections' => Inspection::with(['product', 'inspector'])
                    ->latest()
                    ->take(5)
                    ->get(),
            ];

            return view('dashboard.admin', $data);
        } else {
            // Employee dashboard data
            $data = [
                'myRequests' => SupplyRequest::where('user_id', $user->id)
                    ->with('product')
                    ->latest()
                    ->take(10)
                    ->get(),
                'pendingRequests' => SupplyRequest::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->count(),
                'approvedRequests' => SupplyRequest::where('user_id', $user->id)
                    ->where('status', 'approved')
                    ->count(),
                'notifications' => Notification::where('user_id', $user->id)
                    ->where('is_read', false)
                    ->latest()
                    ->take(5)
                    ->get(),
            ];

            return view('dashboard.user', $data);
        }
    }
}
