<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Interview;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;

class EmployerDashboardController extends Controller
{
    public function index()
    {
        $employerId = Auth::id();

        // KPIs
        $totalJobs       = Job::where('employer_id', $employerId)->count();
        $activeJobs      = Job::where('employer_id', $employerId)->where('status', 'active')->count();
        $closedJobs      = Job::where('employer_id', $employerId)->where('status', 'closed')->count();

        $interviews      = Interview::whereHas('application.job', function ($q) use ($employerId) {
                                $q->where('employer_id', $employerId);
                            })->count();

        $contracts       = Contract::where('employer_id', $employerId)->count();

        // Job distribution for Pie Chart
        $jobDistribution = [
            'active'  => $activeJobs,
            'pending' => Job::where('employer_id', $employerId)->where('status', 'pending')->count(),
            'closed'  => $closedJobs,
        ];

        // Monthly job postings (last 6 months)
        $monthlyJobs = Job::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('employer_id', $employerId)
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->pluck('total', 'month');

        return view('employer.dashboard', compact(
            'totalJobs',
            'activeJobs',
            'closedJobs',
            'interviews',
            'contracts',
            'jobDistribution',
            'monthlyJobs'
        ));
    }
}
