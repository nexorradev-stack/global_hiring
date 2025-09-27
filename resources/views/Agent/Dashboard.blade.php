@extends('agent.layouts.app')

@section('title', 'Agent Dashboard')

@push('styles')
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
    <h1 class="mb-4 fw-bold">👨‍💼 Agent Dashboard</h1>
    
    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Applications</h5>
                    <h2 class="fw-bold">{{ $applicationsCount }}</h2>
                    <p class="card-text">Assigned to you</p>
                    <i class="fa-solid fa-file-lines fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Interviews</h5>
                    <h2 class="fw-bold">{{ $interviewsCount }}</h2>
                    <p class="card-text">Scheduled by you</p>
                    <i class="fa-solid fa-video fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Approved Visas</h5>
                    <h2 class="fw-bold">{{ $approvedVisas }}</h2>
                    <p class="card-text">Cleared candidates</p>
                    <i class="fa-solid fa-passport fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Flights</h5>
                    <h2 class="fw-bold">{{ $flightsScheduled }}</h2>
                    <p class="card-text">Scheduled flights</p>
                    <i class="fa-solid fa-plane fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-bold">Applications by Status</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="applicationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header fw-bold">Interviews by Outcome</div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="interviewsChart"></canvas>
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
    // Applications Pie Chart
    new Chart(document.getElementById('applicationsChart'), {
        type: 'pie',
        data: {
            labels: @json($applicationStatus->keys()),
            datasets: [{
                label: 'Applications',
                data: @json($applicationStatus->values()),
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6c757d']
            }]
        }
    });

    // Interviews Doughnut Chart
    new Chart(document.getElementById('interviewsChart'), {
        type: 'doughnut',
        data: {
            labels: @json($interviewStatus->keys()),
            datasets: [{
                label: 'Interviews',
                data: @json($interviewStatus->values()),
                backgroundColor: ['#198754', '#dc3545', '#ffc107', '#0dcaf0', '#6c757d']
            }]
        }
    });
</script>
@endpush
