<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Interview;
use App\Models\Contract;
use App\Models\Visadocument;
use Illuminate\Support\Facades\Auth;

class CandidateDashboardController extends Controller
{
    public function index()
    {
        $candidateId = Auth::id();

        // Quick Stats
        $totalApplications = Application::where('candidate_id', $candidateId)->count();

        $upcomingInterviews = Interview::whereHas('application', function ($q) use ($candidateId) {
                $q->where('candidate_id', $candidateId);
            })
            ->whereDate('interview_date', '>=', now())
            ->count();

        $contractsSigned = Contract::where('status', 'signed')
            ->whereHas('interview.application', function ($q) use ($candidateId) {
                $q->where('candidate_id', $candidateId);
            })
            ->count();

        $visaStatus = Visadocument::where('candidate_id', $candidateId)->latest()->value('status');

        // Recent Items
        $recentApplications = Application::where('candidate_id', $candidateId)
            ->latest()->take(5)->get();

        $nextInterview = Interview::whereHas('application', function ($q) use ($candidateId) {
                $q->where('candidate_id', $candidateId);
            })
            ->whereDate('interview_date', '>=', now())
            ->orderBy('interview_date')
            ->first();

        $latestContract = Contract::whereHas('interview.application', function ($q) use ($candidateId) {
                $q->where('candidate_id', $candidateId);
            })
            ->latest()
            ->first();

        $latestVisa = Visadocument::where('candidate_id', $candidateId)
            ->latest()->first();

        return view('candidate.dashboard', compact(
            'totalApplications',
            'upcomingInterviews',
            'contractsSigned',
            'visaStatus',
            'recentApplications',
            'nextInterview',
            'latestContract',
            'latestVisa'
        ));
    }
}
