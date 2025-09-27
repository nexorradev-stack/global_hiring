<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // KPI Counts
        $totalUsers   = User::count();
        $candidates   = User::where('role', 'candidate')->count();
        $agents       = User::where('role', 'agent')->count();
        $employers    = User::where('role', 'employer')->count();

        // User Growth (last 6 months)
        $userGrowth = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Format data for Chart.js (Jan–Dec, but only last 6 months filled)
        $months = [];
        $growthData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M');
            $monthNum = now()->subMonths($i)->format('n'); // numeric month
            $months[] = $month;
            $growthData[] = $userGrowth[$monthNum] ?? 0;
        }

        // Distribution
        $distribution = [
            'candidates' => $candidates,
            'agents'     => $agents,
            'employers'  => $employers,
        ];

        return view('admin.dashboard', compact(
            'totalUsers',
            'candidates',
            'agents',
            'employers',
            'months',
            'growthData',
            'distribution'
        ));
    }
}
