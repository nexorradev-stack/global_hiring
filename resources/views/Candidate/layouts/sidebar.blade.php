<!-- Font Awesome 6 CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header d-flex align-items-center justify-content-between px-3 py-2">
    <div class="d-flex align-items-center">
      <img src="{{ asset('assets/images/logo-icon4.png') }}" class="logo-img img-fluid me-2" alt="Logo" / style=" width: 150px; height:100%; margin-top:10px;">
      {{-- <h5 class="mb-0">GlobeHire</h5> --}}
    </div>
    <button class="sidebar-close btn btn-sm btn-light">
      <i class="fa-solid fa-xmark fa-lg text-danger"></i>
    </button>
  </div>

  <nav class="sidebar-nav">
    <ul class="metismenu list-unstyled" id="sidenav">

      {{-- Dashboard --}}
       <li class="nav-item">
        <a href="{{ route('candidate.dashboard') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('candidate.dashboard') ? 'active bg-primary text-white' : '' }}">
          <i class="fa-solid fa-gauge-high fa-lg text-info me-2"></i>
          <span class="menu-title ms-2">Dashboard</span>
        </a>
      </li>

      {{-- Browse Jobs --}}
      <li class="nav-item">
        <a href="{{ route('candidate.jobs.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('candidate.jobs.index') ? 'active bg-primary text-white' : '' }}">
          <i class="fa-solid fa-briefcase fa-lg text-success me-2"></i>
          <span class="menu-title ms-2">Browse Jobs</span>
        </a>
      </li>

      {{-- My Applications --}}
      <li class="nav-item">
        <a href="{{ route('candidate.applications.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('candidate.applications.index') ? 'active bg-primary text-white' : '' }}">
          <i class="fa-solid fa-file-lines fa-lg text-primary me-2"></i>
          <span class="menu-title ms-2">My Applications</span>
        </a>
      </li>

      {{-- Interviews --}}
      <li class="nav-item">
        <a href="{{ route('candidate.interviews.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('candidate.interviews.*') ? 'active bg-primary text-white' : '' }}">
          <i class="fa-solid fa-microphone-lines fa-lg text-warning me-2"></i>
          <span class="menu-title ms-2">Interviews</span>
        </a>
      </li>

      {{-- Contracts --}}
      <li class="nav-item">
        <a href="{{ route('candidate.contracts.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('candidate.contracts.*') ? 'active bg-primary text-white' : '' }}">
          <i class="fa-solid fa-file-signature fa-lg text-danger me-2"></i>
          <span class="menu-title ms-2">Contracts</span>
        </a>
      </li>

      {{-- Visa Documents --}}
      <li class="nav-item">
        <a href="{{ route('candidate.visa.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('candidate.visa.*') && !request()->routeIs('candidate.visa.flights.*') ? 'active bg-primary text-white' : '' }}">
          <i class="fa-solid fa-passport fa-lg text-purple me-2" style="color:#9b59b6;"></i>
          <span class="menu-title ms-2">Visa Documents</span>
        </a>
      </li>

      {{-- Flight Schedules --}}
      <li class="nav-item">
        @if($hasVisa && $latestVisa)
        <a href="{{ route('candidate.visa.flights.index', ['visa' => $latestVisa->id]) }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('candidate.visa.flights.*') ? 'active bg-primary text-white' : '' }}">
          <i class="fa-solid fa-plane-departure fa-lg text-info me-2"></i>
          <span class="menu-title ms-2">Flight Schedules</span>
        </a>
        @else
        <a href="javascript:void(0)" class="nav-link disabled d-flex align-items-center" tabindex="-1" aria-disabled="true">
          <i class="fa-solid fa-plane-departure fa-lg text-secondary me-2"></i>
          <span class="menu-title ms-2">Flight Schedules</span>
        </a>
        @endif
      </li>

    </ul>
  </nav>
</aside>
