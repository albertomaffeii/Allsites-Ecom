<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row {{ config('app.panel_color') }}">
    <div class="navbar-brand-wrapper d-flex justify-content-center {{ config('app.panel_color') }}">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                <img src="/admin/images/logo.jpeg" alt="logo"/>Econ
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                <img src="/admin/images/logo.jpeg" alt="logo"/>
            </a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-sort-variant"></span>
            </button>
        </div>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end {{ config('app.panel_color') }}">
        <ul class="navbar-nav mr-lg-4 w-100">
            <li class="nav-item nav-search d-none d-lg-block w-100">
                <form action="{{ route('admin.search') }}" method="GET" role="search">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="search">
                                <i class="mdi mdi-magnify"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search" aria-label="search" aria-describedby="search" name="search" value="{{ Request::get('search') }}" />

                            <input type="radio" name="type" value="0" checked /> Product
                            &nbsp;&nbsp;
                            <input type="radio" name="type" value="1" {{ Request::get('type') == '1' ? 'checked' : '' }} /> Customer
                            &nbsp;&nbsp;
                            <input type="radio" name="type" value="2" {{ Request::get('type') == '2' ? 'checked' : '' }} /> Order
                    </div>
                </form>
            </li>
        </ul>

        <ul class="navbar-nav navbar-nav-right">
            {{-- <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-message-text mx-0"></i>
                <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                    <h6 class="ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                    The meeting is cancelled
                    </p>
                </div>
                </a>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                    <h6 class="ellipsis font-weight-normal">Tim Cook
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                    New product launch
                    </p>
                </div>
                </a>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="item-content flex-grow">
                    <h6 class="ellipsis font-weight-normal"> Johnson
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                    Upcoming board meeting
                    </p>
                </div>
                </a>
            </div>
            </li>
            <li class="nav-item dropdown me-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell mx-0"></i>
                <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <div class="item-icon bg-success">
                    <i class="mdi mdi-information mx-0"></i>
                    </div>
                </div>
                <div class="item-content">
                    <h6 class="font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                    </p>
                </div>
                </a>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <div class="item-icon bg-warning">
                    <i class="mdi mdi-settings mx-0"></i>
                    </div>
                </div>
                <div class="item-content">
                    <h6 class="font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                    </p>
                </div>
                </a>
                <a class="dropdown-item">
                <div class="item-thumbnail">
                    <div class="item-icon bg-info">
                    <i class="mdi mdi-account-box mx-0"></i>
                    </div>
                </div>
                <div class="item-content">
                    <h6 class="font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                    </p>
                </div>
                </a>
            </div>
            </li> --}}
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    @if (Auth::user()->userDetail && Auth::user()->userDetail->profile_image)
                        <img src="{{ asset(Auth::user()->userDetail->profile_image) }}" alt="Profile Image" class="rounded-circle border border-secondary">
                    @else
                        <img src="{{ asset('uploads/faces/no-image.png') }}" alt="Profile Image" class="rounded-circle border border-secondary">
                    @endif
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown {{ config('app.panel_color') }}" aria-labelledby="profileDropdown">
                    <a href={{ Route('settings'); }} class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i> Settings
                    </a>
                    <a href={{ Route('admin.profile'); }} class="dropdown-item">
                        <i class="mdi mdi-settings text-primary"></i> Profile
                    </a>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="mdi mdi-logout text-primary"></i>
            Logout
            </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
