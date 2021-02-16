<!--------------------
START - Mobile Menu
-------------------->
<div class="menu-mobile menu-activated-on-click color-scheme-dark">
  <div class="mm-logo-buttons-w">
    <a class="mm-logo" href="{{ route('dashboard') }}"><img src="{{ asset('admin_assets/img/logo.png') }}"><span> {{ strtoupper(config('app.name')) }}</span></a>
    <div class="mm-buttons">
      <div class="content-panel-open">
        <div class="os-icon os-icon-grid-circles"></div>
      </div>
      <div class="mobile-menu-trigger">
        <div class="os-icon os-icon-hamburger-menu-1"></div>
      </div>
    </div>
  </div>
  <div class="menu-and-user">
    <div class="logged-user-w">
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
    <!--------------------
    START - Mobile Menu List
    -------------------->
    <ul class="main-menu">
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
          <span>Jobs</span>
        </a>
      </li>

      @can ('isAdminGroup')
        <li class="selected">
          <a href="{{ route('admin.users.index') }}">
            <div class="icon-w">
              <div class="os-icon os-icon-users"></div>
            </div>
            <span>Manage Users</span></a>
        </li>
      @endcan
    </ul>


    {{-- <div class="mobile-menu-magic">
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
</div>
<!--------------------
END - Mobile Menu
-------------------->