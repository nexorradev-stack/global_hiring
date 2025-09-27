@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <!-- Page-specific styles -->
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
        <h1 class="mb-4 fw-bold">📊 Admin Dashboard</h1>
        
        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2 class="fw-bold">{{ $totalUsers }}</h2>
                        <p class="card-text">All registered users</p>
                        <i class="fa-solid fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Active Agents</h5>
                        <h2 class="fw-bold">{{ $agents }}</h2>
                        <p class="card-text">Total registered agents</p>
                        <i class="fa-solid fa-headset fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Employers</h5>
                        <h2 class="fw-bold">{{ $employers }}</h2>
                        <p class="card-text">Total registered employers</p>
                        <i class="fa-solid fa-building fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header fw-bold">User Growth</div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="userGrowthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header fw-bold">User Distribution</div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="userDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // User Growth (Bar Chart)
        const ctx1 = document.getElementById('userGrowthChart').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'New Users',
                    data: @json($growthData),
                    backgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // User Distribution (Pie Chart)
        const ctx2 = document.getElementById('userDistributionChart').getContext('2d');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: @json(array_keys($distribution)),
                datasets: [{
                    label: 'Users',
                    data: @json(array_values($distribution)),
                    backgroundColor: ['#0d6efd', '#198754', '#ffc107']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endpush
