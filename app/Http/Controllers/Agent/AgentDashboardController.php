<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Interview;
use App\Models\VisaDocument;
use App\Models\FlightSchedule;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agentId = Auth::id();

        $applicationsCount = Application::where('assigned_agent_id', $agentId)->count();
        $interviewsCount   = Interview::where('agent_id', $agentId)->count();
        $approvedVisas     = VisaDocument::where('status', 'approved')
                                ->whereHas('contract.interview', fn($q) => $q->where('agent_id', $agentId))
                                ->count();
        $flightsScheduled  = FlightSchedule::whereHas('visaDocument.contract.interview', fn($q) =>
                                $q->where('agent_id', $agentId)
                            )->count();

        $applicationStatus = Application::where('assigned_agent_id', $agentId)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $interviewStatus = Interview::where('agent_id', $agentId)
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('agent.dashboard', compact(
            'applicationsCount',
            'interviewsCount',
            'approvedVisas',
            'flightsScheduled',
            'applicationStatus',
            'interviewStatus'
        ));
    }
}
