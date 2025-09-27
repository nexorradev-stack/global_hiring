@extends('employer.layouts.app')

@section('title', 'Employer Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
<style>
    .card { border-radius: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: 0.3s ease; }
    .card:hover { transform: translateY(-5px); }
    .chart-container { position: relative; height: 300px; width: 100%; }
</style>
@endpush

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">🏢 Employer Dashboard</h1>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Jobs</h5>
                    <h2 class="fw-bold">{{ $totalJobs }}</h2>
                    <i class="fa-solid fa-briefcase fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Active Jobs</h5>
                    <h2 class="fw-bold">{{ $activeJobs }}</h2>
                    <i class="fa-solid fa-check-circle fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Interviews</h5>
                    <h2 class="fw-bold">{{ $interviews }}</h2>
                    <i class="fa-solid fa-comments fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Contracts</h5>
                    <h2 class="fw-bold">{{ $contracts }}</h2>
                    <i class="fa-solid fa-file-contract fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-bold">Job Status Distribution</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="jobDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-bold">Job Posts (Last 6 Months)</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlyJobsChart"></canvas>
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
    // Pie Chart - Job Distribution
    new Chart(document.getElementById('jobDistributionChart'), {
        type: 'pie',
        data: {
            labels: ['Active', 'Pending', 'Closed'],
            datasets: [{
                data: [{{ $jobDistribution['active'] }}, {{ $jobDistribution['pending'] }}, {{ $jobDistribution['closed'] }}],
                backgroundColor: ['#198754', '#ffc107', '#dc3545']
            }]
        }
    });

    // Bar Chart - Monthly Jobs
    new Chart(document.getElementById('monthlyJobsChart'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Jobs Posted',
                data: @json($monthlyJobs->toArray()),
                backgroundColor: '#0d6efd'
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
</script>
@endpush
