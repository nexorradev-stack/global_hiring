@extends('candidate.layouts.app')

@section('title', 'Candidate Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <style>
        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>
@endpush

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">🎯 Candidate Dashboard</h1>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Applications</h5>
                    <h2 class="fw-bold">{{ $totalApplications }}</h2>
                    <i class="fa-solid fa-file-lines fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Interviews</h5>
                    <h2 class="fw-bold">{{ $upcomingInterviews }}</h2>
                    <i class="fa-solid fa-video fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Contracts Signed</h5>
                    <h2 class="fw-bold">{{ $contractsSigned }}</h2>
                    <i class="fa-solid fa-file-signature fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Visa Status</h5>
                    <h2 class="fw-bold">{{ $visaStatus ?? 'Pending' }}</h2>
                    <i class="fa-solid fa-passport fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-bold">📈 Applications Over Time</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="applicationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-bold">🔍 Application Status</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Applications Chart (fake monthly data for demo, replace with real data later)
    new Chart(document.getElementById('applicationsChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Applications',
                data: [5, 10, 8, 15, 20, {{ $totalApplications }}],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.3)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    // Status Distribution (example - you can adapt to your Application status field)
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Accepted', 'Rejected'],
            datasets: [{
                label: 'Applications',
                data: [
                    {{ $recentApplications->where('status','pending')->count() }},
                    {{ $recentApplications->where('status','accepted')->count() }},
                    {{ $recentApplications->where('status','rejected')->count() }}
                ],
                backgroundColor: ['#ffc107', '#198754', '#dc3545']
            }]
        }
    });
</script>
@endpush
