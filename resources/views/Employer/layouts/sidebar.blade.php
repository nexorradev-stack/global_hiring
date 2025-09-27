<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">

<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header d-flex align-items-center justify-content-between px-3 py-2">
    <div class="d-flex align-items-center">
      <img src="{{ asset('assets/images/logo-icon4.png') }}" 
           class="logo-img img-fluid me-2" 
           alt="Logo" 
           style="width: 150px; height:100%; margin-top:10px;">
    </div>
    <button class="sidebar-close btn btn-sm btn-light">
      <span class="material-icons-outlined fs-4 text-danger">close</span>
    </button>
  </div>

  <nav class="sidebar-nav">
    <ul class="metismenu list-unstyled" id="sidenav">

      {{-- Employer Dashboard --}}
      <li class="nav-item {{ request()->routeIs('employer.dashboard') ? 'mm-active' : '' }}">
          <a href="{{ route('employer.dashboard') }}"
            class="nav-link d-flex align-items-center {{ request()->routeIs('employer.dashboard') ? 'bg-primary text-white' : '' }}">
            <i class="material-icons-outlined me-2">dashboard</i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

      {{-- Job Management --}}
      <li class="nav-item mt-2">
        <a href="javascript:;" class="nav-link d-flex align-items-center disabled text-warning">
          <i class="material-icons-outlined fs-5">business_center</i>
          <span class="menu-title ms-2 fw-semibold">Jobs</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('employer.jobs.index') ? 'mm-active' : '' }}">
        <a href="{{ route('employer.jobs.index') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('employer.jobs.index') ? 'bg-primary text-white' : '' }}">
          <i class="material-icons-outlined fs-5 text-success me-2">work</i>
          <span class="menu-title">All Jobs</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('employer.jobs.create') ? 'mm-active' : '' }}">
        <a href="{{ route('employer.jobs.create') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('employer.jobs.create') ? 'bg-primary text-white' : '' }}">
          <i class="material-icons-outlined fs-5 text-info me-2">post_add</i>
          <span class="menu-title">Create Job</span>
        </a>
      </li>

      {{-- Contracts --}}
      <li class="nav-item pt-3">
        <a href="javascript:;" class="nav-link d-flex align-items-center disabled text-warning">
          <i class="material-icons-outlined fs-5">description</i>
          <span class="menu-title ms-2 fw-semibold">Contracts</span>
        </a>
      </li>

      @foreach (['created' => 'receipt_long', 'signed' => 'edit_note', 'approved' => 'how_to_reg', 'rejected' => 'cancel'] as $status => $icon)
        <li class="nav-item {{ request('status') === $status ? 'mm-active' : '' }}">
          <a href="{{ route('employer.contracts.index', ['status' => $status]) }}"
             class="nav-link d-flex align-items-center {{ request('status') === $status ? 'bg-primary text-white' : '' }}">
            <i class="material-icons-outlined fs-5 me-2 
              {{ $status === 'created' ? 'text-primary' : ($status === 'signed' ? 'text-success' : ($status === 'approved' ? 'text-info' : 'text-danger')) }}">
              {{ $icon }}
            </i>
            <span class="menu-title">{{ ucfirst($status) }}</span>
          </a>
        </li>
      @endforeach

      {{-- Interviews --}}
      <li class="nav-item pt-3">
        <a href="javascript:;" class="nav-link d-flex align-items-center disabled text-warning">
          <i class="material-icons-outlined fs-5">person_search</i>
          <span class="menu-title ms-2 fw-semibold">Interviews</span>
        </a>
      </li>

      <li class="nav-item {{ request()->routeIs('employer.interviews.passed') ? 'mm-active' : '' }}">
        <a href="{{ route('employer.interviews.passed') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('employer.interviews.passed') ? 'bg-primary text-white' : '' }}">
          <i class="material-icons-outlined fs-5 text-success me-2">check_circle</i>
          <span class="menu-title">Passed Interviews</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('employer.interviews.shortlisted') ? 'mm-active' : '' }}">
        <a href="{{ route('employer.interviews.shortlisted') }}"
           class="nav-link d-flex align-items-center {{ request()->routeIs('employer.interviews.shortlisted') ? 'bg-primary text-white' : '' }}">
          <i class="material-icons-outlined fs-5 text-warning me-2">star</i>
          <span class="menu-title">Shortlisted</span>
        </a>
      </li>

       

    </ul>
  </nav>
</aside>
