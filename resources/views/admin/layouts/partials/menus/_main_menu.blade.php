<div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
{{--
Light: selected-menu-color-light  |  Dark: selected-menu-color-bright
Add: color-scheme-dark
--}}

  <div class="logged-user-w avatar-inline">
    <div class="logged-user-i">
      <div class="avatar-w">
        <img alt="" src="{{ auth()->user()->photo }}">
      </div>
      <div class="logged-user-info-w">
        <div class="logged-user-name">
          {{ auth()->user()->name }}
        </div>
        <div class="logged-user-role">
          {{ auth()->user()->position }}
        </div>
      </div>
      <div class="logged-user-toggler-arrow">
        <div class="os-icon os-icon-chevron-down"></div>
      </div>
      <div class="logged-user-menu color-style-bright">
        <div class="logged-user-avatar-info">
          <div class="avatar-w">
            <img alt="" src="{{ auth()->user()->photo }}">
          </div>
          <div class="logged-user-info-w">
            <div class="logged-user-name">
              {{ auth()->user()->name }}
            </div>
            <div class="logged-user-role">
              {{ auth()->user()->position }}
            </div>
          </div>
        </div>
        <div class="bg-icon">
          <i class="os-icon os-icon-wallet-loaded"></i>
        </div>
        <ul>
          <li>
            <a href="#"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
          </li>
          <li>
            <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <h1 class="menu-page-header">
    Main Menu
  </h1>
  <ul class="main-menu">
    <li class="sub-header">
      <span>Menu</span>
    </li>

    <li class="selected">
      <a href="{{ route('dashboard') }}">
        <div class="icon-w">
          <div class="os-icon os-icon-layout"></div>
        </div>
        <span>Dashboard</span></a>
    </li>

    <li class="selected">
      <a href="{{ route('admin.categories.index') }}">
        <div class="icon-w">
          <div class="os-icon os-icon-file"></div>
        </div>
        <span>Course Categories</span></a>
    </li>

    <li class="selected">
      <a href="{{ route('admin.courses.index') }}">
        <div class="icon-w">
          <div class="os-icon os-icon-book"></div>
        </div>
        <span>Courses</span></a>
    </li>

    <li class="selected">
      <a href="{{ route('admin.scholarships.index') }}">
        <div class="icon-w">
          <div class="os-icon os-icon-edit-32"></div>
        </div>
        <span>Scholarships</span></a>
    </li>

    <li class="selected">
      <a href="{{ route('admin.events.index') }}">
        <div class="icon-w">
          <div class="os-icon os-icon-edit-32"></div>
        </div>
        <span>Events</span></a>
    </li>

    <li class="selected">
      <a href="{{ route('admin.jobs.index') }}">
        <div class="icon-w">
          <div class="os-icon os-icon-user"></div>
        </div>
        <span>Jobs</span></a>
    </li>

    @can ('isAdminGroup')
      <li class="sub-header">
        <span>Admin Only</span>
      </li>

      <li class="selected">
        <a href="{{ route('admin.users.index') }}">
          <div class="icon-w">
            <div class="os-icon os-icon-users"></div>
          </div>
          <span>Manage Users</span></a>
      </li>
    @endcan

  </ul>
  {{-- <div class="side-menu-magic">
    <h4>
      Light Admin
    </h4>
    <p>
      Clean Bootstrap 4 Template
    </p>
    <div class="btn-w">
      <a class="btn btn-white btn-rounded" href="https://themeforest.net/item/light-admin-clean-bootstrap-dashboard-html-template/19760124?ref=Osetin" target="_blank">Purchase Now</a>
    </div>
  </div> --}}
</div>
<!--------------------
END - Main Menu
-------------------->